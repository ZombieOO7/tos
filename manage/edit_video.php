<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		extract($_GET);
		$sql="SELECT * FROM videos WHERE id='$id';";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="edit_video"; ?>
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
								<h2 class="no-margin text-light">EDIT VIDEO</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/edit_video.php" method="post" class="validate-add-customer" id="edit_video">
										<?php if(!empty($results)){ foreach ($results as $result) { ?>
											<input type="hidden" name="v_id" value="<?=$result['id']; ?>">
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="video_code">Video Code <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="video_code" id="video_code" value="<?=$result['v_code']; ?>" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="video_date">Video Date <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control a_date" name="video_date" id="video_date" placeholder="DD-MM-YYYY" value="<?=date('d-m-Y',strtotime($result['v_date'])); ?>" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="video_title">Video Title <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="video_title" id="video_title" value="<?=$result['v_title']; ?>" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="video_author">Video Author <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="video_author" id="video_author" value="<?=$result['v_author']; ?>" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="tags">Tags :</label>
													<input type="text" class="form-control" name="tags" id="tags"  value="<?=$result['tags']; ?>">
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="video_location">Video Location <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="video_location" id="video_location" value="<?=$result['v_location']; ?>" required>
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="video_comment">Comments Allowed <span style="color:#F00;">*</span>:</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="video_comment" <?php if($result['comment']=="1"){echo "checked"; }else{} ?>>
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="video_desc">Video Description <span style="color:#F00;">*</span>:</label>
													<textarea class="form-control" name="video_desc" id="video_desc" rows="5" required><?=$result['v_description']; ?></textarea>
												</div>
											</div>
											<div class="row">
												<div class="form-group ">
													<div class="col-md-12 col-sm-12" align="center">
														<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Edit</button>
													</div>
												</div>
											</div>
										<?php }} ?>
										</form>
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
<script type="text/javascript">
$(document).ready(function() { 

	CKEDITOR.replace('video_desc', {
        height: 500,
   	});

	$('#btnsubmit').on('click',function()
  	{
	    if ($('#edit_video').valid()==true) 
	   	{
	        setTimeout(function () { disableButton(); }, 0);
	    }
  	});
});

function disableButton() 
{
    $("#btnsubmit").html('<b><i class="icon-spinner6"></i></b>Updating...Please wait').attr('disabled','disabled');
}
</script>
<?php include'footer.php'; ?>
<!-- FOOTER END -->
</body>
</html>
