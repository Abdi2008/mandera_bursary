
<?php
include("../includes/dbconnection.php");
$message="";

if($_POST){
        $period_name = $_POST['period_name'];
        $total_amount = $_POST['total_amount'];
        $year = date("Y");
        //val period
        $checkCategory = mysqli_query($conn,"select * from bursary_activity where period_name='$period_name' and p_year='$year'");
        if(mysqli_num_rows($checkCategory) > 0){
            $message = "Bursary period already exists.";
            header("location:../category.php?message=$message");
        }
        else{
             $insert = mysqli_query($conn,"insert into bursary_activity (period_name,amount,p_year) values ('$period_name','$total_amount','$year')");
             if($insert){
                $message = "Bursary period added successfully..";
                 header("location:../category.php?message=$message");
             }
             else{
                $message = "Error.";
                header("location:../category.php?message=$message");
             }
        }
}
?>