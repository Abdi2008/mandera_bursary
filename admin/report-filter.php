<?php
include_once("includes/header.php");
include_once("includes/dbconnection.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/newlogo.png">
    <style>
      .report-header {
        background: linear-gradient(135deg, #0f2744 0%, #1a3d6e 60%, #1e5799 100%);
        border-radius: 14px; padding: 24px 28px; margin-bottom: 24px;
        display: flex; align-items: center; gap: 16px;
        box-shadow: 0 8px 32px rgba(15,39,68,.25);
        position: relative; overflow: hidden;
      }
      .report-header-icon {
        width: 52px; height: 52px; background: rgba(255,255,255,.15);
        border-radius: 12px; display: flex; align-items: center;
        justify-content: center; font-size: 22px; color: #fff; flex-shrink: 0;
      }
      .report-header h4 { color:#fff !important; font-size:20px !important; font-weight:bold !important; margin:0 0 4px 0 !important; }
      .report-header p  { color:rgba(255,255,255,.65); font-size:13px; margin:0; }

      .filter-card {
        background:#fff; border-radius:12px; padding:24px 26px;
        margin-bottom:20px; box-shadow:0 2px 12px rgba(0,0,0,.07); border:1px solid #e8edf5;
      }
      .filter-card-title {
        font-size:15px; font-weight:bold; color:#0f2744; margin-bottom:18px;
        padding-bottom:12px; border-bottom:2px solid #eef1f7;
        display:flex; align-items:center; gap:8px;
      }
      .filter-card-title i { color:#1a6ecf; }
      .filter-label {
        font-size:11px; font-weight:700; color:#5a6a85;
        text-transform:uppercase; letter-spacing:.6px; margin-bottom:6px; display:block;
      }
      .filter-control {
        width:100%; border:1.5px solid #dde3ef !important; border-radius:8px !important;
        font-size:13px !important; color:#1a2540 !important; padding:8px 12px !important;
        height:auto !important; background:#fafbfd !important; display:block;
        transition:border-color .2s, box-shadow .2s;
      }
      .filter-control:focus {
        border-color:#1a6ecf !important; box-shadow:0 0 0 3px rgba(26,110,207,.12) !important;
        background:#fff !important; outline:none;
      }
      .filter-row { display:flex; flex-wrap:wrap; gap:16px; margin-bottom:16px; }
      .filter-col { flex:1; min-width:170px; }
      .btn-filter {
        background:linear-gradient(135deg,#1a6ecf,#0f4fa8); color:#fff !important;
        border:none; border-radius:8px; padding:9px 20px; font-size:13px; font-weight:600;
        cursor:pointer; box-shadow:0 4px 12px rgba(26,110,207,.3); transition:transform .15s;
      }
      .btn-filter:hover { transform:translateY(-2px); }
      .btn-clear {
        background:#f0f2f7; color:#5a6a85 !important; border:1.5px solid #dde3ef;
        border-radius:8px; padding:9px 18px; font-size:13px; font-weight:500;
        text-decoration:none !important; display:inline-block; transition:background .15s;
      }
      .btn-clear:hover { background:#e2e7f0; }
      .btn-pdf {
        background:linear-gradient(135deg,#16a34a,#0d7a34); color:#fff !important;
        border:none; border-radius:8px; padding:9px 18px; font-size:13px; font-weight:600;
        box-shadow:0 4px 12px rgba(22,163,74,.3); text-decoration:none !important;
        display:inline-flex; align-items:center; gap:6px; transition:transform .15s;
      }
      .btn-pdf:hover { transform:translateY(-2px); }
      .results-bar {
        display:flex; justify-content:space-between; align-items:center;
        background:#fff; border-radius:10px; padding:12px 18px; margin-bottom:14px;
        border:1px solid #e8edf5; box-shadow:0 2px 8px rgba(0,0,0,.04);
      }
      .results-count { font-size:14px; color:#5a6a85; font-weight:500; }
      .results-count strong { font-size:20px; color:#1a6ecf; margin-right:4px; }
      .filter-tag {
        display:inline-block; background:#eef4ff; color:#1a6ecf;
        border:1px solid #c7dcff; border-radius:20px; padding:3px 12px;
        font-size:12px; font-weight:500; margin:0 4px 6px 0;
      }
      .preview-wrapper {
        background:#fff; border-radius:12px; overflow:hidden;
        box-shadow:0 2px 12px rgba(0,0,0,.07); border:1px solid #e8edf5;
      }
      .preview-wrapper thead th {
        background:#0f2744 !important; color:#fff !important;
        font-size:11px; text-transform:uppercase; letter-spacing:.5px;
        padding:12px 14px !important; border:none !important; white-space:nowrap;
      }
      .preview-wrapper tbody td {
        padding:10px 14px !important; font-size:13px; color:#2d3a52;
        border-color:#f0f2f7 !important; vertical-align:middle !important;
      }
      .preview-wrapper tbody tr:hover td { background:#f5f8ff !important; }
      .badge-approved { background:#dcfce7; color:#15803d; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; border:1px solid #bbf7d0; }
      .badge-declined { background:#fee2e2; color:#dc2626; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; border:1px solid #fecaca; }
      .badge-pending  { background:#fef9c3; color:#92400e; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; border:1px solid #fde68a; }
      .empty-state { text-align:center; padding:40px 20px; color:#8a9ab5; }
      .empty-state i { font-size:36px; margin-bottom:10px; display:block; opacity:.4; }
    </style>
</head>
<body>
<?php include_once("includes/header.php"); ?>
<div class="dashboard-parent">
  <div class="aside-dashboard">
    <?php include_once("includes/navigation.php"); ?>
  </div>
  <div class="main-dashboard">
    <?php include_once("includes/topBar.php"); ?>
    <section class="content text-dark">
      <div class="container-fluid">

        <!-- Page Header -->
        <div class="report-header">
          <div class="report-header-icon"><i class="fas fa-file-alt"></i></div>
          <div>
            <h4>Generate Bursary Report</h4>
            <p>Filter applications by status, school, period or student — then preview and export to PDF</p>
          </div>
        </div>

        <!-- Filter Card -->
        <div class="filter-card">
          <div class="filter-card-title"><i class="fas fa-sliders-h"></i> Filter Options</div>
          <form method="GET" action="report-filter.php">
            <div class="filter-row">
              <div class="filter-col">
                <span class="filter-label">Application Status</span>
                <select name="status" class="filter-control">
                  <option value="">All Statuses</option>
                  <option value="Approved" <?php echo (isset($_GET['status']) && $_GET['status']=='Approved') ? 'selected':''; ?>>✔ Approved</option>
                  <option value="Declined" <?php echo (isset($_GET['status']) && $_GET['status']=='Declined') ? 'selected':''; ?>>✘ Declined</option>
                  <option value="Pending"  <?php echo (isset($_GET['status']) && $_GET['status']=='Pending')  ? 'selected':''; ?>>⏳ Pending</option>
                </select>
              </div>
              <div class="filter-col">
                <span class="filter-label">School / Institution</span>
                <select name="school" class="filter-control">
                  <option value="">All Schools</option>
                  <?php
                    $schools = $conn->query("SELECT DISTINCT school FROM students ORDER BY school ASC");
                    while($s = $schools->fetch_assoc()):
                      $sel = (isset($_GET['school']) && $_GET['school'] == $s['school']) ? 'selected' : '';
                  ?>
                    <option value="<?php echo htmlspecialchars($s['school']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($s['school']); ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="filter-col">
                <span class="filter-label">Bursary Period</span>
                <select name="period" class="filter-control">
                  <option value="">All Periods</option>
                  <?php
                    $periods = $conn->query("SELECT DISTINCT period_name FROM bursary_activity ORDER BY period_name ASC");
                    while($p = $periods->fetch_assoc()):
                      $sel = (isset($_GET['period']) && $_GET['period'] == $p['period_name']) ? 'selected' : '';
                  ?>
                    <option value="<?php echo htmlspecialchars($p['period_name']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($p['period_name']); ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
              <div class="filter-col">
                <span class="filter-label">Academic Year</span>
                <select name="year" class="filter-control">
                  <option value="">All Years</option>
                  <?php
                    $years = $conn->query("SELECT DISTINCT p_year FROM bursary_activity ORDER BY p_year DESC");
                    while($y = $years->fetch_assoc()):
                      $yr = intval($y['p_year']); $label = ($yr-1).'/'.$yr;
                      $sel = (isset($_GET['year']) && $_GET['year'] == $y['p_year']) ? 'selected' : '';
                  ?>
                    <option value="<?php echo $y['p_year']; ?>" <?php echo $sel; ?>><?php echo $label; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="filter-row">
              <div class="filter-col">
                <span class="filter-label">Search by Student Name</span>
                <input type="text" name="name" class="filter-control" placeholder="e.g. Ayub"
                       value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
              </div>
              <div class="filter-col">
                <span class="filter-label">Filter by Location / Ward</span>
                <input type="text" name="location" class="filter-control" placeholder="e.g. Mandera, Dirgale"
                       value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
              </div>
            </div>
            <div style="display:flex; gap:10px; margin-top:8px;">
              <button type="submit" class="btn-filter"><i class="fas fa-search"></i> Apply Filter & Preview</button>
              <a href="report-filter.php" class="btn-clear"><i class="fas fa-times"></i> Clear Filters</a>
            </div>
          </form>
        </div>

        <?php
          $where = [];
          if(!empty($_GET['status']))   $where[] = "ba.a_status = '"       . $conn->real_escape_string($_GET['status'])   . "'";
          if(!empty($_GET['school']))   $where[] = "s.school = '"           . $conn->real_escape_string($_GET['school'])   . "'";
          if(!empty($_GET['period']))   $where[] = "act.period_name = '"    . $conn->real_escape_string($_GET['period'])   . "'";
          if(!empty($_GET['year']))     $where[] = "act.p_year = '"         . $conn->real_escape_string($_GET['year'])     . "'";
          if(!empty($_GET['name']))     $where[] = "s.fullname LIKE '%"     . $conn->real_escape_string($_GET['name'])     . "%'";
          if(!empty($_GET['location'])) $where[] = "(ba.r_location LIKE '%" . $conn->real_escape_string($_GET['location']) . "%' OR ba.residence LIKE '%" . $conn->real_escape_string($_GET['location']) . "%')";
          $whereSQL = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

          $qry = $conn->query("SELECT ba.*, s.fullname, s.school, act.period_name, act.p_year
                               FROM bursary_application ba
                               JOIN students s ON ba.student_id = s.student_id
                               JOIN bursary_activity act ON ba.bursary_id = act.bursary_id
                               $whereSQL ORDER BY s.fullname ASC");
          $count = $qry->num_rows;

          $queryString = http_build_query(array_filter([
              'status'=>$_GET['status']??'', 'school'=>$_GET['school']??'',
              'period'=>$_GET['period']??'', 'year'=>$_GET['year']??'',
              'name'=>$_GET['name']??'', 'location'=>$_GET['location']??'',
          ]));

          $activeTags = [];
          if(!empty($_GET['status']))   $activeTags[] = 'Status: '   . $_GET['status'];
          if(!empty($_GET['school']))   $activeTags[] = 'School: '   . $_GET['school'];
          if(!empty($_GET['period']))   $activeTags[] = 'Period: '   . $_GET['period'];
          if(!empty($_GET['year']))     $activeTags[] = 'Year: '     . ($_GET['year']-1).'/'.$_GET['year'];
          if(!empty($_GET['name']))     $activeTags[] = 'Student: '  . $_GET['name'];
          if(!empty($_GET['location'])) $activeTags[] = 'Location: ' . $_GET['location'];
        ?>

        <?php if(!empty($activeTags)): ?>
          <div style="margin-bottom:14px;">
            <span style="font-size:12px;color:#8a9ab5;font-weight:600;">Active filters: </span>
            <?php foreach($activeTags as $tag): ?>
              <span class="filter-tag"><?php echo htmlspecialchars($tag); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="results-bar">
          <div class="results-count"><strong><?php echo $count; ?></strong> record<?php echo $count!=1?'s':''; ?> found</div>
          <?php if($count > 0): ?>
            <a href="pdf/generate-pdf.php?<?php echo $queryString; ?>" class="btn-pdf" target="_blank">
              <i class="fas fa-file-pdf"></i> Export as PDF
            </a>
          <?php endif; ?>
        </div>

        <div class="preview-wrapper">
          <table class="table table-bordered" style="margin:0;">
            <thead>
              <tr>
                <th>#</th><th>Full Name</th><th>Reg No.</th><th>School</th>
                <th>Period</th><th>Academic Year</th><th>Applied (KSh)</th>
                <th>Allocated (KSh)</th><th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php if($count > 0):
              $i = 1;
              while($row = $qry->fetch_assoc()):
                $yr = intval($row['p_year']); $academic_year = ($yr-1).'/'.$yr;
                if($row['a_status']=='Approved')     $badge='<span class="badge-approved">✔ Approved</span>';
                elseif($row['a_status']=='Declined') $badge='<span class="badge-declined">✘ Declined</span>';
                else                                 $badge='<span class="badge-pending">⏳ Pending</span>';
            ?>
              <tr>
                <td><?php echo $i++; ?></td>
                <td><b><?php echo htmlspecialchars($row['fullname']); ?></b></td>
                <td><?php echo htmlspecialchars($row['reg_num']); ?></td>
                <td><?php echo htmlspecialchars($row['school']); ?></td>
                <td><?php echo htmlspecialchars($row['period_name']); ?></td>
                <td><?php echo $academic_year; ?></td>
                <td>KSh <?php echo number_format($row['total_amount'],2); ?></td>
                <td>KSh <?php echo number_format($row['given_amount']??0,2); ?></td>
                <td><?php echo $badge; ?></td>
              </tr>
            <?php endwhile; else: ?>
              <tr><td colspan="9">
                <div class="empty-state">
                  <i class="fas fa-search"></i>
                  <p>No records found. Try adjusting your filters above.</p>
                </div>
              </td></tr>
            <?php endif; ?>
            </tbody>
            <?php if($count > 0):
              // Calculate totals
              $total_applied   = $conn->query("SELECT SUM(ba.total_amount) as t FROM bursary_application ba JOIN students s ON ba.student_id=s.student_id JOIN bursary_activity act ON ba.bursary_id=act.bursary_id $whereSQL")->fetch_assoc()['t'];
              $total_allocated = $conn->query("SELECT SUM(ba.given_amount) as t FROM bursary_application ba JOIN students s ON ba.student_id=s.student_id JOIN bursary_activity act ON ba.bursary_id=act.bursary_id $whereSQL")->fetch_assoc()['t'];
            ?>
            <tfoot>
              <tr style="background:#0f2744; color:#fff; font-weight:bold;">
                <td colspan="6" style="padding:12px 14px; text-align:right; font-size:13px; border:none;">TOTAL</td>
                <td style="padding:12px 14px; font-size:13px; border:none;">KSh <?php echo number_format($total_applied ?? 0, 2); ?></td>
                <td style="padding:12px 14px; font-size:13px; border:none; color:#4ade80;">KSh <?php echo number_format($total_allocated ?? 0, 2); ?></td>
                <td style="border:none;"></td>
              </tr>
            </tfoot>
            <?php endif; ?>
            </tbody>
          </table>
        </div>

      </div>
    </section>
  </div>
</div>
<?php include_once("includes/footer.php"); ?>
</body>
</html>