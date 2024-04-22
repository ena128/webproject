<?php
require_once 'MysqlConnection.php'; // Assuming this file contains the database connection logic

class MembershipTypeDAO {
    private $conn;

    public function __construct() {
        $this->conn = MysqlConnection::getConnection();
    }

    public function getAllMembershipTypes() {
        $sql = "SELECT * FROM MembershipTypes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMembershipType($type_name, $description, $price) {
        $sql = "INSERT INTO MembershipTypes (type_name, description, price) VALUES (:type_name, :description, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['type_name' => $type_name, 'description' => $description, 'price' => $price]);
        return $this->conn->lastInsertId();
    }

    public function updateMembershipType($membership_type_id, $type_name, $description, $price) {
        $sql = "UPDATE MembershipTypes SET type_name = :type_name, description = :description, price = :price WHERE id = :membership_type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['membership_type_id' => $membership_type_id, 'type_name' => $type_name, 'description' => $description, 'price' => $price]);
        return $stmt->rowCount() > 0;
    }

    public function deleteMembershipType($membership_type_id) {
        $sql = "DELETE FROM MembershipTypes WHERE id = :membership_type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['membership_type_id' => $membership_type_id]);
        return $stmt->rowCount() > 0;
    }
}
?>
