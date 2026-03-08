<?php include_once("includes/dbconnection.php") ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../images/newlogo.png">
<style>
.sidetail{
    display:flex;
    justify-content:space-around;
}
.side-11{
    flex-basis:30%;
}
</style>
</head>
<body>
<?php include_once("../admin/includes/header.php"); ?>
<div class="dashboard-parent">
  <div class="aside-dashboard">
  <?php include_once("includes/navigation.php");?>
  </div>
  <div class="main-dashboard">
  <?php include_once("includes/topBar.php");?>  
             <!-- Main content -->
             <section class="content  text-dark">
          <!-- <div class="card card-outline rounded-0 card-navy"> -->
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
			<?php 
                    $student_id = $_REQUEST['student_id'];
					$i = 1;
					$qry = $conn->query("SELECT * from `bursary_application` join students on  bursary_application.student_id=students.student_id join bursary_activity on bursary_application.bursary_id=bursary_activity.bursary_id");
					$row = $qry->fetch_assoc();	
					?>
            <div class="details">
                  <h3>Student fullname : <?php echo $row['fullname']; ?></h3>
                  <hr>
            <div class="sidetail">
                <div class="side-11">
                    <h2>Personal Info</h2>
                    <p><b>Gender: </b><?php echo $row['gender']; ?></p>
                    <p><b>Reg Number:</b> <?php echo $row['reg_num']; ?></p>
                    <p><b>Phone Number:</b> <?php echo $row['phone']; ?></p>
                    <p><b>Guardian:</b> <?php echo $row['guardian']; ?></p>
                </div>
                <div class="side-11">
                    <h2>Residence info</h2>
                    <p><b>Residence:</b> <?php echo $row['residence']; ?></p>
                    <p><b>Sub Location:</b> <?php echo $row['sub_location']; ?></p>
                    <p><b>Village:</b> <?php echo $row['village']; ?></p>
                    <p><b>Location: </b><?php echo $row['r_location']; ?></p>
                </div>
                <div class="side-11">
                           <h2>School Info</h2>
                    <p><b>Residence: </b><?php echo $row['school']; ?></p>
                    <p><b>School Location:</b> <?php echo $row['town']; ?></p>
                    <p><b>Account Number: </b><?php echo $row['account']; ?></p>
                    <p><b>Amount Requested:</b> <?php echo $row['total_amount']; ?> Kshs</p>
                </div>
            </div>
               
            </div>
		</div>
        <hr>
        <div class="bbton">
                <div class="ton-de">
                     <button class="btn btn-primary"><a href="approve.php?student_id=<?php echo $student_id; ?>" style="color:white;">Approve Bursary</a></button>
                     <button class="btn btn-danger"><a href="decline.phpstudent_id=<?php echo $student_id; ?>" style="color:white;">Decline Bursary</a></button>
                </div>
        </div>
	</div>
</div>

</div>

         </div>
        </section>
        <!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Period</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="backend/period.php" method="post">
            <div class="form-group">
                <label for="name" class="control-label">Period</label>
				<select name="period_name" id="" class="form-control form-control-sm rounded-0" required>
					 <option value="">~~~ Select period ~~~</option>
					 <option value="Jan to April">Jan to April</option>
					 <option value="May to Aug">May to Aug</option>
					 <option value="Sep to Dec">Sep to Dec</option>
				</select>
		    </div>
            <div class="form-group">
                <label for="name" class="control-label">Amount a location</label>
                <input type="text" name="total_amount" id="name" class="form-control form-control-sm rounded-0" required/>
		    </div>
          
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Add Category">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include_once("../admin/includes/footer.php");?>
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