<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{

	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="add_instagram_post"; ?>
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
								<h2 class="no-margin text-light">ADD POST</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/add_instagram_post.php" method="post" class="validate-add-customer" enctype="multipart/form-data" id="add_cust">
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<input type="text" class="form-control" name="post_id" id="post_id"  placeholder="Post ID" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Update Post</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="panel panel-flat">
								    <div class="page-header page-header-default">
                						<div class="page-header-content">
                							<div class="page-title">
                								<h2 class="no-margin text-light">POSTS</h2>
                							</div>
                						</div>
                					</div>
									<div class="panel-body">
									    <?php
                                            $insta_posts="SELECT posts FROM insta_posts ORDER BY id DESC LIMIT 6;";
                                            $insta_posts = $conn->query($insta_posts);
                                            $insta_posts=$insta_posts->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Post URL</th>
                                                    <th>Post Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if(!empty($insta_posts)){ foreach($insta_posts as $ip){
                                                $single_post=json_decode($ip['posts'], true);
                                                ?>
                                                <tr>
                                                    <td><?="https:".$single_post['post_url'];?></td>
                                                    <td><a href="<?=$single_post['post_url'];?>" target="_blank"><img src="<?=$single_post['post_img'];?>"/></a></td>
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
<script type="text/javascript">
$(document).ready(function() { 
	$('#btnsubmit').on('click',function()
  	{
	    if ($('#add_cust').valid()==true) 
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
