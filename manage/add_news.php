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

<?php $page="add_news"; ?>
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
								<h2 class="no-margin text-light">ADD NEWS</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/add_news.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="add_news">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="news_name">News Heading <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="news_name" id="news_name" required>
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="news_subhead">News Sub Head <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="news_subhead" id="news_subhead">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="tags">Tags :</label>
													<input type="text" class="form-control" name="tags" id="tags">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group post">
													<label for="cat_id">Category <span style="color:#FF0000;">*</span>:</label>
													<select name="cat_id" id="cat_id" class="form-control select-search" required>
														<option value="">--Select Category--</option>
														<?php if(!empty($category)){ foreach($category as $cat){ ?>
															<option value="<?=$cat['id']; ?>"><?=$cat['name']; ?></option>
														<?php }} ?>
													</select>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="news_author">News Author :</label>
													<input type="text" class="form-control" name="news_author" id="news_author">
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="news_location">News Location <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="news_location" id="news_location" required>
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
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="news_date">News Date <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control a_date" name="news_date" id="news_date" placeholder="DD-MM-YYYY" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="cover_file">Upload Cover Photo <span style="color:#F00;">*</span>:</label>
													<input type="file" class="form-control file-upload" name="cover_file" id="cover_file" required>
												</div>
											</div>
											<div class="col-md-4 col-sm-12">
												<div class="form-group">
													<label for="news_comment">Comments Allowed <span style="color:#F00;">*</span>:</label><br>
													<input type="checkbox" class="switch" data-on-text="Yes" data-off-text="No" data-on-color="success" data-off-color="danger" name="news_comment" checked>
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<label for="news_content">News Content <span style="color:#F00;">*</span>:</label>
												<textarea name="news_content" id="news_content" required></textarea>
											</div>
											<div class="col-md-12 col-sm-12 mt-10" align="center">
												<div class="form-group">
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

	CKEDITOR.replace('news_content', {
        height: 500,
   	});

	$('#btnsubmit').on('click',function()
  	{
	    if ($('#add_news').valid()==true) 
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
