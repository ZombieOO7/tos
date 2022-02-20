<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		extract($_GET);
		$sql="SELECT * FROM cms WHERE id='$id';";
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

<?php $page="edit_cms"; ?>
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
								<h2 class="no-margin text-light">EDIT CONTENT</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/edit_cms.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="edit_cms">
										<?php if(!empty($results)){ foreach ($results as $result) { ?>
											<input type="hidden" name="c_id" value="<?=$result['id']; ?>">
											<?php if($result['id']=="1"){ $content=json_decode($result['content'],true); ?>
												<div class="col-md-4 col-sm-12">
													<div class="form-group">
														<label for="title">Title <span style="color:#F00;">*</span>:</label>
														<input type="text" class="form-control" name="title" id="title" value="<?=$result['title']; ?>" required>
													</div>
													<div class="form-group">
														<label for="address">Address <span style="color:#F00;">*</span>:</label>
														<textarea class="form-control" name="address" id="address" required><?=$content['address']; ?></textarea>
													</div>
												</div>
												<div class="col-md-4 col-sm-12">
													<div class="form-group">
														<label for="p_phone">Primary Contact <span style="color:#F00;">*</span>:</label>
														<input type="text" class="form-control" name="p_phone" id="p_phone" value="<?=$content['p_phone']; ?>" required>
													</div>
													<div class="form-group">
														<label for="s_phone">Secondary Contact <span style="color:#F00;">*</span>:</label>
														<input type="text" class="form-control" name="s_phone" id="s_phone" value="<?=$content['s_phone']; ?>">
													</div>
												</div>
												<div class="col-md-4 col-sm-12">
													<div class="form-group">
														<label for="p_email">Primary Email <span style="color:#F00;">*</span>:</label>
														<input type="email" class="form-control" name="p_email" id="p_email" value="<?=$content['p_email']; ?>" required>
													</div>
													<div class="form-group">
														<label for="s_email">Secondary Email <span style="color:#F00;">*</span>:</label>
														<input type="email" class="form-control" name="s_email" id="s_email" value="<?=$content['s_email']; ?>">
													</div>
												</div>
											<?php }else{ ?>
												<div class="form-group">
													<label for="title">Title <span style="color:#F00;">*</span>:</label>
													<input type="text" class="form-control" name="title" id="title" value="<?=$result['title']; ?>" required>
												</div>
												<div class="col-md-12 col-sm-12">
													<div class="form-group">
														<textarea id="cms_content" style="height:200px;" name="content" required><?=$result['content']; ?></textarea>
													</div>
												</div>
											<?php } ?>
												<div class="col-md-12 col-sm-12" align="center">
													<div class="form-group">
														<button type="submit" name="submit" class="btn btn-labeled btn-success"><b><i class="icon-pen"></i></b>Update</button>
													</div>
												</div>
										<?php }}  ?>
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
<?php include'footer.php'; ?>
<script type="text/javascript">
	CKEDITOR.replace('cms_content', {
        height: 500,
   	});
</script>
