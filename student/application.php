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
        <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px">My Bursary Application</h4>
      </div>
      <div class="card-body">
        <div class="container-fluid">

          <?php if(isset($_REQUEST['message'])): ?>
            <div class="alert alert-info alert-dismissible fade show">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> <?php echo $_REQUEST['message']; ?>
            </div>
          <?php endif; ?>

          <table class="table table-hover table-striped table-bordered" id="list">
            <thead>
              <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Reg No.</th>
                <th>Period Name</th>
                <th>Academic Year</th>
                <th>Applied Amount</th>  <!-- Amount Given removed -->
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i = 1;
              // Only fetch applications for the logged-in student
              $student_id = $_SESSION['student_id'];

              $stmt = $conn->prepare("SELECT bursary_application.*, students.fullname,
                                             bursary_activity.period_name, bursary_activity.p_year
                                      FROM bursary_application
                                      JOIN students ON bursary_application.student_id = students.student_id
                                      JOIN bursary_activity ON bursary_application.bursary_id = bursary_activity.bursary_id
                                      WHERE bursary_application.student_id = ?");
              $stmt->bind_param("i", $student_id);
              $stmt->execute();
              $qry = $stmt->get_result();

              if($qry->num_rows > 0):
                while($row = $qry->fetch_assoc()):
                  // Format year as 2025/2026
                  $yr = intval($row['p_year']);
                  $academic_year = ($yr - 1) . '/' . $yr;

                  // Status badge color
                  if($row['a_status'] == 'Approved') {
                      $badge = '<span style="background:#28a745;color:white;padding:3px 10px;border-radius:12px;">Approved</span>';
                  } elseif($row['a_status'] == 'Declined') {
                      $badge = '<span style="background:#dc3545;color:white;padding:3px 10px;border-radius:12px;">Declined</span>';
                  } else {
                      $badge = '<span style="background:#ffc107;color:black;padding:3px 10px;border-radius:12px;">Pending</span>';
                  }
            ?>
              <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                <td><?php echo htmlspecialchars($row['reg_num']); ?></td>
                <td><?php echo htmlspecialchars($row['period_name']); ?></td>
                <td><?php echo $academic_year; ?></td>
                <td>KSh <?php echo number_format($row['total_amount'], 2); ?></td>
                <td><?php echo $badge; ?></td>
              </tr>
            <?php
                endwhile;
              else:
            ?>
              <tr>
                <td colspan="7" class="text-center">You have not submitted any bursary applications yet.</td>
              </tr>
            <?php endif; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
  </section>
</div>
<?php include_once("../admin/includes/footer.php"); ?>
<script>
  $(document).ready(function(){
    $('.table').dataTable({
      columnDefs: [{ orderable: false, targets: [6] }],
      order: [0, 'asc']
    });
    $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle');
  });
</script>
</body>
</html>
