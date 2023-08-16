<?php
$host = 'localhost';
$dbname = 'postgres';
$user = 'postgres';
$password = 'postgres';

try {
   $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
   // echo "Connected to the PostgreSQL database successfully!";
   return $pdo;
} catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
}
?>
