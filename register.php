<?php

require 'MysqlConnection.php'; 
$payload = $_POST;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

header('Content-Type: application/json');

try {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        throw new Exception("All fields are required");
    }

    //Password encryption
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $SELECT = "SELECT email FROM Members WHERE email = :email LIMIT 1";
    $stmt = $conn->prepare($SELECT);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        throw new Exception("Someone already registered using this email");
    }

    $sql = "INSERT INTO Members (name, email, password)
            VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword); 
    $stmt->execute();

    echo json_encode(array('success' => true));

} catch(PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

$conn = null; // Zatvaranje konekcije s bazom podataka
?>
