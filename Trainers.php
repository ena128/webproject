<?php
require_once 'TrainerService.php';

// Create a new TrainerService instance
$trainerService = new TrainerService();

// Get all trainers
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trainers = $trainerService->getAllTrainers();
    echo json_encode($trainers);
}

// Add a new trainer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $trainerService->addTrainer($data);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}

// Update a trainer
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $success = $trainerService->updateTrainer($data);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}

// Delete a trainer
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];
    $success = $trainerService->deleteTrainer($id);
    if ($success) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}
?>
