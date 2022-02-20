<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM stories ORDER BY id DESC;";
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

<?php $page="view_stories"; ?>
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
								<h2 class="no-margin text-light">ALL STORIES</h2>
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
													<th>Created At</th>
													<th>Story Name</th>
													<th>Views</th>
													<th>Index</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td><?=date("d-m-Y",strtotime($result['created_at'])); ?></td>
													<td><?=$result['name']; ?></td>
													<td><?=$result['view_count']; ?></td>
													<td>
													    <?php if($result['is_index']=='200'){ ?>
															<span class="label label-flat border-success text-success-600">Yes</span>
														<?php }else{ ?>	
															<span class="label label-flat border-danger text-danger-600">No <?=$result['is_index'];?></span>
														<?php } ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="<?=ROOT_URL; ?>edit_story.php?id=<?=$result['id'];?>" class="modelopen" data-popup="tooltip" data-original-title="Edit"><i class="icon-pen"></i></a>
															</li>
															<li class="text-primary-600">
																<?php if($result['publish']=="1"){ ?>
																	<a href="<?=ROOT_URL; ?>models/publish_story.php?id=<?=$result['id'];?>&st=0" data-popup="tooltip" data-original-title="Unpublish"><i class="icon-cross"></i></a>
																<?php }elseif($result['publish']=="0"){ ?>	
																	<a href="<?=ROOT_URL; ?>models/publish_story.php?id=<?=$result['id'];?>&st=1" data-popup="tooltip" data-original-title="Publish"><i class="icon-check"></i></a>
																<?php }else{} ?>
															</li>
															<li class="text-primary-600">
																<a href="<?=ROOT_URL_FRONT; ?>view_story.php?id=<?=$result['url'];?>" target="_blank" data-popup="tooltip" data-original-title="Preview"><i class="icon-eye"></i></a>
															</li>
															<li class="text-primary-600">
																<a data-id="<?=$result['id'];?>" class="modeldelete" data-popup="tooltip" data-original-title="Delete"><i class="icon-trash"></i></a>
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

<!-- edit image Model -->
<div id="modal_delete" class="modal fade open">
	<div class="modal-dialog">
		<div class="modal-content" style="border:2px solid #ddd;">
			<div class="modal-header" style="border:2px solid #ddd;">
				<h5 class="modal-title">DELETE IMAGE</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('delete_gallery_image_form').reset();" >×</button>
			</div>
			<div class="modal-body">
				<div id="msg"></div>
				<form action="<?=ROOT_URL;?>models/delete_gallery_image.php" id="delete_gallery_image_form" method="post" class="validate-edit-incategory">

					<div class="col-md-12 col-sm-12">
						<input type="hidden" name="img_id" id="img_id" readonly>
						<div class="form-group">
							<img src="" border='1' width="100%" id="img_src" height="300" />
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-md-offset-4">
							<div class="form-group"><br>
								<button type="submit" name="submit" class="btn btn-danger btn-labeled"><b><i class="icon-cross"></i></b>Delete</button>
								<a data-dismiss="modal" onclick="document.getElementById('delete_gallery_image_form').reset();" class="btn btn-md btn-success btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!-- /edit image Model -->
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.modeldelete', function (e) {
    	e.preventDefault();
    	 var s_id =$(this).data('id');

        if(s_id=="")
        {
          	return false;
        }
        else
        {	
        	swal({
        		title: 'Are You Sure ?',
        		text: 'Delete This News',
        		type: 'warning',
        		showCancelButton: true,
        		confirmButtonColor: '#EF5350',
        		confirmButtonText: 'Yes, Delete',
        		cancelButtonText: 'No, Cancel',
        		closeOnConfirm: true,
        		closeOnCancel: true
        	},
        	function(isConfirm)
        	{
        		if (isConfirm) 
        		{
        			$.ajax({
			            type: 'POST',
			            url: '<?=ROOT_URL;?>models/delete_story.php',
			            data:{'s_id':s_id},
			            /*dataType:'json',*/
			            success: function (response) 
			            {
			            	window.location.reload();
			            }
	        		});
        		}
        	});
        }
    });
});
</script>

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
