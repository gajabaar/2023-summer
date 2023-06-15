<?php
$dbfile = './gwitter.db';

$db = new SQLite3($dbfile);

if (!$db) {
    die("Connection failed");
}
?>
