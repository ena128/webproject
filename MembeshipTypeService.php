<?php
require_once 'MembershipTypeDAO.php';

class MembershipTypeService {
    private $membershipTypeDAO;

    public function __construct() {
        $this->membershipTypeDAO = new MembershipTypeDAO();
    }

    // Method to get all membership types
    public function getAllMembershipTypes() {
        return $this->membershipTypeDAO->getAllMembershipTypes();
    }

    // Method to get membership type by ID
    public function getMembershipTypeById($membershipTypeId) {
        return $this->membershipTypeDAO->getMembershipTypeById($membershipTypeId);
    }

    // Method to create a new membership type
    public function createMembershipType($membershipTypeData) {
        // Add any validation or business logic here
        return $this->membershipTypeDAO->createMembershipType($membershipTypeData);
    }

    // Method to update a membership type
    public function updateMembershipType($membershipTypeId, $membershipTypeData) {
        // Add any validation or business logic here
        return $this->membershipTypeDAO->updateMembershipType($membershipTypeId, $membershipTypeData);
    }

    // Method to delete a membership type
    public function deleteMembershipType($membershipTypeId) {
        // Add any validation or business logic here
        return $this->membershipTypeDAO->deleteMembershipType($membershipTypeId);
    }
}
?>
