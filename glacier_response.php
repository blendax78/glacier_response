#!/usr/bin/php
<?php

/*
Example:
php glacier_response.php "$(glacier-cmd upload --name 'bookmarks.html' --description 'bookmarks.html' Test_Vault bookmarks.html)" Test_Vault

Using find:
find . -name 'find*' -exec bash -c 'abc=$(glacier-cmd upload --name "{}" --description "{}" Test_Vault "{}") ; php /home/blendax/Saves/scripts/php/glacier_response.php "$abc" Test_Vault' \;

*/


require("meekrodb.2.1.class.php");
DB::$host = "";
DB::$user = "";
DB::$password = "";
DB::$dbName = "";

# Allows text to be piped into script
#$pipe = readfile("php://stdin");

process_input($argv,$argc);
function process_input($args = null, $argc = 0){
	if($argc == 3 && strlen($args[1]) > 1){
		$response = $args[1];
		$vault = $args[2];
	}else{
		exit;
	}
	#Turn JSON into an array
	$json = json_decode(strstr($response,"{"),true);
	process($json["Created archive with ID"],$json["Uploaded file"],$json["Archive SHA256 tree hash"], $vault);
}

function process($id, $name, $hash, $vault = "Test_Vault"){
	$result = null;
	$result = DB::query("select * from glacier where filename = %s",
		$name);
	$output = array();
	if (count($result) > 0){
		foreach($result as $r){
			#Delete from glacier
			exec("/usr/local/bin/glacier-cmd rmarchive $vault '{$r['archive_id']}'",$output);
			DB::query("update glacier set updated = now() where id = {$r['id']};");
		}
	}else{
		DB::query("insert into glacier (archive_id,hash,filename,created, updated) values ( %s, %s, %s, now(), now(), vault );",
			$id,
			$hash,
			$name,
			$vault);

	}
#var_dump($output);
}

?>
