<?php 
include_once("includes/dbconnection.php");
$message = "";
$student_id = $_REQUEST['student_id'];

$delete = mysqli_query($conn,"update bursary_application set a_status='Declined' where student_id='$student_id'");

if($delete){
            $message = "Bursary application declined.";
            header("location:bursary.php?message=$message");
}
else{
    $message = "Error.";
    header("location:bursary.php?message=$message");
}


?>