<?php
// Include necessary files
include ('inc/functions.php');
include ('reusable/nav.php');
secure(); // Ensure the user is logged in

// Your secured content here
echo "Welcome to the admin dashboard, " . $_SESSION['email'] . "!";
?>