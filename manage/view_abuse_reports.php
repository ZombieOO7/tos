<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT a.*,c.cust_name FROM abuse_reports a 
				LEFT JOIN customers c ON c.id=a.cust_id ORDER BY a.id DESC;";
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

<?php $page="view_abuse_report"; ?>
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
								<h2 class="no-margin text-light">ABUSE REPORT</h2>
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
													<th>Customer</th>
													<th>Post / Review / News #</th>
													<th>Remark</th>
													<th>Status</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td>
														<a href="<?=$result['cust_id']; ?>"><?=$result['cust_name']; ?></a>
													</td>
													<td>
														<?php if(!empty($result['post_id'])){ ?>
															<span class="label label-primary label-roundless">POST # <?=$result['post_id']; ?></span>
														<?php }elseif(!empty($result['review_id'])){ ?>
															<span class="label label-danger label-roundless">REVIEW # <?=$result['review_id']; ?></span>
														<?php }elseif(!empty($result['news_id'])){ ?>
															<span class="label bg-purple label-roundless">NEWS # <?=$result['news_id']; ?></span>
														<?php }else{} ?>
													</td>
													<td><?=$result['remark']; ?></td>
													<td>
														<?php if($result['status']=="1"){ ?>
															<span class="label label-flat border-success text-success-600">Checked</span>
														<?php }else{ ?>
															<span class="label label-flat border-danger text-danger-600">Unchecked</span>
														<?php } ?>
													</td>
													<td>
														<ul class="icons-list">
															<?php if($result['status']=="1"){ ?>
																<li class="text-primary-600">
																<a href="models/update_abuse_report_status.php?ar_id=<?=$result['id'];?>&st=0" data-popup="tooltip" data-original-title="Uncheck"><i class="icon-cross"></i></a>
															</li>
															<?php }else{ ?>
																<li class="text-primary-600">
																<a href="models/update_abuse_report_status.php?ar_id=<?=$result['id'];?>&st=1" data-popup="tooltip" data-original-title="Check"><i class="icon-check"></i></a>
															</li>
															<?php } ?>
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
