<?php

require 'MysqlConnection.php';
require 'vendor/autoload.php';

use Firebase\JWT\JWT;

// CORS header
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Checking for OPTIONS requests and sending the necessary headers
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}

// Checking for the existence of user data in the POST request
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); // Decoding JSON data into an associative array

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($input['email']) && isset($input['password'])) {
    $email = $input['email'];
    $password = $input['password'];

    // Checking the validity of an email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('success' => false, 'error' => 'Invalid email format'));
        exit;
    }

    try {
        //The preparation of SQL query for finding a user by email
        $stmt = $conn->prepare("SELECT * FROM Members WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Checking for the existence of a user and the correctness of the password
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Generating a JWT token
                $jwtPayload = array(
                    'email' => $user['email']
                );
                
                // Generating a secret key
                $randomBytes = random_bytes(32); // It generates 32 random bytes
                $jwtSecretKey = bin2hex($randomBytes); // It converts random bytes into hexadecimal format
                
                // Signing the JWT token
                $jwtToken = JWT::encode($jwtPayload, $jwtSecretKey,'HS256');
                
                // Preparing user data for sending
                $userData = array(
                    'email' => $user['email'],
                    'name' => $user['name']
                );

                // Sending a JSON response with the JWT token, user data, and success status
                echo json_encode(array(
                    'success' => true,
                    'jwtToken' => $jwtToken,
                    'userData' => $userData,
                    'redirectUrl' => 'account.html'
                ));
                exit;
            } else {
                echo json_encode(array('success' => false, 'error' => 'Invalid password'));
                exit;
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'User not found'));
            exit;
        }
    } catch (PDOException $e) {
        // Error while executing the SQL query
        echo json_encode(array('success' => false, 'error' => $e->getMessage()));
        exit;
    }
    
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid email or password'));
    exit;
}

?>
