<?php   

include("../includes/dbconnection.php");

$message="";

if($_POST){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $school = $_POST['school'];
            $location = $_POST['location'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $encryptancy = base64_encode($password);

    //LETS MAKE EMAIL UNIQUE

    $checkemail = mysqli_query($conn,"select * from students where email='$email'");

    if(mysqli_num_rows($checkemail)>0){

        $message = "Email already exists.";
        header("location:../signup.php?message=$message");
    }
    elseif($password != $cpassword){

        $message = "Sorry, Your password do not Match";
        header("location:../signup.php?message=$message");
         
    }
    else{

          //INSERT INTO DATABASE

          $insert = mysqli_query($conn,"insert into students(fullname,email,school,location,password) values('$fullname','$email','$school','$location','$encryptancy')");

          if($insert){
            $message = "Account create succefully";
            header("location:../index.php?message=$message");
          }
          else{
            $message = "errrror...";
            header("location:../signup.php?message=$message");
          }
    }

}



?>