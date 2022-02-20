<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id'])){

 } 
 else{ 
 	header('LOCATION: index.php'); 
 } 
 ?>

 <?php $page="change_password"; ?>
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
								<h2 class="no-margin text-light">CHANGE PASSWORD- <?=$_SESSION['username'];?></h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="panel panel-flat">
								<!-- add org form -->
								<div class="panel-body">
									<form action="<?=ROOT_URL;?>models/change_password.php" class="validate-change-password" method="post">

									<div class="col-md-12 col-sm-12">

										<div class="form-group ">
											<label for="oldpass">Enter Old Password <span style="color:red;">*</span> : </label>
											<input type="password" class="form-control" name="oldpass" id="oldpass" required placeholder="Enter Old Password" >
										</div>

										<div class="form-group ">
											<label for="newpass">Enter New Password <span style="color:red;">*</span> : </label>
											<input type="password" class="form-control" name="newpass" id="newpass" required placeholder="Enter New Password" >
										</div>

										<div class="form-group ">
											<label for="confirmpass">Confirm New Password <span style="color:red;">*</span> : </label>
											<input type="password" class="form-control" name="confirmpass" id="confirmpass" required placeholder="Confirm New Password" >
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