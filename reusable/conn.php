<?php
  // connection string for local database in MAMP
  $connect = mysqli_connect('localhost', 'root', 'root', 'publicart');
  if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>
