<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM videos ORDER BY id DESC;";
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

<?php $page="view_videos"; ?>
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
								<h2 class="no-margin text-light">ALL VIDEOS</h2>
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
													<th width="14%">Date</th>
													<th width="22%">Video Code</th>
													<th width="14%">Video Title</th>
													<th width="10%">Comment</th>
													<th width="10%">Words</th>
													<th width="14%">Published</th>
													<th width="16%">Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td><?=date("d-m-Y",strtotime($result['v_date'])); ?></td>
													<td><?=$result['v_code']; ?></td>
													<td><?=$result['v_title']; ?></td>
													<td>
														<?php if($result['comment']=="1"){ ?>
															<span class="label label-flat border-success text-success-600">Allowed</span>
														<?php }elseif($result['comment']=="0"){ ?>	
															<span class="label label-flat border-danger text-danger-600">Not Allowed</span>
														<?php }else{} ?>
													</td>
													<td><?=str_word_count(strip_tags($result['v_description'])); ?></td>
													<td>
														<?php if($result['publish']=="1"){ ?>
															<span class="label label-flat border-success text-success-600">Published</span>
														<?php }elseif($result['publish']=="0"){ ?>	
															<span class="label label-flat border-danger text-danger-600">Not Published</span>
														<?php }else{} ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a href="edit_video.php?id=<?=$result['id'];?>" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
															</li>
															<li class="text-primary-600">
																<?php if($result['publish']=="1"){ ?>
																	<a href="<?=ROOT_URL; ?>models/publish_video.php?id=<?=$result['id'];?>&st=0" data-popup="tooltip" data-original-title="Unpublish"><i class="icon-cross"></i></a>
																<?php }elseif($result['publish']=="0"){ ?>	
																	<a href="<?=ROOT_URL; ?>models/publish_video.php?id=<?=$result['id'];?>&st=1" data-popup="tooltip" data-original-title="Publish"><i class="icon-check"></i></a>
																<?php }else{} ?>
															</li>
															<li class="text-primary-600">
																<a href="<?=ROOT_URL_FRONT; ?>view_video.php?v_id=<?=$result['url_id'];?>" target="_blank" data-popup="tooltip" data-original-title="Preview"><i class="icon-eye"></i></a>
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
<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.modeldelete', function (e) {
    	e.preventDefault();
    	 var d_id =$(this).data('id');

        if(d_id=="")
        {
          	return false;
        }
        else
        {	
        	swal({
        		title: 'Are You Sure ?',
        		text: 'Delete This Video',
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
			            url: '<?=ROOT_URL;?>models/delete_video.php',
			            data:{'d_id':d_id},
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
</body>
</html>
