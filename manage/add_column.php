<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sqlp="SELECT * FROM news_category WHERE status=0 ORDER BY id ASC;";
		$qp=$conn->query($sqlp);
		$category=$qp->fetchAll(PDO::FETCH_ASSOC);
	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<?php $page="add_column"; ?>
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
								<h2 class="no-margin text-light">ADD COLUMN</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/add_column.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="add_column">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="blog_name">Column Heading <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="blog_name" id="blog_name" required>
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="blog_subhead">Column Sub Head <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="blog_subhead" id="blog_subhead">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="tags">Tags :</label>
													<input type="text" class="form-control" name="tags" id="tags">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="cover_file">Upload Cover Photo <span style="color:#F00;">*</span>:</label>
													<input type="file" class="form-control file-upload" name="cover_file" id="cover_file" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="blog_author">Column Author <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="blog_author" id="blog_author" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="blog_location">Column Location <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="blog_location" id="blog_location" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="photo_credit">Photo Credit :</label>
													<input type="text" class="form-control" name="photo_credit" id="photo_credit">
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="illustration">Illustration :</label>
													<input type="text" class="form-control" name="illustration" id="illustration">
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="graphics">Graphics :</label>
													<input type="text" class="form-control" name="graphics" id="graphics">
												</div>
											</div>
											<div class="col-md-5 col-sm-12">
												<div class="form-group">
													<label for="blog_date">Column Date <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control a_date" name="blog_date" id="blog_date" placeholder="DD-MM-YYYY" required>
												</div>
											</div>
											<div class="col-md-5 col-sm-12">
												<div class="form-group">
													<label for="cover_file">Featured Photo :</label>
													<input type="file" class="form-control file-upload" name="featured_file">
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="is_featured">Featured :</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="is_featured">
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group">
													<label for="featured_title">Show Featured Title :</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="featured_title" checked>
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="blog_comment">Comments Allowed <span style="color:#F00;">*</span>:</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="blog_comment" checked>
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="name_align">Heading Align :</label><br>
													<input type="checkbox" class="switch" data-on-text="Right" data-off-text="Left" data-on-color="success" data-off-color="danger" name="name_align">
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="name_color">Heading Color :</label><br>
													<input type="checkbox" class="switch" data-on-text="Dark" data-off-text="Light" data-on-color="success" data-off-color="danger" name="name_color">
												</div>
											</div>
											<div class="col-md-2 col-sm-12">
												<div class="form-group">
													<label for="cover_story">Cover Story <span style="color:#F00;">*</span>:</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="cover_story" >
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<label for="blog_content">Column Content <span style="color:#F00;">*</span>:</label>
												<textarea  style="height:200px;" name="blog_content" id="blog_content" required></textarea>
											</div>
											<div class="col-md-12 col-sm-12 mt-10" align="center">
												<div class="form-group ">
													<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Add</button>
												</div>
											</div>
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

	CKEDITOR.replace('blog_content', {
        height: 500,
   	});


	$('#btnsubmit').on('click',function()
  	{
	    if ($('#add_column').valid()==true) 
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
