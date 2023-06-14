<?php


try {
      $db = new SQLite3('/home/echeck/gwitter.db');
}
catch (Exception $e) {
    echo 'Message: ' . $e;
}
?>