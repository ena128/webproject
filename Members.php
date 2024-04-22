<?php
// Import necessary files
require_once 'MemberService.php';

// Create an instance of the MemberService
$memberService = new MemberService();

// Define routes for members
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Route to get all members
    if ($_GET['route'] === 'members') {
        $members = $memberService->getAllMembers();
        echo json_encode($members);
    }
    // Route to get a member by ID
    elseif ($_GET['route'] === 'member' && isset($_GET['id'])) {
        $memberId = $_GET['id'];
        $member = $memberService->getMemberById($memberId);
        echo json_encode($member);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Route to create a new member
    if ($_POST['route'] === 'createMember') {
        // Get the member data from the request body
        $memberData = json_decode(file_get_contents("php://input"), true);
        $result = $memberService->createMember($memberData);
        echo json_encode($result);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Route to update an existing member
    if ($_PUT['route'] === 'updateMember' && isset($_PUT['id'])) {
        // Get the member ID from the request URL
        $memberId = $_PUT['id'];
        // Get the member data from the request body
        $memberData = json_decode(file_get_contents("php://input"), true);
        $result = $memberService->updateMember($memberId, $memberData);
        echo json_encode($result);
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Route to delete an existing member
    if ($_DELETE['route'] === 'deleteMember' && isset($_DELETE['id'])) {
        // Get the member ID from the request URL
        $memberId = $_DELETE['id'];
        $result = $memberService->deleteMember($memberId);
        echo json_encode($result);
    }
}
?>
