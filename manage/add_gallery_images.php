<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{

	}else{ header('LOCATION: home.php'); }	
}
else
{
	header('LOCATION: index.php'); 
}

?>
<!DOCTYPE html>
<html lang="en">
<?php $page="add_gallery_images"; ?>
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
								<h2 class="no-margin text-light">ADD GALLERY</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL; ?>models/add_gallery_images.php" method="post" enctype="multipart/form-data">
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="gallery_file">Upload Images : <span style="color:#F00;">*</span></label>
													<input type="file" class="form-control file-upload" name="gallery_file[]" multiple="multiple" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group" style="margin-top: 25px;">
													<button type="submit" class="btn btn-success btn-labeled" name="submit"><b><i class="icon-check"></i></b>Submit</button>
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
<?php include 'footer.php'; ?>
