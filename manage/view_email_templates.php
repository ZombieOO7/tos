<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sqlp="SELECT * from email_templates WHERE status='0' ORDER BY id DESC;";
		$queryp= $conn->query($sqlp);
		$templates=$queryp->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	{
		header('Location: home.php');
	}	

 } 
 else
 {
 	header('Location: index.php'); 
 } 
?>

 <?php $page="view_email_templates"; ?>
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
								<h2 class="no-margin text-light">LIST EMAIL TEMPLATES</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Name</th>
													<th>Subject</th>
													<th>Content</th>
													<th>Active</th>
													<th style="text-align: center;">Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php if(!empty($templates)){ foreach ($templates as $temp) { ?>
												<tr>
													<td><?=$temp['tmp_name'];?></td>
													<td><?=$temp['tmp_subject'];?></td>
													<td><?=$temp['tmp_content'];?></td>
													<td>
													<?php
														if($temp['is_active']=="1")
														{
															echo '<span class="label label-success label-roundless label-block">Yes</span>';
														}
														else
														{
															echo '<span class="label label-danger label-roundless label-block">No</span>';
														}
													?>
													</td>
													<td align="center">
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="<?=ROOT_URL;?>edit_email_template.php?id=<?=$temp['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
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
<?php include 'footer.php'; ?>
<!-- FOOTER END -->