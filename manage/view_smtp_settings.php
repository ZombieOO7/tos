<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM smtp_settings;";
		$q= $conn->query($sql);
		$smtp_settings=$q->fetchAll(PDO::FETCH_ASSOC);

	}else{header('Location: home.php');}

 } 
 else
 { 
 	header('Location: index.php'); 
 } 
 ?>

 <?php $page="view_smtp_settings"; ?>
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
								<h2 class="no-margin text-light">SMTP SETTINGS</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
								<!-- add org form -->
								<div class="panel-body">
									<form action="<?=ROOT_URL;?>models/update_smtp_settings.php" class="validate-email-settings" method="post">
									<?php if(!empty($smtp_settings)){ foreach($smtp_settings as $ss){ ?>
									<div class="col-md-6 col-sm-12">
										<div class="form-group ">
											<input type="hidden" name="ss_id" value="<?=$ss['id'];?>">
											<label for="smtp_auth">SMTP AUTH <span style="color:#FF0000">*</span> :</label>
											<select name="smtp_auth" id="smtp_auth" class="form-control select-search" disabled>
												<option value="">--Select--</option>
												<option value="0" <?php if($ss['smtp_auth']=="0"){echo "selected";} ?> >No</option>
												<option value="1" <?php if($ss['smtp_auth']=="1"){echo "selected";} ?> >Yes</option>
											</select>
										</div>
										<div class="form-group ">
											<label for="smtp_host">SMTP HOST <span style="color:#FF0000">*</span> : </label>
											<input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?=$ss['smtp_host'];?>" placeholder="Enter Host Name" required disabled>
										</div>
										<div class="form-group ">
											<label for="smtp_user">SMTP USER<span style="color:#FF0000">*</span> : </label>
											<input type="email" class="form-control" name="smtp_user" id="smtp_user" value="<?=$ss['smtp_user'];?>" placeholder="abc@example.com" required disabled>
										</div>
									</div>

									<div class="col-md-6 col-sm-12">
										<div class="form-group ">
											<label for="smtp_pass">SMTP PASSWORD <span style="color:#FF0000">*</span> : </label>
											<input type="password" class="form-control" name="smtp_pass" id="smtp_pass" placeholder="" required disabled>
										</div>
										<div class="form-group ">
											<label for="smtp_layer">SMTP LAYER <span style="color:#FF0000">*</span> : </label>
											<select name="smtp_layer" id="smtp_layer" class="form-control select-search" disabled>
												<option value="">--Select--</option>
												<option value="ssl" <?php if($ss['smtp_layer']=="ssl"){echo "selected";}?> >SSL</option>
												<option value="tls" <?php if($ss['smtp_layer']=="tls"){echo "selected";}?> >TLS</option>
											</select>
										</div>
										<div class="form-group ">
											<label for="smtp_port">SMTP PORT <span style="color:#FF0000">*</span> : </label>
											<input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?=$ss['smtp_port'];?>" placeholder="Enter Port No:25,456 etc" required disabled>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4 col-sm-12 col-md-offset-4">
											<div class="form-group ">
												<button type="submit" name="submit" id="save_settings" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Save</button>
												<button type="button" class="btn bg-teal btn-labeled" id="edit_settings"><b><i class="icon-pen"></i></b>Edit</button>
												<button type="button" class="btn bg-danger btn-labeled" id="cancel_edit"><b><i class="icon-cross"></i></b>Cancel</button>
											</div>
										</div>
									</div>
								<?php }} ?>
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
<script type="text/javascript">
	$(document).ready(function(){

		$('#save_settings').prop("disabled", true);

		$("#edit_settings").click(function(){
			$('#save_settings').prop("disabled", false);
			$('#smtp_auth').prop("disabled", false);
			$("#smtp_host").prop("disabled", false);
			$("#smtp_user").prop("disabled", false);
			$("#smtp_pass").prop("disabled", false);
			$("#smtp_layer").prop("disabled", false);
			$("#smtp_port").prop("disabled", false);
		});

		$("#cancel_edit").click(function(){
			$('#save_settings').prop("disabled", true);
			$('#smtp_auth').prop("disabled", true);
			$("#smtp_host").prop("disabled", true);
			$("#smtp_user").prop("disabled", true);
			$("#smtp_pass").prop("disabled", true);
			$("#smtp_layer").prop("disabled", true);
			$("#smtp_port").prop("disabled", true);
		});
	});
</script>

<!-- FOOTER START -->
<?php include 'footer.php'; ?>
<!-- FOOTER END -->
</body>

</html>