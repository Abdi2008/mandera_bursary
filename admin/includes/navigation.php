<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- Main Sidebar Container -->
  <section class="sidebar-dark">
       <div class="bran-logo">
          <div class="bb-logo">
             <img src="../images/newlogo.png" alt="Store Logo">
          </div>   
       </div>
              <!-- Sidebar -->
              <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div><br>
                <br><br>
                <!-- Sidebar Menu -->
                <nav class="mt-1">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="dashboard.php" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt" style="color:white;"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="student.php" class="nav-link nav-prisons">
                        <i class="nav-icon fas fa-users" style="color:white;"></i>
                        <p>
                          Students
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="category.php" class="nav-link nav-prisons">
                        <i class="nav-icon fas fa-th-list" style="color:white;"></i>
                        <p>
                          Busary Period
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="bursary.php" class="nav-link nav-prisons">
                        <i class="nav-icon fas fa-school" style="color:white;"></i>
                        <p>
                          Busaries Applications
                        </p>
                      </a>
                    </li> 
                    
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-users" style="color:white;"></i>
                        <p>
                        Busary Management
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview" style="display: none;">
                      <?php    
                     // $select = mysqli_query($conn,"select * from years");
                      // while($rowlist=mysqli_fetch_array($select)){
                          //$intake_year = $rowlist['y_year'];
                        ?>
                           <li class="nav-item">
                          <a href="approved.php" class="nav-link tree-item nav-reports_record_history">
                            <i class="far fa-circle nav-icon" style="color:white;"></i>
                            <p>Approved Busaries</p>
                          </a>
                          <a href="declined.php" class="nav-link tree-item nav-reports_record_history">
                            <i class="far fa-circle nav-icon" style="color:white;"></i>
                            <p> Declined Busaries</p>
                          </a>
                        </li>
                        <?php
                      // }
                      ?>
                      </ul>
                    </li> 

                    <li class="nav-item dropdown">
                      <a href="report-filter.php" class="nav-link nav-prisons">
                        <i class="nav-icon fas fa-th-list" style="color:white;"></i>
                        <p>
                          Generate Report
                        </p>
                      </a>
                    </li> 

                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
</section>
</body>
</html>