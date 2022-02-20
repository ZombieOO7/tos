<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM polls ORDER BY id DESC;";
		$query_db=$conn->query($sql);
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
<?php $page="view_polls"; ?>
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
								<h2 class="no-margin text-light">All POLLS</h2>
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
													<th>Question</th>
													<th>Options</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){
													$option="<ul>"; 
													$options=[];
													$sqlpo="SELECT * FROM poll_options WHERE poll_id='".$result['id']."';";
													$qpo= $conn->query($sqlpo);
													$options=$qpo->fetchAll(PDO::FETCH_ASSOC);
												?>
												<tr>
													<td><?=$result['question']; ?></td>
													<td>
														<?php 
															if(!empty($options))
															{ 
																$sqlprc="SELECT id,option_id FROM poll_response WHERE poll_id='".$result['id']."';";
																$qprc= $conn->query($sqlprc);
																$counting=$qprc->fetchAll(PDO::FETCH_ASSOC);
																$total=count($counting);

																foreach($options as $opt)
																{
																	$ntotal=0;
																	foreach ($counting as $count) 
																	{
																		if($opt['id']==$count['option_id']){
																			$ntotal=$ntotal+1;
																		}
																	}
																	if($total>0){
																	$option=$option."<li>".$opt['options']." (<strong>".$ntotal."</strong>) (<strong>".round((($ntotal/$total)*100),2)."%</strong>)</li>";
																	}else{
																		$option=$option."<li>".$opt['options']." (<strong>".$ntotal."</strong>)</li>";
																	}
															  	}
															  	$option=$option."</ul>";
															} 
														?>
														<?=rtrim($option,'<br>'); ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="edit_poll.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
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
