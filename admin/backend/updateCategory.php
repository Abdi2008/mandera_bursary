<?php  
  include("../includes/dbconnection.php");
  $message="";
  
  if($_POST){
    $category_name  = $_POST['category_name'];
    $total_number  = $_POST['total_number'];
    $amount  = $_POST['amount'];
    $category_id  = $_POST['category_id'];
    $update = mysqli_query($conn,"update category set category_name='$category_name',duration_month='$total_number',amount='$amount' where category_id='$category_id'");
    if($update){
        $message = "Category Details updated.";
        header("location:../category.php?message=$message");
    }
    else{
        $message = "Error.";
        header("location:../category.php?message=$message");
    }
  }
?>