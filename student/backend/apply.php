<?php
include("../includes/dbconnection.php");

$message = "";

if($_POST) {
    $gender       = $_POST['gender'];
    $reg_num      = $_POST['reg_num'];
    $phone        = $_POST['phone'];
    $guardian     = $_POST['guardian'];
    $residence    = $_POST['residence'];
    $r_location   = $_POST['r_location'];
    $sub_location = $_POST['sub_location'];
    $village      = $_POST['village'];
    $account      = $_POST['account'];
    $bank         = $_POST['bank'];
    $tel_num      = $_POST['tel_num'];
    $town         = $_POST['town'];
    $address      = $_POST['address'];
    $total_amount = $_POST['total_amount'];
    $student_id   = $_POST['student_id'];
    $bursary_id   = $_POST['bursary_id'];

    // Check if student already applied for THIS specific bursary period
    // (not just any bursary — allows applying to different periods)
    $check = mysqli_query($conn, "SELECT * FROM bursary_application 
                                  WHERE student_id='$student_id' 
                                  AND bursary_id='$bursary_id'");

    if(mysqli_num_rows($check) > 0) {
        $message = "You have already applied for this bursary period.";
        header("location:../apply.php?bursary_id=$bursary_id&message=$message");
        exit();
    } else {
        $insert = mysqli_query($conn, "INSERT INTO bursary_application
            (gender, reg_num, phone, guardian, residence, r_location, sub_location,
             village, account, bank, tel_num, town, address, total_amount, student_id, bursary_id)
            VALUES
            ('$gender','$reg_num','$phone','$guardian','$residence','$r_location','$sub_location',
             '$village','$account','$bank','$tel_num','$town','$address','$total_amount','$student_id','$bursary_id')");

        if($insert) {
            $message = "Bursary application submitted successfully!";
            header("location:../busary.php?message=$message");
            exit();
        } else {
            $message = "Something went wrong. Please try again.";
            header("location:../apply.php?bursary_id=$bursary_id&message=$message");
            exit();
        }
    }
}
?>
