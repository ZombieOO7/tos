<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{

	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="add_newsletter"; ?>
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
						<h2 class="no-margin text-light">ADD NEWS-LETTER</h2>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="panel panel-flat">
							<div class="panel-body">
								<form action="<?=ROOT_URL;?>models/add_newsletter.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="add_newsletter">
									<div class="col-md-12 col-sm-12">
										<div class="form-group ">
											<label for="n_subject">Subject <span style="color:#FF0000;">*</span>:</label>
											<input type="text" class="form-control" name="n_subject" id="n_subject"  placeholder="Enter News-Letter Subject" required>
										</div>
										<div class="form-group">
											<label for="n_content">Content <span style="color:#F00;">*</span>:</label>
											<textarea name="n_content" id="n_content" required></textarea>
										</div>
									</div>
									<div class="row">
										<div class="form-group ">
											<div class="col-md-12 col-sm-12" align="center">
												<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Add</button>
											</div>
										</div>
									</div>
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

		CKEDITOR.replace('n_content', {
        	height: 500,
   		});


		$('#btnsubmit').on('click',function()
		{
			if ($('#add_newsletter').valid()==true) 
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
