<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=gymdatabase", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connection succesful";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>