<?php   

include("../includes/dbconnection.php");

$message="";

if($_POST){
    $gender    = $_POST['gender'];
    $reg_num   = $_POST['reg_num'];
    $phone     = $_POST['phone'];
    $guardian  = $_POST['guardian'];
    $residence  = $_POST['residence'];
    $r_location = $_POST['r_location'];
    $sub_location = $_POST['sub_location'];
    $village  = $_POST['village'];
    $account = $_POST['account'];
    $bank   = $_POST['bank'];
    $tel_num = $_POST['tel_num'];
    $town   = $_POST['town'];
    $address  = $_POST['address'];
    $total_amount = $_POST['total_amount'];
    $student_id = $_POST['student_id'];
    $bursary_id = $_POST['bursary_id'];
    //check application
    $check_id = mysqli_query($conn,"select * from bursary_application where student_id='$student_id'");
    if(mysqli_num_rows($check_id)> 0){
        $message = "You have already applied for the bursary";
        header("location:../apply.php?message=$message");
    }
    else{
        $insert = mysqli_query($conn,"insert into bursary_application(gender,reg_num,phone,guardian,residence,r_location,sub_location,village,account,bank,tel_num,town,address,total_amount,student_id,bursary_id) values('$gender','$reg_num','$phone','$guardian','$residence','$r_location','$sub_location','$village','$account','$bank','$tel_num','$town','$address','$total_amount','$student_id','$bursary_id')");
        if($insert){
            $message = "Bursary applied successfully";
            header("location:../apply.php?message=$message");
        }
        else{
            $message = "Error";
            header("location:../apply.php?message=$message");
        }
    }
}
?>