<?php include_once("../admin/includes/header.php"); ?>
<?php
// Protect this page
if(!isset($_SESSION['verifier_id'])) {
    header("Location: index.php?message=Please login first");
    exit();
}
$university_name = $_SESSION['verifier_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Verifier Dashboard</title>
    <style>
        .badge-verified   { background-color: #28a745; color: white; padding: 4px 10px; border-radius: 12px; font-size: 12px; }
        .badge-pending    { background-color: #ffc107; color: black;  padding: 4px 10px; border-radius: 12px; font-size: 12px; }
        .badge-rejected   { background-color: #dc3545; color: white;  padding: 4px 10px; border-radius: 12px; font-size: 12px; }
    </style>
</head>
<body>
<div class="dashboard-parent">
    <div class="aside-dashboard">
        <!-- Sidebar -->
        <div class="sidebar" style="background:#343a40; min-height:100vh; padding:20px; color:white;">
            <h5 style="color:#ffc107;">🎓 <?php echo htmlspecialchars($university_name); ?></h5>
            <hr style="border-color:#555;">
            <ul style="list-style:none; padding:0;">
                <li style="padding:8px 0;"><a href="dashboard.php" style="color:white; text-decoration:none;"><i class="fas fa-home"></i> Dashboard</a></li>
                <li style="padding:8px 0;"><a href="../index.php" style="color:white; text-decoration:none;"><i class="fas fa-arrow-left"></i> Back Home</a></li>
                <li style="padding:8px 0;"><a href="logout.php" style="color:#ff6b6b; text-decoration:none;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="main-dashboard">
        <!-- Top Bar -->
        <div style="background:#fff; padding:15px 25px; border-bottom:1px solid #ddd; display:flex; justify-content:space-between; align-items:center;">
            <h5 style="margin:0; font-weight:bold;">University Verifier Portal</h5>
            <span>Logged in as: <b><?php echo htmlspecialchars($university_name); ?></b></span>
        </div>

        <section class="content text-dark" style="padding:20px;">
            <div class="container-fluid">

                <?php if(isset($_REQUEST['message'])): ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo htmlspecialchars($_REQUEST['message']); ?>
                    </div>
                <?php endif; ?>

                <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px;">
                    Applications from <?php echo htmlspecialchars($university_name); ?>
                </h4>
                <br>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <?php
                    $total    = $conn->query("SELECT COUNT(*) as c FROM bursary_application ba JOIN students s ON ba.student_id = s.student_id WHERE s.school = '$university_name'")->fetch_assoc()['c'];
                    $pending  = $conn->query("SELECT COUNT(*) as c FROM bursary_application ba JOIN students s ON ba.student_id = s.student_id WHERE s.school = '$university_name' AND ba.verified = 0")->fetch_assoc()['c'];
                    $verified = $conn->query("SELECT COUNT(*) as c FROM bursary_application ba JOIN students s ON ba.student_id = s.student_id WHERE s.school = '$university_name' AND ba.verified = 1")->fetch_assoc()['c'];
                    $rejected = $conn->query("SELECT COUNT(*) as c FROM bursary_application ba JOIN students s ON ba.student_id = s.student_id WHERE s.school = '$university_name' AND ba.verified = 2")->fetch_assoc()['c'];
                    ?>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-info"><i class="fas fa-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Applications</span>
                                <span class="info-box-number h5"><?php echo $total; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-warning"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pending Verification</span>
                                <span class="info-box-number h5"><?php echo $pending; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-success"><i class="fas fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Verified</span>
                                <span class="info-box-number h5"><?php echo $verified; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-danger"><i class="fas fa-times"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rejected</span>
                                <span class="info-box-number h5"><?php echo $rejected; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Student Applications</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Reg Number</th>
                                    <th>Phone</th>
                                    <th>Amount Requested</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT ba.*, s.fullname, s.school 
                                                 FROM bursary_application ba 
                                                 JOIN students s ON ba.student_id = s.student_id 
                                                 WHERE s.school = '$university_name'
                                                 ORDER BY ba.application_id DESC");
                            if($qry->num_rows > 0):
                                while($row = $qry->fetch_assoc()):
                                    // Determine status badge
                                    if($row['verified'] == 1) {
                                        $badge = '<span class="badge-verified">✔ Verified</span>';
                                    } elseif($row['verified'] == 2) {
                                        $badge = '<span class="badge-rejected">✘ Rejected</span>';
                                    } else {
                                        $badge = '<span class="badge-pending">⏳ Pending</span>';
                                    }
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                    <td><?php echo htmlspecialchars($row['reg_num']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td>KSh <?php echo number_format($row['total_amount'], 2); ?></td>
                                    <td><?php echo $badge; ?></td>
                                    <td>
                                        <?php if($row['verified'] == 0): ?>
                                        <!-- Verify Button -->
                                        <form action="backend/verify.php" method="post" style="display:inline;">
                                            <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">
                                            <input type="hidden" name="action" value="verify">
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirm verification for <?php echo htmlspecialchars($row['fullname']); ?>?')">
                                                <i class="fas fa-check"></i> Verify
                                            </button>
                                        </form>
                                        <!-- Reject Button -->
                                        <form action="backend/verify.php" method="post" style="display:inline;">
                                            <input type="hidden" name="application_id" value="<?php echo $row['application_id']; ?>">
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject application for <?php echo htmlspecialchars($row['fullname']); ?>?')">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                        <?php else: ?>
                                            <span class="text-muted">Already processed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center">No applications found from <?php echo htmlspecialchars($university_name); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>
<?php include_once("../admin/includes/footer.php"); ?>
</body>
</html>
