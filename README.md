Script Requires MeekroDB: http://www.meekro.com/ and amazon-glacier-cmd-interface https://github.com/uskudnik/amazon-glacier-cmd-interface 

After uploading a file to a glacier vault, this script takes the JSON response from glacier-cmd and saves it to a database. If that file is already in glacier, then the existing one will be deleted (effectively leaving the new/updated file). 

Having a database of file names and archive IDs makes it easy to manage files in Glacier. 

he database schema is pretty simple (below).