<?php
  $db_host = getenv('DB_HOST') ?: null;
  $db_port = getenv('DB_PORT') ?: null;
  $db_username = getenv('DB_USERNAME') ?: null;
  $db_password = getenv('DB_PASSWORD') ?: null;
  $db_database = getenv('DB_DATABASE') ?: null;

  if (!$db_host || !$db_port || !$db_username || !$db_database) {
    $env_file = dirname(__DIR__) . '/.env';
    if (file_exists($env_file)) {
      $env_vars = parse_ini_file($env_file);
      $db_host = $db_host ?: ($env_vars['DB_HOST'] ?? 'localhost');
      $db_port = $db_port ?: ($env_vars['DB_PORT'] ?? 3306);
      $db_username = $db_username ?: ($env_vars['DB_USERNAME'] ?? 'root');
      $db_password = $db_password ?: ($env_vars['DB_PASSWORD'] ?? '');
      $db_database = $db_database ?: ($env_vars['DB_DATABASE'] ?? 'publicart');
    } else {
      $db_host = $db_host ?: 'localhost';
      $db_port = $db_port ?: 3306;
      $db_username = $db_username ?: 'root';
      $db_password = $db_password ?: 'root';
      $db_database = $db_database ?: 'publicart';
    }
  }

  $connect = mysqli_connect($db_host, $db_username, $db_password, $db_database, (int)$db_port);
  if (!$connect) {
    die('Connection Failed: ' . mysqli_connect_error());
  }
?>
