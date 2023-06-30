`sudo service apache2 start` - to start the apache
go to `127.0.0.1` or `localhost`- to check if apache2 server service has started properly or not
go inside `/var/www/html`
copy the file inside of your respective directory to that folder
and on opening local host or `127.0.0.1` - we will get our version of index.html

php code is always written inside

<?php
code
?>

- variable always begins with $
- echo refers to print

by default php takes value by get method
$\_GET[name_of_fieled] is used to take content from name of field

`php -S 0.0.0.0:8000 -t .` - is used to run php server in 8000 port in current directory
