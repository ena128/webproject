<?php
require_once 'MysqlConnection.php'; // Assuming this file contains the database connection logic

class TrainerDAO {
    private $conn;

    public function __construct() {
        $this->conn = MysqlConnection::getConnection();
    }

    public function getAllTrainers() {
        $sql = "SELECT * FROM Trainers";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createTrainer($name, $email, $specialization) {
        $sql = "INSERT INTO Trainers (name, email, specialization) VALUES (:name, :email, :specialization)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'specialization' => $specialization]);
        return $this->conn->lastInsertId();
    }

    public function updateTrainer($trainer_id, $name, $email, $specialization) {
        $sql = "UPDATE Trainers SET name = :name, email = :email, specialization = :specialization WHERE trainer_id = :trainer_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['trainer_id' => $trainer_id, 'name' => $name, 'email' => $email, 'specialization' => $specialization]);
        return $stmt->rowCount() > 0;
    }

    public function deleteTrainer($trainer_id) {
        $sql = "DELETE FROM Trainers WHERE trainer_id = :trainer_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['trainer_id' => $trainer_id]);
        return $stmt->rowCount() > 0;
    }
}
?>
