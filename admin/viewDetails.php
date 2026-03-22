<?php include_once("includes/dbconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/newlogo.png">
    <style>
        .sidetail { display:flex; justify-content:space-around; }
        .side-11  { flex-basis:30%; }
        .verification-box {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: bold;
        }
        .v-verified  { background-color:#d4edda; border:1px solid #28a745; color:#155724; }
        .v-pending   { background-color:#fff3cd; border:1px solid #ffc107; color:#856404; }
        .v-rejected  { background-color:#f8d7da; border:1px solid #dc3545; color:#721c24; }
    </style>
</head>
<body>
<?php include_once("../admin/includes/header.php"); ?>
<div class="dashboard-parent">
    <div class="aside-dashboard">
        <?php include_once("includes/navigation.php"); ?>
    </div>
    <div class="main-dashboard">
        <?php include_once("includes/topBar.php"); ?>
        <section class="content text-dark">
            <div class="card-body">
                <div class="container-fluid">

                    <?php if(isset($_REQUEST['message'])): ?>
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> <?php echo $_REQUEST['message']; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $student_id = $_REQUEST['student_id'];
                    $qry = $conn->query("SELECT * FROM bursary_application 
                                         JOIN students ON bursary_application.student_id = students.student_id 
                                         JOIN bursary_activity ON bursary_application.bursary_id = bursary_activity.bursary_id
                                         WHERE students.student_id = $student_id");
                    $row = $qry->fetch_assoc();
                    ?>

                    <div class="details">
                        <h3>Student fullname : <?php echo htmlspecialchars($row['fullname']); ?></h3>
                        <hr>

                        <!-- ── VERIFICATION STATUS BADGE ── -->
                        <?php
                        $verified = $row['verified'];
                        if($verified == 1) {
                            echo '<div class="verification-box v-verified">
                                    Verified by University: <b>'.htmlspecialchars($row['verified_by']).'</b>
                                    — This student has been confirmed as enrolled at their institution.
                                  </div>';
                        } elseif($verified == 2) {
                            echo '<div class="verification-box v-rejected">
                                    Rejected by University: <b>'.htmlspecialchars($row['verified_by']).'</b>
                                    — This student could not be verified as enrolled. Review before approving.
                                  </div>';
                        } else {
                            echo '<div class="verification-box v-pending">
                                    Pending Verification — This student has not yet been verified by their university.
                                    Consider waiting for verification before approving.
                                  </div>';
                        }
                        ?>

                        <div class="sidetail">
                            <div class="side-11">
                                <h2>Personal Info</h2>
                                <p><b>Gender: </b><?php echo htmlspecialchars($row['gender']); ?></p>
                                <p><b>Reg Number:</b> <?php echo htmlspecialchars($row['reg_num']); ?></p>
                                <p><b>Phone Number:</b> <?php echo htmlspecialchars($row['phone']); ?></p>
                                <p><b>Guardian:</b> <?php echo htmlspecialchars($row['guardian']); ?></p>
                            </div>
                            <div class="side-11">
                                <h2>Residence Info</h2>
                                <p><b>Residence:</b> <?php echo htmlspecialchars($row['residence']); ?></p>
                                <p><b>Sub Location:</b> <?php echo htmlspecialchars($row['sub_location']); ?></p>
                                <p><b>Village:</b> <?php echo htmlspecialchars($row['village']); ?></p>
                                <p><b>Location:</b> <?php echo htmlspecialchars($row['r_location']); ?></p>
                            </div>
                            <div class="side-11">
                                <h2>School Info</h2>
                                <p><b>School:</b> <?php echo htmlspecialchars($row['school']); ?></p>
                                <p><b>School Location:</b> <?php echo htmlspecialchars($row['town']); ?></p>
                                <p><b>Account Number:</b> <?php echo htmlspecialchars($row['account']); ?></p>
                                <p><b>Amount Requested:</b> <?php echo htmlspecialchars($row['total_amount']); ?> Kshs</p>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="bbton">
                        <div class="ton-de">
                            <button class="btn btn-primary">
                                <a href="approve.php?student_id=<?php echo $student_id; ?>" style="color:white;">Approve Bursary</a>
                            </button>
                            <button class="btn btn-danger">
                                <a href="decline.php?student_id=<?php echo $student_id; ?>" style="color:white;">Decline Bursary</a>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
<?php include_once("../admin/includes/footer.php"); ?>
</body>
</html>
