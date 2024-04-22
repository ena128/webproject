<?php
require 'MysqlConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM Members WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                echo json_encode(array(
                    'success' => true,
                    'membership' => $user['membership_type_id'],
                    'name' => $user['name'],
                    'accountNumber' => $user['id'],
                    'status' => $user['active'] ? 'Active' : 'Inactive'
                ));
            } else {
                echo json_encode(array('success' => false, 'error' => 'Invalid password'));
            }
        } else {
            echo json_encode(array('success' => false, 'error' => 'User not found'));
        }
    } catch (PDOException $e) {
        echo json_encode(array('success' => false, 'error' => $e->getMessage()));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid request method'));
}
?>
