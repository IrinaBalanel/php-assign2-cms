<?php
  // Parse .env file for database configuration
  $env_file = dirname(__DIR__) . '/.env';
  if (file_exists($env_file)) {
    $env_vars = parse_ini_file($env_file);
    $db_host = $env_vars['DB_HOST'] ?? 'localhost';
    $db_port = $env_vars['DB_PORT'] ?? 3306;
    $db_username = $env_vars['DB_USERNAME'] ?? 'root';
    $db_password = $env_vars['DB_PASSWORD'] ?? '';
    $db_database = $env_vars['DB_DATABASE'] ?? 'publicart';
  } else {
    // Fallback to hardcoded values if .env doesn't exist
    $db_host = 'localhost';
    $db_port = 3306;
    $db_username = 'root';
    $db_password = 'YOURPASSWORD';
    $db_database = 'publicart';
  }
  
  $connect = mysqli_connect($db_host, $db_username, $db_password, $db_database, $db_port);
  if (!$connect) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>
