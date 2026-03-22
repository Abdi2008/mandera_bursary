<?php
include_once("../../admin/includes/header.php");

// Protect this page - only logged in verifiers
if(!isset($_SESSION['verifier_id'])) {
    header("Location: ../index.php?message=Please login first");
    exit();
}

if(isset($_POST['action']) && isset($_POST['application_id'])) {
    $application_id  = $_POST['application_id'];
    $university_name = $_SESSION['verifier_name'];
    $action          = $_POST['action'];

    if($action == 'verify') {
        $verified = 1;
        $stmt = $conn->prepare("UPDATE bursary_application SET verified = ?, verified_by = ? WHERE application_id = ?");
        $stmt->bind_param("isi", $verified, $university_name, $application_id);
        $stmt->execute();
        header("Location: ../dashboard.php?message=Student successfully verified!");
        exit();

    } else if($action == 'reject') {
        $verified = 2;
        $stmt = $conn->prepare("UPDATE bursary_application SET verified = ?, verified_by = ? WHERE application_id = ?");
        $stmt->bind_param("isi", $verified, $university_name, $application_id);
        $stmt->execute();
        header("Location: ../dashboard.php?message=Student application rejected.");
        exit();
    }
} else {
    header("Location: ../dashboard.php");
    exit();
}
?>
