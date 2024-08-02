<?php
  // connection string for local database in MAMP
  $connect = mysqli_connect('localhost', 'root', 'YOURPASSWORD', 'publicart');
  if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>
