<?php   
include("../includes/dbconnection.php");
$message="";

if($_POST){
    $total = $_POST['total'];
    $student_id = $_POST['student_id'];
    $update = mysqli_query($conn,"update bursary_application set given_amount='$total',a_status='Approved' where student_id='$student_id'");
    if($update){
        $message = "Bursary application approved.";
        header("location:../bursary.php?message=$message");
    }
    else{
       
        $message = "Error.";
        header("location:../bursary.php?message=$message");
    }
}
?>