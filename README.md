Script Requires MeekroDB: http://www.meekro.com/ and amazon-glacier-cmd-interface https://github.com/uskudnik/amazon-glacier-cmd-interface 

After uploading a file to a glacier vault, this script takes the JSON response from glacier-cmd and saves it to a database. If that file is already in glacier, then the existing one will be deleted (effectively leaving the new/updated file). 

Having a database of file names and archive IDs makes it easy to manage files in Glacier. 

The database schema is pretty simple (attached).

Example:

<code>
glacier_response.php <JSON glacier-cmd response> <vault name>

php glacier_response.php "$(glacier-cmd upload --name 'bookmarks.html' --description 'bookmarks.html' Test_Vault bookmarks.html)" Test_Vault
</code>

Using find:
<code>
find . -name 'find*' -exec bash -c 'abc=$(glacier-cmd upload --name "{}" --description "{}" Test_Vault "{}") ; <br/>
 php /home/blendax/Saves/scripts/php/glacier_response.php "$abc" Test_Vault' \;
</code>
