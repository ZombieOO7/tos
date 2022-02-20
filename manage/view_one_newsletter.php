<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';
if(isset($_SESSION['user_id']))
{
	
	if($_SESSION['user_role']=="1")
	{
		extract($_GET);	
		$sql="SELECT * FROM newsletters WHERE id='$id'; ";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

	}else{ header('LOCATION: home.php'); }
}
else
{
	session_destroy();
	header('LOCATION: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $page="view_one_newsletter"; ?>
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
								<h2 class="no-margin text-light">VIEW NEWS-LETTER</h2>
							</div>
							<div class="heading-elements">
								<div class="heading-btn-group">
									<button onclick="document.location.href='view_newsletters.php';" class="btn btn-danger btn-labeled btn-labeled-left rounded-round"  style="width:150px;"><b><i class="icon-circle-left2"></i></b>Go Back</button>
								</div>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h3 class="panel-title">NEWS-LETTER DETAILS</h3>
							</div>
							<div class="panel-body">
								<?php if(!empty($results)){ foreach($results as $result){ ?>
									<h4><?=$result['n_subject']; ?></h4>
									<p><?=$result['n_content']; ?></p>
								<?php }} ?>
							</div>
						</div>
					</div>
				</div>
				<!-- Main content -->
			</div>
		<!-- Page content end-->
		</div>
<!-- Page container end-->	

<script type="text/javascript">   
 $(document).ready(function() {    

 });
</script>				

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
	</body>

</html>
