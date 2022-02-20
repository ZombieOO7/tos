<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		if(isset($_GET['id']))
		{
			extract($_GET);
			$sqlu="SELECT * FROM users WHERE id='$id';";
			$qu=$conn->query($sqlu);
			$users=$qu->fetchAll(PDO::FETCH_ASSOC);
		}

		$sql="SELECT * FROM roles;";
		$q=$conn->query($sql);
		$roles=$q->fetchAll(PDO::FETCH_ASSOC);

	}else{ header('Location: home.php'); }
}
else
{
	session_destroy();
	echo '<script>window.location.href = "../index.php";</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="edit_user"; ?>
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
								<h2 class="no-margin text-light">EDIT USER</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/edit_user.php" method="post" class="validate-add-user" enctype="multipart/form-data">
											<?php if(!empty($users)){ foreach($users as $user){ ?>
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<input type="hidden" name="id" id="id" value="<?=$id;?>" required>
													<label for="u_name">Enter Full Name <span style="color:#FF0000;">*</span>:</label>
													<input type="text" class="form-control" name="u_name" id="u_name"  placeholder="First & Last Name" value="<?=$user['fname']." ".$user['lname'] ;?>" required>
												</div>
												<div class="form-group ">
													<label for="u_phone">Enter Phone No <span style="color:#FF0000;">*</span>:</label>
													<input type="text" class="form-control" name="u_phone" id="u_phone"  placeholder="9999999999" value="<?=$user['phone'];?>" required>
												</div>
												<div class="form-group ">
													<label for="u_pass">User Role <span style="color:#FF0000;">*</span>:</label>
													<select name="u_role" id="u_role" class="form-control select-search" required>
														<option value="">--Select--</option>
													<?php if(!empty($roles)){ foreach($roles as $role){ if($user['roles_id']==$role['id']){ ?>
														<option value="<?=$role['id'];?>" selected><?=$role['role_name'];?></option>
													<?php }else{ ?>
														<option value="<?=$role['id'];?>"><?=$role['role_name'];?></option>
													<?php }}} ?>
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<label for="u_email">Enter User / Email Id <span style="color:#FF0000;">*</span>:</label>
													<input type="email" class="form-control" name="u_email" id="u_email"  placeholder="Enter User Email" value="<?=$user['username'];?>" readonly required >
												</div>
												<div class="form-group ">
													<label for="u_pass">Enter Password :</label>
													<input type="password" class="form-control" name="u_pass" id="u_pass" placeholder="Enter Password">
												</div>
												<div class="form-group ">
													<label for="u_profile">Upload Profile Picture :</label>
													<input type="file" class="form-control file-upload" name="u_profile" id="u_profile" accept="image/x-png,image/jpeg"  placeholder="Upload Photo">
												</div>
											</div>
											<div class="row">
												<div class="form-group ">
													<div class="col-md-6 col-sm-12 col-md-offset-4">
														<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Update</button>
														<a href="view_users.php" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
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
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
