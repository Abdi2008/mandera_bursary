<?php   
include("../includes/dbconnection.php");
$message="";

if($_POST){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encryptancy = base64_encode($password);

    if(empty($username) || empty($encryptancy))
    {
         if($username == "")
          {
              
              $message = "Username is required.";
             header("location:../index.php?message=$message");
          }
  
                          if($encryptancy == "")
                          {
                                  $message = "Password is required.";
                                  header("location:../index.php?message=$message");
                          }
  
                      }
                      else
                      {
  
                          $login = mysqli_query($conn,"select * from admin where username = '$username' and password ='$encryptancy'");
  
                          if(mysqli_num_rows($login)==1)
                              {
                                  header("location:../dashboard.php");
                              }
                          else
                              {
                              $message = "Either email or password is incorrect.";
                                  header("location:../index.php?message=$message");
                              }
  
                      }
}
?>