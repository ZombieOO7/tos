<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM cms ORDER BY id DESC;";
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

<?php $page="view_cms"; ?>
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
								<h2 class="no-margin text-light">WEB CONTENT MANAGEMENT</h2>
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
													<th>Title</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td><?=$result['title']; ?></td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="edit_cms.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
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
