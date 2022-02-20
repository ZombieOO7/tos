<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM users WHERE status='0' ORDER BY id DESC;";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	{ 
	  header('Location: home.php'); 
	}
}
else
{
	session_destroy();
	header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="view_users"; ?>
<!-- Main navbar -->
<?php include 'header.php'; ?>
<!-- /main navbar -->
		<!-- Page container -->
		<div class="page-container">
			<!-- Page content start-->
			<div class="page-content">
				<!-- siderbar start -->
				<?php include 'sidebar.php'; ?>
				<!-- siderbar end -->		
				<!-- Main content -->
				<div class="content-wrapper">
					<div class="page-header page-header-default">
						<div class="page-header-content">
							<div class="page-title">
								<h2 class="no-margin text-light">LIST USERS</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<table class="table datatable-basic-uo table-striped table-bordered">
											<thead>
												<tr>
													<th>User Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Role</th>
													<th style="display: none;"></th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ 
												?>
													<tr>
														<td><?=$result['fname']." ".$result['lname'];?></td>
														<td><?=$result['username'];?></td>
														<td><?=$result['phone'];?></td>
														<?php
															$sqlr="SELECT role_name FROM roles WHERE id='".$result['role_id']."';";
															$qr=$conn->query($sqlr);
															$roleData=$qr->fetchAll(PDO::FETCH_ASSOC);
														?>
														<td><?=$roleData[0]['role_name'];?></td>
														<td>
															<ul class="icons-list">
																<li class="text-primary-600">
																	<a href="edit_user.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
																</li>
																<?php if($result['role_id']!=="1"){ ?>
																	<li class="text-primary-600">
																		<a data-id="<?=$result['id'];?>" class="modelopen" data-popup="tooltip" data-original-title="Delete"><i class="icon-trash" disabled></i></a>
																	</li>
																<?php } ?>
															</ul>
														</td>
													</tr>
												<?php }} ?>
											</tbody>
										</table>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Main content -->
			</div>
		<!-- Page content end-->
		</div>
<!-- Page container end-->	
<script type="text/javascript">
$(document).ready(function(){
	$('.modelopen').on('click', function (e) {
	e.preventDefault();
	var u_id =$(this).data('id');

    if(u_id=="")
    {
      	return false;
    }
    else
    {	
    	swal({
    		title: 'Are You Sure ?',
    		text: 'Delete This User',
    		type: 'warning',
    		showCancelButton: true,
    		confirmButtonColor: '#EF5350',
    		confirmButtonText: 'Yes, Delete',
    		cancelButtonText: 'No, Cancel',
    		closeOnConfirm: true,
    		closeOnCancel: true
    	},
    	function(isConfirm)
    	{
    		if (isConfirm) 
    		{
    			$.ajax({
		            type: 'POST',
		            url: '<?=ROOT_URL;?>models/delete_user.php',
		            data:{'u_id':u_id},
		            /*dataType:'json',*/
		            success: function (response) 
		            {
		            	window.location.reload();
		            }
        		});
    		}
    	});
    }
});

});
</script>
<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
	</body>

</html>
