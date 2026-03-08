<?php
include("../includes/dbconnection.php");
$message = "";

if($_POST) {

	$email = $_POST['email'];
	$password = $_POST['password'];
	$encrypass = base64_encode($password);

	if(empty($email) || empty($password)) {
		if($encrypass == "") {

			$message = "Password is required";
	        header("location:../index.php?message=$message");
		}

		if($email == "") {
			$message = "Email is required. ";
	        header("location:../index.php?message=$message");
		}
	}
	else
	{


            $login = mysqli_query($conn, "select * from students where email='$email' and password='$encrypass' and del=1");


                    if(mysqli_num_rows($login)==1)
                        {
                            $row=mysqli_fetch_array($login);

                            $email = $row['email'];
                            $_SESSION['email']=$email;
                            $_SESSION['student_id'] = $row['student_id'];
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
