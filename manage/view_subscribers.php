<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM subscribers WHERE status='1' ORDER BY id DESC;";
		$query_db = $conn->query($sql);
		$results=$query_db->fetchAll(PDO::FETCH_ASSOC);	

	}else{ header('Location: home.php'); }

}
else
{
	session_destroy();
	header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $page="view_subscribers"; ?>
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
								<h2 class="no-margin text-light">ALL SUBSCRIBERS</h2>
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
													<th>Name</th>
													<th>Email</th>
													<th>Verification</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td><?=$result['s_name']; ?></td>
													<td><?=$result['s_email']; ?></td>
													<td>
													<?php if($result['verify']=="0"){ ?>
														<span class="label label-flat border-danger text-danger-600">Not Verified</span>
													<?php }else{ ?>
														<span class="label label-flat border-success text-success-600">Verified</span>
													<?php } ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="view_one_customer.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="View"><i class="icon-info3"></i></a>
															</li>
															<li class="text-primary-600">
																<a href="edit_customer.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
															</li>
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

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
	</body>

</html>
