<?php
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';
// $id = $_SESSION['user_id'];
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

<?php $page="home"; ?>
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
					<div class="content">
						
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
