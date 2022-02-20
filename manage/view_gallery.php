<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT * FROM gallery WHERE status='0' ORDER BY id DESC;";
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

<?php $page="view_gallery"; ?>
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
								<h2 class="no-margin text-light">ALL GALLERY IMAGES</h2>
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
													<th>Date</th>
													<th>Image</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($results)){ foreach($results as $result){ ?>
												<tr>
													<td><?=date("d-m-Y",strtotime($result['created_at'])); ?></td>
													<td align="center">
														<?php if(!empty($result['img_path'])){ ?>
															<img src="<?=ROOT_URL.$result['img_path']; ?>" height='150' width='250' />
														<?php } ?>
													</td>
													<td>
														<ul class="icons-list">
															<li class="text-primary-600">
																<a data-toggle="modal" data-target="#modal_delete" data-id="<?=$result['id']; ?>,<?=ROOT_URL.$result['img_path']; ?>" class="modelopen" data-popup="tooltip" data-original-title="Delete"><i class="icon-cross"></i></a>
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
	$(document).on('click','.modelopen', function (e) {
    	e.preventDefault();

    	$("#img_id").val('');
    	 var imgData =$(this).data('id');
    	 var imgs = imgData.split(",");

        if(imgs[0]=="" && imgs[1]=="")
        {
          	return false;
        }
        else
        {	
        	$("#img_id").val(imgs[0]);
        	$("#img_src").attr('src',imgs[1]);
        }
    });	
});


</script>

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
