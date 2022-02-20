<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sqlp="SELECT * FROM email_log el LEFT JOIN users u ON u.id=el.sender ORDER BY el.id DESC;";
		$queryp= $conn->query($sqlp);
		$email_logs=$queryp->fetchAll(PDO::FETCH_ASSOC);

	}
	else
	{
		header('Location: home.php');
	}
 } 
 else{ 
 	header('Location: index.php'); 
 } 
?>

 <?php $page="view_email_log"; ?>
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
								<h2 class="no-margin text-light">EMAIL LOG</h2>
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
													<th>Sent At</th>
													<th>Email Type</th>
													<th>Sender</th>
													<th>Receiver</th>
													<th>Customer</th>
												</tr>
											</thead>
											<tbody>
											<?php if(!empty($email_logs)){ foreach ($email_logs as $el) { ?>
												<tr>
													<td><span style="display: none"><?=strtotime($el['sent_at']);?></span><?=date("d-m-Y H:i",strtotime($el['sent_at']));?></td>
													<td>
													<?php if(!empty($el['invoice'])){ ?>
														<span class="label label-success">Invoice</span>
													<?php }elseif(!empty($el['quotation'])){ ?>
														<span class="label label-danger">Quote</span>
													<?php }elseif(!empty($el['po'])){ ?>
														<span class="label label-warning">PO</span>
													<?php }elseif(!empty($el['trip_id'])){ ?>
														<span class="label bg-purple">Trip</span>
													<?php }else{} ?>	
													</td>
													<td>
													<?php if(!empty($el['fname']) || !empty($el['lname'])){ ?>
														<?=$el['fname']." ".$el['lname'];?>
													<?php }else{ ?>
														System Generated
													<?php } ?>	
													</td>
													<td><?=$el['receiver'];?></td>
													<td><?=$el['cp_name'];?></td>
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
<?php include 'footer.php'; ?>
<!-- FOOTER END -->