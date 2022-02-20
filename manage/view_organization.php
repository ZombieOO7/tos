<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT o.id,o.org_name,o.org_cpname,o.org_pemail,o.org_semail,o.org_pphone,o.org_sphone,o.org_country,o.org_state,o.org_address,o.org_pin,o.org_gstno,o.org_logo,o.org_cin,o.org_llpin,o.org_url,o.slider_logo,o.post_by,co.countries_name,s.state_name,CONCAT_WS(', ',o.org_address,s.state_name,co.countries_name,o.org_pin) as fulladdress FROM organization o 
				JOIN ".$rootdb.".countries co ON o.org_country=co.countries_id
				JOIN ".$rootdb.".states s ON o.org_state=s.id;";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

		$sqlc="SELECT * FROM ".$rootdb.".countries;";
		$queryc= $conn->query($sqlc);
		$countries=$queryc->fetchAll(PDO::FETCH_ASSOC);

		$sqls="SELECT * FROM ".$rootdb.".states order by state_name;";
		$querys= $conn->query($sqls);
		$states=$querys->fetchAll(PDO::FETCH_ASSOC);

	}else{ header('LOCATION: home.php'); }
}
else
{
	session_destroy();
	echo '<script>window.location.href = "index.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $page="view_organization"; ?>
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
								<h2 class="no-margin text-light">VIEW ORGANIZATION</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<!-- Detached sidebar -->
						<div class="sidebar-detached">
							<div class="sidebar sidebar-default sidebar-separate">
								<div class="sidebar-content">
									<!-- User details -->
									<div class="content-group">
										<div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(#); background-size: contain;">
											<div class="content-group-sm">
												<h6 class="text-semibold no-margin-bottom">
													<?=$results[0]['org_name'];?>
												</h6>
												<span class="display-block"><?=$results[0]['org_pphone'];?></span>
											</div>

											<a href="#" class="display-inline-block content-group-sm">
												<img src="<?=ROOT_URL.$results[0]['org_logo'];?>" class="img-circle img-responsive" alt="org_logo" style="width: 110px; height: 110px;  object-fit:scale-down; background:#FFF;">
											</a>
										</div>
										<div class="panel no-border-top no-border-radius-top">
											<ul class="navigation">
												<li align="center"><button onclick="document.location.href='view_organization.php';" class="btn btn-danger btn-labeled btn-labeled-left rounded-round"  style="width:150px;"><b><i class="icon-circle-left2"></i></b>Go Back</button></li>

												<li align="center"><button onclick="document.location.href='edit_organization.php?id=<?=$results[0]['id']; ?>';" class="btn bg-teal btn-labeled btn-labeled-left rounded-round" data-toggle="modal" style="width:150px;"><b><i class="icon-pen"></i></b>Edit Details</button></li>
												<?php if($results[0]['slider_logo']=="0"){ ?>
													<li align="center"><button onclick="document.location.href='<?=ROOT_URL; ?>models/lslider_on_off.php?s=1';" class="btn bg-teal btn-labeled btn-labeled-left rounded-round" data-toggle="modal" style="width:150px;"><b><i class="icon-images2"></i></b>Enable Logo</button></li>
												<?php }elseif($results[0]['slider_logo']=="1"){ ?>
													<li align="center"><button onclick="document.location.href='<?=ROOT_URL; ?>models/lslider_on_off.php?s=0';" class="btn bg-danger btn-labeled btn-labeled-left rounded-round" data-toggle="modal" style="width:150px;"><b><i class="icon-images2"></i></b>Disable Logo</button></li>
												<?php }else{} ?>

												<?php if($results[0]['post_by']=="0"){ ?>
													<li align="center"><button onclick="document.location.href='<?=ROOT_URL; ?>models/postby_on_off.php?s=1';" class="btn bg-teal btn-labeled btn-labeled-left rounded-round" data-toggle="modal" style="width:150px;"><b><i class="icon-user"></i></b>Enable Post By</button></li>
												<?php }elseif($results[0]['post_by']=="1"){ ?>
													<li align="center"><button onclick="document.location.href='<?=ROOT_URL; ?>models/postby_on_off.php?s=0';" class="btn bg-danger btn-labeled btn-labeled-left rounded-round" data-toggle="modal" style="width:150px;"><b><i class="icon-user"></i></b>Disable Post By</button></li>
												<?php }else{} ?>	
	

												<li class="navigation-divider"></li>
												<li class="navigation-header">Navigation</li>
												<li class="active"><a href="#overview" data-toggle="tab"><i class="icon-files-empty"></i> Overview</a></li>
											</ul>
										</div>
									</div>
									<!-- /user details -->
								</div>
							</div>
						</div>
						<!-- /Detached sidebar -->
						<!-- Detached content -->
						<div class="container-detached">
							<div class="content-detached">
								<!-- Tab content -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="overview">
										<div class="panel panel-flat">
											<div class="panel-heading">
												<h6 class="panel-title"><?=strtoupper($results[0]['org_name']);?></h6>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-bordered">
													<tbody>
														<?php if(!empty($results)){ foreach($results as $result){ ?>
														<tr>
															<th>Company Name</th>
															<td><?=$result['org_name'];?></td>
														</tr>
														<tr>
															<th>Primary Contact No</th>
															<td><?=$result['org_pphone'];?></td>
														</tr>
														<tr>	
															<th>Primary Email</th>
															<td><?=$result['org_pemail'];?></td>
														</tr>
														<tr>
															<th>Secondary Contact No</th>
															<td><?=$result['org_sphone'];?></td>
														</tr>
														<tr>	
															<th>Secondary Email</th>
															<td><?=$result['org_semail'];?></td>
														</tr>
														<tr>	
															<th>CIN No</th>
															<td><?=$result['org_cin'];?></td>
														</tr>
														<tr>	
															<th>LLP-IN No</th>
															<td><?=$result['org_llpin'];?></td>
														</tr>
														<tr>	
															<th>Website URL</th>
															<td><?=$result['org_url'];?></td>
														</tr>
														 <tr>	
															<th>GST No</th>
															<td><?php if(strlen($result['org_gstno'])>2){ echo $result['org_gstno']; } ;?></td>
														</tr> 
														<tr>
															<th>Address</th>
															<td><?=$result['fulladdress'];?></td>
														</tr>
													<?php }} ?>
													</tbody>
												</table>
												
											</div>
										</div>
									</div>
								</div>
								<!-- /tab content -->
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
});
</script>
<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
