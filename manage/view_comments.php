<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT cm.*,c.cust_name FROM comments cm
				LEFT JOIN customers c ON c.id=cm.cust_id ORDER BY cm.id DESC;";
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

<?php $page="view_comments"; ?>
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
								<h2 class="no-margin text-light">All COMMENTS</h2>
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
													<th>Customer Name</th>
													<th>Post / Blog / News / video / EV #</th>
													<th>Comment</th>
													<th>Approved</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td>
														<a href="view_one_customer.php?id=<?=$result['cust_id']; ?>"><?=$result['cust_name']; ?></a>
													</td>
													<td align="center">
														<?php if(!empty($result['post_id'])){ ?>
															<span class="label label-primary label-roundless">POST # <?=$result['post_id']; ?></span>
														<?php }elseif(!empty($result['blog_id'])){ ?>
															<span class="label label-danger label-roundless">BLOG # <?=$result['blog_id']; ?></span>
														<?php }elseif(!empty($result['news_id'])){ ?>
															<span class="label bg-brown label-roundless">NEWS # <?=$result['news_id']; ?></span>
														<?php }elseif(!empty($result['video_id'])){ ?>
															<span class="label bg-purple label-roundless">VIDEO # <?=$result['video_id']; ?></span>
														<?php }elseif(!empty($result['ev_id'])){ ?>
															<span class="label bg-teal label-roundless">EV's # <?=$result['ev_id']; ?></span>	
														<?php }else{} ?>
													</td>
													<td><?=$result['comment']; ?></td>
													<td>
														<?php if($result['is_approved']=="1"){ ?>
															<span class="label label-flat border-success text-success-600">Approved</span>
														<?php }else{ ?>
															<span class="label label-flat border-danger text-danger-600">Not Approved</span>
														<?php } ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a data-toggle="modal" data-target="#modal_editComment" data-id="<?=$result['id'];?>" class="modelopen" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
															</li>
															<?php if($result['is_approved']=="1"){ ?>
																<li class="text-primary-600">
																<a href="models/update_comment_status.php?cm_id=<?=$result['id'];?>&st=0" data-popup="tooltip" data-original-title="Disapprove"><i class="icon-cross"></i></a>
															</li>
															<?php }else{ ?>
																<li class="text-primary-600">
																<a href="models/update_comment_status.php?cm_id=<?=$result['id'];?>&st=1" data-popup="tooltip" data-original-title="Approve"><i class="icon-check"></i></a>
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

<!-- edit Comment Model -->
<div id="modal_editComment" class="modal fade open">
	<div class="modal-dialog">
		<div class="modal-content" style="border:2px solid #ddd;">
			<div class="modal-header" style="border:2px solid #ddd;">
				<h5 class="modal-title">EDIT COMMENT</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('edit_comment_form').reset();" >×</button>
			</div>
			<div class="modal-body">
				<div id="msg"></div>
				<form action="<?=ROOT_URL;?>models/edit_comment.php" id="edit_comment_form" method="post" class="validate-edit-incategory">
					<div class="col-md-12 col-sm-12">
						<input type="hidden" name="cm_id" id="cm_id" required readonly>
						<div class="form-group">
							<label class="col-lg-3 control-label" for="comment">Comment <span style="color:#FF0000;">*</span> :</label>
							<div class="col-lg-7">
								<textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
							</div>
						</div><br>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12" align="center">
							<div class="form-group"><br>
								<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-pen"></i></b>Edit</button>
								<a data-dismiss="modal" onclick="document.getElementById('edit_comment_form').reset();" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!-- /edit Comment Model -->

<!-- FOOTER START -->
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','.modelopen', function (e) {
			e.preventDefault();
			var cm_id = $(this).data('id');

			if(cm_id=="")
			{
				return false;
			}
			else
			{	
				$.ajax({
					type: 'POST',
					url: '<?=ROOT_URL;?>models/get_comment_details.php',
					data:{'cm_id':cm_id},
					dataType:'json',
					success: function (response) 
					{
						$.each(response, function () 
						{
							$("#cm_id").val(this.id);
							$("#comment").val(this.comment);
						});
					}
				});
			}
		});

	});	
</script>
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
