<?php
  $connect = mysqli_connect('localhost', 'root', 'YOURPASSWORD', 'publicart');
  if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>