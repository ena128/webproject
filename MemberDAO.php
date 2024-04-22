<?php
require_once 'MysqlConnection.php'; // Assuming this file contains the database connection logic

class MemberDAO {
    private $conn;

    public function __construct() {
        $this->conn = MysqlConnection::getConnection();
    }

    public function getAllMembers() {
        $sql = "SELECT * FROM Members";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMember($name, $email, $age, $gender, $membership_type_id) {
        $sql = "INSERT INTO Members (name, email, age, gender, membership_type_id) VALUES (:name, :email, :age, :gender, :membership_type_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'age' => $age, 'gender' => $gender, 'membership_type_id' => $membership_type_id]);
        return $this->conn->lastInsertId();
    }

    public function updateMember($member_id, $name, $email, $age, $gender, $membership_type_id) {
        $sql = "UPDATE Members SET name = :name, email = :email, age = :age, gender = :gender, membership_type_id = :membership_type_id WHERE id = :member_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['member_id' => $member_id, 'name' => $name, 'email' => $email, 'age' => $age, 'gender' => $gender, 'membership_type_id' => $membership_type_id]);
        return $stmt->rowCount() > 0;
    }

    public function deleteMember($member_id) {
        $sql = "DELETE FROM Members WHERE id = :member_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['member_id' => $member_id]);
        return $stmt->rowCount() > 0;
    }
}
?>
