<?php include_once("includes/header.php") ;?>
<?php include_once("includes/dbconnection.php") ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="icon" href="images/logo.jpeg">
</head>
<body>
<?php include_once("includes/header.php"); ?>
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
		<h4 style="font-weight:bold; font-size:20px;letter-spacing:1.5px"> Students Info</h4>
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
			<table class="table table-hover table-striped table-bordered" id="list">
				<thead>
					<tr>
						<th>#</th>
						<th>Fullnames</th>
	          <th>Email</th>
            <th>School Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
        <?php 
					$i = 1;
					$qry = $conn->query("SELECT * from `students` where del=1");
						while($row = $qry->fetch_assoc()):
							$student_id = $row['student_id'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo $row['fullname']; ?></td>
							<td class=""><?php echo $row['email']; ?></td>
							<td class=""><?php echo $row['school']; ?></td>
							<td align="center">
                 <a class="dropdown-item edit-data" href="studentDelete.php?student_id=<?php echo $student_id; ?>"><span class="fa fa-trash text-primary"></span> Remove Student</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
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
          <h4 class="modal-title">Add New User</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="backend/user.php" method="post">
            <div class="form-group">
                    <label for="status" class="control-label">Username</label>
                    <input type="text" name="username" id="name" class="form-control form-control-sm rounded-0" required/> 
            </div>
            <div class="form-group">
                <label for="name" class="control-label">Email</label>
                <input type="email" name="email" id="name" class="form-control form-control-sm rounded-0" required/>
		        </div>
            <div class="form-group">
                <label for="name" class="control-label">Password</label>
                <input type="password" name="password" id="name" class="form-control form-control-sm rounded-0" required/>
		    </div>
            <div class="form-group">
                <label for="password" class="control-label">Confirm Password</label>
                <input type="password" name="cpassword" id="name" class="form-control form-control-sm rounded-0" required/>
		    </div>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Add User">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</div>
<?php include_once("includes/footer.php");?>
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