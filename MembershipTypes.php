<?php
require_once 'MembershipTypeService.php';

// Create a new MembershipTypeService instance
$membershipTypeService = new MembershipTypeService();

// Get all membership types
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $membershipTypes = $membershipTypeService->getAllMembershipTypes();
    echo json_encode($membershipTypes);
}

// Add a new membership type
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $membershipTypeService->addMembershipType($data);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}

// Update a membership type
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $membershipTypeService->updateMembershipType($data);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}

// Delete a membership type
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $success = $membershipTypeService->deleteMembershipType($id);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}
?>
