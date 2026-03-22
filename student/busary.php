<?php include_once("includes/dbconnection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo.jpeg">
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
        <h4 style="font-weight:bold; font-size:20px; letter-spacing:1.5px">Available Bursary</h4>
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
                <th>Period Name</th>
                <th>Academic Year</th>  <!-- No Cash Allocated column -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $i = 1;
              $qry = $conn->query("SELECT * FROM bursary_activity");
              while($row = $qry->fetch_assoc()):
                $bursary_id = $row['bursary_id'];

                // Format year as university format: e.g. 2026 → 2025/2026
                $yr = intval($row['p_year']);
                $academic_year = ($yr - 1) . '/' . $yr;
            ?>
              <tr>
                <td class="text-center"><?php echo $i++; ?></td>
                <td><?php echo htmlspecialchars($row['period_name']); ?></td>
                <td><?php echo $academic_year; ?></td>
                <td align="center">
                  <button class="btn btn-primary">
                    <a href="apply.php?bursary_id=<?php echo $bursary_id; ?>" style="color:white;">Apply Now</a>
                  </button>
                </td>
              </tr>
            <?php endwhile; ?>
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
      columnDefs: [{ orderable: false, targets: [3] }],
      order: [0, 'asc']
    });
    $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle');
  });
</script>
</body>
</html>
