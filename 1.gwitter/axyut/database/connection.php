<?php 
$db = new SQLite3("gwitter.db");

if (!$db){
    die("Connection failed!");
}

?>