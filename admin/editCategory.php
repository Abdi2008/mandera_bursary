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
		<h4 style="font-weight:bold; font-size:20px;letter-spacing:1.5px"> Update Category</h4>
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
			   <form action="backend/updateCategory.php" method="post">
             <?php 
                $category_id = $_REQUEST['category_id'];
				$qry = $conn->query("SELECT * from category where category_id='$category_id'");
			   $row = $qry->fetch_assoc();
					?>
            <div class="form-group">
                <label for="name" class="control-label">Category Name</label>
                <input type="text" name="category_name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo $row['category_name'] ?>" required/>
		    </div>
            <div class="form-group">
                <label for="name" class="control-label">Duration (In months)</label>
                <input type="text" name="total_number" id="name" class="form-control form-control-sm rounded-0" value="<?php echo $row['duration_month'] ?>" required/>
		    </div>
            <div class="form-group">
                <label for="name" class="control-label">Amount to be given</label>
                <input type="text" name="amount" id="name" class="form-control form-control-sm rounded-0" value="<?php echo $row['amount'] ?>" required/>
		    </div>
            <input type="hidden" name="category_id" value="<?php echo $category_id;  ?>">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Update Stream">
        </div>
        </form>
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
          <h4 class="modal-title">Add New Stream</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="backend/stream.php" method="post">
            <div class="form-group">
                    <label for="status" class="control-label">Classroom</label>
                    <select name="classroom_id" id="status" class="form-control form-control-sm rounded-0" required="required">
                        <?php 
                        $classroom = $conn->query("SELECT * FROM `classroom`");
                        while($row = $classroom->fetch_assoc()):
                        ?>
                        <option value="<?php echo $row['classroom_id'] ;?>"><?php echo $row['class_name'];?></option>
                        <?php endwhile; ?>
                    </select>
		     </div>
            <div class="form-group">
                <label for="name" class="control-label">Stream Name</label>
                <input type="text" name="stream_name" id="name" class="form-control form-control-sm rounded-0" required/>
		        </div>
            <div class="form-group">
                <label for="name" class="control-label">Total Student(Maximum Number of student)</label>
                <input type="text" name="total_number" id="name" class="form-control form-control-sm rounded-0" required/>
		        </div>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Add Stream">
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