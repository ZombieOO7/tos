<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	extract($_GET);

	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM customers WHERE id='$id' ;";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="edit_customer"; ?>
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
								<h2 class="no-margin text-light">EDIT CUSTOMER</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/edit_customer.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="edit_cust">
											<?php if(!empty($results)){ foreach ($results as $result) { ?>
												<input type="hidden" name="cust_id" value="<?=$result['id'] ;?>">
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<label for="cust_name">Customer Name <span style="color:#FF0000;">*</span>:</label>
													<input type="text" class="form-control" name="cust_name" id="cust_name"  placeholder="First & Last Name" value="<?=$result['cust_name']; ?>" required>
												</div>
												<div class="form-group ">
													<label for="cust_phone">Phone No <span style="color:#FF0000;">*</span>:</label>
													<input type="text" class="form-control" name="cust_phone" id="cust_phone"  placeholder="9999999999" value="<?=$result['cust_phone']; ?>" required>
												</div>
												<div class="form-group ">
													<label for="cust_email">Email Id <span style="color:#FF0000;">*</span>:</label>
													<input type="email" class="form-control" name="cust_email" id="cust_email"  placeholder="Enter Customer Email" value="<?=$result['cust_email']; ?>" required >
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<label for="cust_pass">Enter Password <span style="color:#FF0000;">*</span>:</label>
													<input type="password" class="form-control" name="cust_pass" id="cust_pass" placeholder="Enter Password" required autocomplete="off" >
												</div>
												<div class="form-group">
													<label for="cust_profile">Upload Profile Picture :</label>
													<input type="file" class="form-control file-upload" name="cust_profile" id="cust_profile" accept="image/x-png,image/jpeg,image/jpg"  placeholder="Upload Photo">
												</div>
											</div>
											<div class="row">
												<div class="form-group ">
													<div class="col-md-12 col-sm-12" align="center">
														<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Update</button>
													</div>
												</div>
											</div>
										<?php }} ?>
										</form>
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
<!-- FOOTER START -->
<script type="text/javascript">
$(document).ready(function() { 
	$('#btnsubmit').on('click',function()
  	{
	    if ($('#edit_cust').valid()==true) 
	   	{
	        setTimeout(function () { disableButton(); }, 0);
	    }
  	});
});

function disableButton() 
{
    $("#btnsubmit").html('<b><i class="icon-spinner6"></i></b>Updating...Please wait').attr('disabled','disabled');
}
</script>
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
