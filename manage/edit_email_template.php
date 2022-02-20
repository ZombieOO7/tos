<?php

session_start();
include_once'../config/master.inc.php';
include ROOT_PATH.'config/connection.php';
if(isset($_SESSION['user_id']))
{
	extract($_GET);

	$permissions=$_SESSION['permissions'];
	$user_access=json_decode($permissions[8]);
	if(!empty($user_access))
	{

		$sqlp="SELECT * from email_templates WHERE id='$id';";
		$queryp= $conn->query($sqlp);
		$templates=$queryp->fetchAll(PDO::FETCH_ASSOC);
		
	}else{header('LOCATION: home.php');}	
}
else
{
	echo '<script>window.location.href = "../index.php";</script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="edit_email_template"; ?>
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
								<h2 class="no-margin text-light">EDIT <?=strtoupper($templates[0]['tmp_name']);?> TEMPLATE</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-8 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL?>models/edit_email_template.php" class="validate-user" method="post" autocomplete="off" enctype="multipart/form-data">
											<?php if(!empty($templates)){ foreach ($templates as $temp) { ?>
												<input type="hidden" name="temp_id" value="<?=$temp['id'];?>">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<div class="col-lg-12">
														<input name="tmp_name" id="tmp_name" class="form-control" placeholder="Enter Tempalte Name" value="<?=$temp['tmp_name'];?>" Disabled ><br>
													</div>
												</div><br>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<div class="col-lg-12">
														<input name="tmp_sub" id="tmp_sub" class="form-control" placeholder="Enter Tempalte Subject" value="<?=$temp['tmp_subject'];?>" required ><br>
													</div>
												</div><br>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<div class="col-lg-12">
														<textarea style="height: 500px ;" name="tmp_content" id="tmp_content" class="wysihtml5 wysihtml5-default form-control" placeholder="Enter Template Content"><?=$temp['tmp_content'];?></textarea><br>
													</div>
												</div><br>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<div class="col-lg-12">
														<label class="display-block text-semibold">Activate Template :</label>
														<label class="radio-inline">
															<input type="radio" name="is_active" value="1" <?php if($temp['is_active']=="1"){ echo "checked";}else{} ?> >Yes
														</label>
														<label class="radio-inline">
															<input type="radio" name="is_active" value="0" <?php if($temp['is_active']=="0"){ echo "checked";}else{} ?> >No
														</label>
													</div><br>
												</div>
											</div>
												<div class="row">
													<div class="form-group ">
														<div class="col-md-12 col-sm-12" align="center">
															<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Edit Template</button>
															<a href="<?=ROOT_URL?>views/view_email_templates.php" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
														</div>
													</div>
												</div>
											<?php }} ?>
											</form>
										</div>
									</div>	
								</div>
								<div class="col-md-4 col-sm-12">
									<div class="panel panel-flat">
									<?php if($templates[0]['tmp_type']=="3"){ ?>	
										<div class="panel-body">
											<table class="table table-striped table-bordered">
												<thead>
													<th colspan="2">Invoice Variables</th>
												</thead>
												<tbody>
													<tr>
														<td>Invoice No</td>
														<td>{{in_id}}</td>
													</tr>
													<tr>
														<td>Invoice Date</td>
														<td>{{in_date}}</td>
													</tr>
													<tr>
														<td>Due Date</td>
														<td>{{due_date}}</td>
													</tr>
													<tr>
														<td>Invoice Total</td>
														<td>{{in_grandtotal}}</td>
													</tr>
													<tr>
														<td>TXN Date</td>
														<td>{{txn_date}}</td>
													</tr>
													<tr>
														<td>Amount Paid</td>
														<td>{{amt_paid}}</td>
													</tr>
													<tr>
														<td>Due Amount</td>
														<td>{{amt_due}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									<?php } ?>
									<?php if($templates[0]['tmp_type']=="2"){ ?>		
										<div class="panel-body">
											<table class="table table-striped table-bordered">
												<thead>
													<th colspan="2">Quote Variables</th>
												</thead>
												<tbody>
													<tr>
														<td>Quote No</td>
														<td>{{qt_id}}</td>
													</tr>
													<tr>
														<td>Quote Date</td>
														<td>{{qt_date}}</td>
													</tr>
													<tr>
														<td>Expairy Date</td>
														<td>{{exp_date}}</td>
													</tr>
													<tr>
														<td>Quote Total</td>
														<td>{{qt_grandtotal}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									<?php } ?>	
									<?php if($templates[0]['tmp_type']=="4"){ ?>		
										<div class="panel-body">
											<table class="table table-striped table-bordered">
												<thead>
													<th colspan="2">Trip Variables</th>
												</thead>
												<tbody>
													<tr>
														<td>Tracking ID</td>
														<td>{{tracking_id}}</td>
													</tr>
													<tr>
														<td>Trip No</td>
														<td>{{trp_id}}</td>
													</tr>
													<tr>
														<td>From</td>
														<td>{{trp_from}}</td>
													</tr>
													<tr>
														<td>To</td>
														<td>{{trp_to}}</td>
													</tr>
													<tr>
														<td>Created Date</td>
														<td>{{trp_crdate}}</td>
													</tr>
													<tr>
														<td>Created Time</td>
														<td>{{trp_crtime}}</td>
													</tr>
													<tr>
														<td>Updated Date</td>
														<td>{{trp_update}}</td>
													</tr>
													<tr>
														<td>Updated Time</td>
														<td>{{trp_uptime}}</td>
													</tr>
													<tr>
														<td>Trip Current Status</td>
														<td>{{trp_status}}</td>
													</tr>
												</tbody>
											</table>
										</div>
									<?php } ?>
										<div class="panel-body">
											<table class="table table-striped table-bordered">
												<thead>
													<th colspan="2">Customer Variables</th>
												</thead>
												<tbody>
													<tr>
														<td>Company Name</td>
														<td>{{com_name}}</td>
													</tr>
													<tr>
														<td>Customer Name</td>
														<td>{{cust_name}}</td>
													</tr>
													<tr>
														<td>Email ID</td>
														<td>{{cust_email}}</td>
													</tr>
													<tr>
														<td>Contact No</td>
														<td>{{cust_phone}}</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="panel-body">
											<table class="table table-striped table-bordered">
												<thead>
													<th colspan="2">Organization Variables</th>
												</thead>
												<tbody>
													<tr>
														<td>Name</td>
														<td>{{org_name}}</td>
													</tr>
													<tr>
														<td>Email</td>
														<td>{{org_email}}</td>
													</tr>
													<tr>
														<td>Phone No.</td>
														<td>{{org_phone}}</td>
													</tr>
													<tr>
														<td>Address</td>
														<td>{{org_address}}</td>
													</tr>
													<tr>
														<td>Logo</td>
														<td>{{org_logo}}</td>
													</tr>
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

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
