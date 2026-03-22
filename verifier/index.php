<?php include_once("../admin/includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Verifier Login</title>
</head>
<body>
<div class="main-body">
    <div class="main-text">
        <div class="login-box">
            <h1 style="text-align:center; color:white; font-style:bold;">BURSARY MIS</h1>
            <div class="card card-navy my-2">
                <div class="card-body">
                    <p class="login-box-msg">University Verifier Login</p>
                    <?php
                    if(isset($_REQUEST['message'])) {
                        $message = $_REQUEST['message'];
                        echo '<div class="alert alert-warning" role="alert">'.$message.'</div>';
                    }
                    ?>
                    <form action="backend/index.php" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" autofocus placeholder="University Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-success btn-block">Sign In</button>
                            </div>
                        </div>
                        <br>
                        <center><a href="../index.php">Back Home</a></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
