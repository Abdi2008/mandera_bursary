<?php
include("../includes/dbconnection.php");
$message = "";

if($_POST) {
    $total          = $_POST['total'];
    $application_id = $_POST['application_id'];

    $update = mysqli_query($conn, "UPDATE bursary_application 
                                   SET given_amount='$total', a_status='Approved' 
                                   WHERE application_id='$application_id'");
    if($update) {
        $message = "Bursary application approved.";
        header("location:../bursary.php?message=$message");
    } else {
        $message = "Error approving application.";
        header("location:../bursary.php?message=$message");
    }
}
?>
