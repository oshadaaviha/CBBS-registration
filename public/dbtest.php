<?php
$dsn = "mysql:host=localhost;dbname=registration;charset=utf8mb4";
$user = "root";
$pass = "";
try {
  new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  echo "DB Connection OK";
} catch (Throwable $e) {
  echo "DB Error: " . $e->getMessage();
}
