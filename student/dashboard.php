<?php include_once("../admin/includes/header.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHomePage</title>
</head>
<body>
<div class="dashboard-parent">
    <div class="aside-dashboard">
        <?php include_once("includes/navigation.php");?>
    </div>
    <div class="main-dashboard">
        <?php include_once("includes/topBar.php");?>

        <!-- Main content -->
        <section class="content text-dark">
            <div class="container-fluid">
                <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px">Welcome back Learner</h4><br>

                <?php
                    // Get the logged-in student's ID from session
                    $student_id = $_SESSION['student_id'];

                    // 1. Count number of applications this student has submitted
                    $app_result = $conn->query("SELECT COUNT(*) as total FROM bursary_application WHERE student_id = $student_id");
                    $app_count = $app_result->fetch_assoc()['total'];

                    // 2. Get the actual money given to this specific student
                    $money_result = $conn->query("SELECT SUM(given_amount) as total_money 
                                                  FROM bursary_application
                                                  WHERE student_id = $student_id");
                    $money_data = $money_result->fetch_assoc();
                    $total_money = $money_data['total_money'] ? $money_data['total_money'] : 0;
                ?>

                <div class="row">

                    <!-- Number of Applications -->
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-light elevation-1">
                                <i class="fas fa-th-list"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Number of Applications</span>
                                <span class="info-box-number text-right h5">
                                    <?php echo $app_count; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- Total Money Released -->
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-primary elevation-1">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Money Released</span>
                                <span class="info-box-number text-right h5">
                                    KSh <?php echo number_format($total_money, 2); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                </div>
            </div>
        </section>
    </div>
</div>
</body>
</html>
