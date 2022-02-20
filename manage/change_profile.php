<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{

} 
else
{ 
 	header('LOCATION: index.php'); 
} 
?>

<?php $page="change_profile"; ?>
<!-- Main navbar -->
<?php include'header.php'; ?>
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
								<h2 class="no-margin text-light">CHANGE PROFILE PICTURE- <?=$_SESSION['username'];?></h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="panel panel-flat">
								<!-- add org form -->
								<div class="panel-body">
									<form action="<?=ROOT_URL;?>models/change_profile.php" method="post" enctype="multipart/form-data">

									<div class="col-md-12 col-sm-12">

										<div class="form-group ">
											<label for="profile">Upload Profile Picture <span style="color:red;">*</span> : </label>
											<input type="file" class="form-control file-upload" name="profile" id="profile" placeholder="Upload Profile Picture" >
										</div>
										
									</div>

									<div class="row">
										<div class="col-md-6 col-sm-12 col-md-offset-3">
										<div class="form-group ">
												<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Save</button>
												<a href="home.php" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
										</div>
										</div>
									</div>

									</form>
								</div>

							</div>
							<!-- /add org form -->
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
<?php include 'footer.php'; ?>
<!-- FOOTER END -->
</body>

</html>