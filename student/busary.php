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
		<h4 style="font-weight:bold; font-size:20px;letter-spacing:1.5px"> Available Bursary</h4>
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
						<th>Period Name</th>
						<th>Cash allocated</th>
						<th>Year</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
					$qry = $conn->query("SELECT * from `bursary_activity`");
						while($row = $qry->fetch_assoc()):
							$bursary_id = $row['bursary_id'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo $row['period_name'] ?></td>
							<td class=""><?php echo $row['amount'] ?></td>
							<td class=""><?php echo $row['p_year'] ?></td>
							<td align="center">
                                 <button class="btn btn-primary"><a href="apply.php?bursary_id=<?php echo $bursary_id; ?>" style="color:white;"> Apply Now</a></button>
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
          <h4 class="modal-title">Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="backend/category.php" method="post">
            <div class="form-group">
                <label for="name" class="control-label">Category Name</label>
                <input type="text" name="category_name" id="name" class="form-control form-control-sm rounded-0" required/>
		        </div>
            <div class="form-group">
                <label for="name" class="control-label">Amount a location</label>
                <input type="text" name="total_amount" id="name" class="form-control form-control-sm rounded-0" required/>
		    </div>
            <div class="form-group">
                <label for="name" class="control-label">Duration (in Month)</label>
                <input type="text" name="d_month" id="name" class="form-control form-control-sm rounded-0" required/>
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