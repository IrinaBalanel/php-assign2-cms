<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'publicart');
if (!$connect) {
  die("Connection Failed: " . mysqli_connect_error());
}
?>