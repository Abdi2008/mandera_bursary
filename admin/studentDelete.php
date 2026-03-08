<?php 
include_once("includes/dbconnection.php");
$message = "";
$student_id = $_REQUEST['student_id'];

$delete = mysqli_query($conn,"update students set del=2 where student_id='$student_id'");

if($delete){
            $message = "Student deleted.";
            header("location:student.php?message=$message");
}
else{
    $message = "Error.";
    header("location:student.php?message=$message");
}


?>