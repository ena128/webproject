<?php
require_once 'MemberDAO.php';

class MemberService {
    private $memberDAO;

    public function __construct() {
        $this->memberDAO = new MemberDAO();
    }

    // Method to get all members
    public function getAllMembers() {
        return $this->memberDAO->getAllMembers();
    }

    // Method to get member by ID
    public function getMemberById($memberId) {
        return $this->memberDAO->getMemberById($memberId);
    }

    // Method to create a new member
    public function createMember($memberData) {
        // Add any validation or business logic here
        return $this->memberDAO->createMember($memberData);
    }

    // Method to update a member
    public function updateMember($memberId, $memberData) {
        // Add any validation or business logic here
        return $this->memberDAO->updateMember($memberId, $memberData);
    }

    // Method to delete a member
    public function deleteMember($memberId) {
        // Add any validation or business logic here
        return $this->memberDAO->deleteMember($memberId);
    }
}
?>
