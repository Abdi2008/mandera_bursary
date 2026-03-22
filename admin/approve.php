<?php include_once("includes/dbconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/newlogo.png">
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
      <div class="card-header" style="border-bottom:none !important;">
        <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px">Approve Bursary Application</h4>
      </div>
      <div class="card-body">
        <div class="container-fluid">

          <?php if(isset($_REQUEST['message'])): ?>
            <div class="alert alert-info alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> <?php echo $_REQUEST['message']; ?>
            </div>
          <?php endif; ?>

          <?php
            // Get student and application info
            $student_id = $_REQUEST['student_id'];
            $info = $conn->query("SELECT ba.*, s.fullname, s.school, act.period_name, act.amount, act.p_year
                                  FROM bursary_application ba
                                  JOIN students s ON ba.student_id = s.student_id
                                  JOIN bursary_activity act ON ba.bursary_id = act.bursary_id
                                  WHERE ba.student_id = '$student_id'
                                  ORDER BY ba.application_id DESC LIMIT 1");
            $student = $info->fetch_assoc();

            // Format academic year
            $yr = intval($student['p_year']);
            $academic_year = ($yr - 1) . '/' . $yr;
          ?>

          <!-- Student Summary Card -->
          <div class="card mb-4" style="border-left: 4px solid #007bff;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <p><b>Student Name:</b> <?php echo htmlspecialchars($student['fullname']); ?></p>
                  <p><b>School:</b> <?php echo htmlspecialchars($student['school']); ?></p>
                </div>
                <div class="col-md-4">
                  <p><b>Period:</b> <?php echo htmlspecialchars($student['period_name']); ?></p>
                  <p><b>Academic Year:</b> <?php echo $academic_year; ?></p>
                </div>
                <div class="col-md-4">
                  <p><b>Amount Requested:</b> <span class="text-danger font-weight-bold">KSh <?php echo number_format($student['total_amount'], 2); ?></span></p>
                  <p><b>Total Pool for Period:</b> KSh <?php echo number_format($student['amount'], 2); ?></p>
                </div>
              </div>
            </div>
          </div>

          <!-- Approve Form -->
          <form action="backend/give.php" method="post">
            <div class="form-group">
              <label class="control-label font-weight-bold">Select Amount to Allocate (KSh)</label>
              <select name="total" class="form-control form-control-sm rounded-0" required>
                <option value="">~~~ Select an amount ~~~</option>
                <?php
                  // Pull all predefined amounts from bursary_activity as options
                  $amounts = $conn->query("SELECT DISTINCT amount, period_name, p_year FROM bursary_activity ORDER BY amount ASC");
                  while($amt = $amounts->fetch_assoc()):
                    $yr2 = intval($amt['p_year']);
                    $label_year = ($yr2 - 1) . '/' . $yr2;
                ?>
                  <option value="<?php echo $amt['amount']; ?>">
                    KSh <?php echo number_format($amt['amount'], 2); ?> — <?php echo htmlspecialchars($amt['period_name']); ?> (<?php echo $label_year; ?>)
                  </option>
                <?php endwhile; ?>

                <!-- Common fixed bursary amounts -->
                <option value="5000">KSh 5,000.00 — Partial Support</option>
                <option value="10000">KSh 10,000.00 — Standard Support</option>
                <option value="15000">KSh 15,000.00 — Enhanced Support</option>
                <option value="20000">KSh 20,000.00 — Full Semester</option>
                <option value="25000">KSh 25,000.00 — Full Semester Plus</option>
                <option value="30000">KSh 30,000.00 — Annual Support</option>
                <option value="50000">KSh 50,000.00 — Full Annual</option>
              </select>
              <small class="text-muted">Choose the amount to award this student. This cannot be changed after approval.</small>
            </div>

            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

            <div class="mt-3">
              <input type="submit" class="btn btn-success"
                     value=" Approve & Allocate"
                     onclick="return confirm('Are you sure you want to approve this application and allocate the selected amount?')">
              <a href="bursary.php" class="btn btn-secondary ml-2">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  </section>
</div>
<?php include_once("../admin/includes/footer.php"); ?>
</body>
</html>