<?php
require_once 'TrainerDAO.php';

class TrainerService {
    private $trainerDAO;

    public function __construct() {
        $this->trainerDAO = new TrainerDAO();
    }

    // Method to get all trainers
    public function getAllTrainers() {
        return $this->trainerDAO->getAllTrainers();
    }

    // Method to get trainer by ID
    public function getTrainerById($trainerId) {
        return $this->trainerDAO->getTrainerById($trainerId);
    }

    // Method to create a new trainer
    public function createTrainer($trainerData) {
        // Add any validation or business logic here
        return $this->trainerDAO->createTrainer($trainerData);
    }

    // Method to update a trainer
    public function updateTrainer($trainerId, $trainerData) {
        // Add any validation or business logic here
        return $this->trainerDAO->updateTrainer($trainerId, $trainerData);
    }

    // Method to delete a trainer
    public function deleteTrainer($trainerId) {
        // Add any validation or business logic here
        return $this->trainerDAO->deleteTrainer($trainerId);
    }
}
?>
