<?php
include("../includes/dbconnection.php");

$message = "";

if($_POST) {
    $fullname  = trim($_POST['fullname']);
    $email     = trim($_POST['email']);
    $school    = trim($_POST['school']);
    $location  = trim($_POST['location']);
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // --- SERVER SIDE VALIDATION ---

    // 1. Full name: letters and spaces only, no numbers
    if(empty($fullname) || !preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        $message = "Full name must contain letters only. Numbers are not allowed.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 2. Valid email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 3. School required
    if(empty($school)) {
        $message = "School name is required.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 4. Location required
    if(empty($location)) {
        $message = "Location is required.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 5. Password min length
    if(strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 6. Passwords match
    if($password !== $cpassword) {
        $message = "Sorry, your passwords do not match.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // 7. Email must be unique
    $checkemail = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    if(mysqli_num_rows($checkemail) > 0) {
        $message = "This email is already registered. Please login instead.";
        header("location:../signup.php?message=$message");
        exit();
    }

    // --- ALL GOOD — INSERT INTO DATABASE ---
    $encryptancy = base64_encode($password);
    $insert = mysqli_query($conn, "INSERT INTO students(fullname, email, school, location, password) 
                                   VALUES('$fullname', '$email', '$school', '$location', '$encryptancy')");

    if($insert) {
        $message = "Account created successfully! Please login.";
        header("location:../index.php?message=$message");
        exit();
    } else {
        $message = "Something went wrong. Please try again.";
        header("location:../signup.php?message=$message");
        exit();
    }
}
?>
