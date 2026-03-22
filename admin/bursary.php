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
        <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px">Bursary Applications</h4>
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
                <th>Fullname</th>
                <th>Reg No.</th>
                <th>School Name</th>
                <th>Period Name</th>
                <th>Applied Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i = 1;
              // Fixed: use COALESCE so NULL given_amount is treated as 0
              $qry = $conn->query("SELECT * FROM bursary_application 
                                   JOIN students ON bursary_application.student_id = students.student_id 
                                   JOIN bursary_activity ON bursary_application.bursary_id = bursary_activity.bursary_id 
                                   WHERE COALESCE(given_amount, 0) = 0");
              if($qry->num_rows > 0):
                while($row = $qry->fetch_assoc()):
                  $student_id = $row['student_id'];
            ?>
              <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                <td><?php echo htmlspecialchars($row['reg_num']); ?></td>
                <td><?php echo htmlspecialchars($row['school']); ?></td>
                <td><?php echo htmlspecialchars($row['period_name']); ?></td>
                <td>KSh <?php echo number_format($row['total_amount'], 2); ?></td>
                <td>
                  <a href="viewDetails.php?student_id=<?php echo $student_id; ?>">
                    <span class="fa fa-eye text-primary"></span> View Details
                  </a>
                </td>
              </tr>
            <?php
                endwhile;
              else:
            ?>
              <tr>
                <td colspan="7" class="text-center">No pending applications found.</td>
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
