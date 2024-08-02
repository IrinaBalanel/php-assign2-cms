<?php
  // connection string for local database in MAMP
  $connect = mysqli_connect('localhost', 'root', 'YOURPASSWORD', 'publicart');

  // connection string for the database on infinityfree. To connect to this database, the code that queries tables needs to be adjusted from uppercase to lowercase names of tables
  // $connect = mysqli_connect('sql208.infinityfree.com', 'if0_37023836', '4WtMjCeBkmRQrj', 'if0_37023836_publicart');
  if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>