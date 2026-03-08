<?php include_once("../admin/includes/header.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
.sign-up{
    width:60%;
    margin:auto;
}
</style>
</head>
<body>
<div class="sign-up">
             <center><h3>Student Signup form</h3></center>
            <form action="backend/sigup.php" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="fullname" autofocus placeholder="Fullnames">
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="school" autofocus placeholder="School">
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="location" autofocus placeholder="Location">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create Account</button><br>
                   <center><a href="index.php">Back home</a></center>
             </form> 
</div>
</body>
</html>