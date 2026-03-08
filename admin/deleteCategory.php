<?php 
include_once("includes/dbconnection.php");
$message = "";
$category_id = $_REQUEST['category_id'];

// $delete = mysqli_query($conn,"update category set del=4 where category_id='$category_id'");
$delete = mysqli_query($conn, "DELETE FROM category WHERE category_id='$category_id'");

if($delete){
            $message = "Category deleted.";
            header("location:category.php?message=$message");
}
else{
    $message = "Error.";
    header("location:category.php?message=$message");
}


?>