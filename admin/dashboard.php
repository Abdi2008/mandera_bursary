<?php 
include_once("includes/header.php");
include_once("includes/dbconnection.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
</head>
<body>
<div class="dashboard-parent">
            <div class="aside-dashboard">
                    <?php include_once("includes/navigation.php");?>
            </div>
            <div class="main-dashboard">
            <?php include_once("includes/topBar.php");?>
                    <!-- Main content -->
                    <section class="content  text-dark">
                            <div class="container-fluid">
                            <h4 class="" style="font-weight:bold; font-size:20px;letter-spacing:1.5px">Welcome !!!!</h4><br>
                            <div class="row">
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                        <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-th-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number Bursary periods</span>
                            <span class="info-box-number text-right h5">
                            <?php 
                                $category = $conn->query("SELECT * FROM bursary_activity")->num_rows;
                                echo $category;
                            ?>
                            <?php ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number of Students</span>
                            <span class="info-box-number text-right h5">
                            <?php 
                               $students = $conn->query("SELECT * FROM students where del=1")->num_rows;
                                echo $students;
                            ?>
                            <?php ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                        <span class="info-box-icon bg-gradient-success elevation-1"><i class="fas fa-list"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Number of New Applications</span>
                            <span class="info-box-number text-right h5">
                            <?php 
                                $streams = $conn->query("SELECT * FROM  bursary_application where a_status='Pending'")->num_rows;
                                echo $streams;
                            ?>
                            <?php ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    </div>
                    </section>
            </div>
</div>
</body>
</html>