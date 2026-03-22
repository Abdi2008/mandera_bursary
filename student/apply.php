<?php include_once("includes/dbconnection.php") ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../images/logo.jpeg">
</head>
<body>
<?php include_once("../admin/includes/header.php");?>
<div class="dashboard-parent">
  <div class="aside-dashboard">
  <?php include_once("includes/navigation.php");?>
  </div>
  <div class="main-dashboard">
  <?php include_once("includes/topBar.php");?>  
             <!-- Main content -->
             <section class="content  text-dark">
          <!-- <div class="card card-outline rounded-0 card-navy"> -->
	<div class="card-header" style="border-bottom:none !important;">
		<h4 style="font-weight:bold; font-size:20px;letter-spacing:1.5px"> Bursary</h4>
		<div class="card-tools">
        </div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			
        <?php 
            if(isset($_REQUEST['message']))
                {
                  $message = $_REQUEST['message'];
                  echo '<div class="alert alert-info alert-dismissible fade show">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success!</strong>
                  '.$message.'</div>';
                }
            ?>
			<div class="content py-4 bg-gradient-navy px-3">
    <h4 class="mb-0"><?= isset($id) ? "Update Inmate" : "Bursary Application form" ?></h4>
</div>
<div class="row mt-n4 justify-content-center align-items-center flex-column">
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <div class="card rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid">
                    <?php    
                       $student_id = $_SESSION['student_id'];
                       $select = mysqli_query($conn,"select * from students where student_id='$student_id'");
                       $rowdata = mysqli_fetch_array($select);
                    ?>
                    <form action="backend/apply.php" method="post" id="inmate-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="code" class="control-label">Fullname</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="" id="code"  value="<?php echo $rowdata['fullname'];?>" readonly="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="cell_id" class="control-label">Gender</label>
                                        <select class="form-control form-control-sm rounded-0" name="gender" id="cell_id" required="required">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="firstname" class="control-label">Reg.No</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="reg_num" id="firstname" required="required" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="middlename" class="control-label">Phone</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="phone" id="middlename" placeholder="" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="lastname" class="control-label">Name of guardian</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="guardian" id="lastname" required="required" value="">
                                </div>
                            </div>
                        </div>
                        <fieldset class="border px-2 py-2">
                            <legend class="w-auto mx-3" >Area of Residence</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_from" class="control-label">Ward</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="residence" id="date_from" required="required" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_to" class="control-label">Location</label>
                                        <input type="text" class="form-cotextntrol form-control-sm rounded-0" name="r_location" id="date_to" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_from" class="control-label">Sub-Location</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="sub_location" id="date_from" required="required" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="date_to" class="control-label">Village</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="village" id="date_to" value="">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border px-2 py-2">
                            <legend class="w-auto mx-3" >School Information</legend>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_name" class="control-label">Instution Name</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="" id="emergency_name" value="<?php echo $rowdata['school'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_relation" class="control-label">Account N.o</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="account" id="emergency_relation" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_contact" class="control-label">Bank</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="bank" id="emergency_contact" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_name" class="control-label">Telephone N.o</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="tel_num" id="emergency_name" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_relation" class="control-label">Location (town)</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="town" id="emergency_relation" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="emergency_contact" class="control-label">Physical address</label>
                                        <input type="text" class="form-control form-control-sm rounded-0" name="address" id="emergency_contact" value="">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="address" class="control-label">Total cost of your education per semister (in Kshs):</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="total_amount" id="address" required="required">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id;  ?>">
                                </div>
                            </div>
                        </div>
                        <?php   
                          $bursary_id = $_REQUEST['bursary_id'] ?? null;
                        ?>
                        <input type="hidden" name="bursary_id" value="<?php echo $bursary_id; ?>">
                    </form>
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <button class="btn btn-flat btn-sm btn-navy bg-gradient-navy" form="inmate-form"><i class="fa fa-save"></i> Apply</button>
                <?php if(!isset($id)): ?>
                <a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="./?page=inmates"><i class="fa fa-angle-left"></i> Cancel</a>
                <?php else: ?>
                <a class="btn btn-flat btn-sm btn-light bg-gradient-light border" href="./?page=inmates/view_inmate&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-angle-left"></i> Cancel</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
		</div>
	</div>
</div>

</div>

         </div>
        </section>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Prison permanently?","delete_prison",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='far fa-plus-square'></i> Add New Prison ","prisons/manage_prison.php")
		})
		$('.edit-data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Add New Prison ","prisons/manage_prison.php?id="+$(this).attr('data-id'))
		})
		$('.view-data').click(function(){
			uni_modal("<i class='fa fa-th-list'></i> Prison Details ","prisons/view_prison.php?id="+$(this).attr('data-id'))
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_prison($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_prison",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
</body>
</html>