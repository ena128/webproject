<?php
// Include the database connection file
require 'MysqlConnection.php';

$payload = $_REQUEST;

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    }
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
    exit(0);
}
if (isset($_POST["password"])) {
    $password = $_POST["password"];
} else {
    // 'password' field is missing, handle the error
    echo json_encode(array('success' => false, 'error' => 'Password field is missing'));
    exit(); // Stop further execution
}


// Retrieve form data
$fullName = $_POST["full_name"];  // Corrected variable name
$email = $_POST["email"];
$address = $_POST["address"];
$password = $_POST["password"];

try {
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert data into the Members table
    $stmt = $conn->prepare("INSERT INTO Members (full_name, address, email, password) VALUES (:fullName, :address, :email, :password)");
    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
    // Check if 'password' key is present in $_POST array


// Proceed with other form data validation and processing...

} catch(PDOException $e) {
    echo json_encode(array('success' => false, 'error' => 'Registration failed. Please try again later.'));
}

// Close connection
$conn = null;
?>
