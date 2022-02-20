<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		extract($_GET);
		$sql="SELECT * FROM polls WHERE id='$id';";
		$query= $conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

		$sqlop="SELECT * FROM poll_options WHERE poll_id='$id' ORDER BY id ASC;";
		$qop= $conn->query($sqlop);
		$options=$qop->fetchAll(PDO::FETCH_ASSOC);


	}else{ header('LOCATION: home.php'); }
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">
<?php $page="edit_poll"; ?>
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
						<h2 class="no-margin text-light">CREATE POLL</h2>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="panel panel-flat">
							<div class="panel-body">
								<form action="<?=ROOT_URL;?>models/edit_poll.php" method="post" class="validate-add-customer" id="edit_poll">
									<div class="col-md-12 col-sm-6">
										<div class="form-group ">
											<label for="poll_question">Poll Question <span style="color:#FF0000;">*</span>:</label>
											<input type="hidden" name="p_id" value="<?=$results[0]['id']; ?>">
											<input type="text" class="form-control" name="poll_question" id="poll_question"  placeholder="Enter Your Question" value="<?=$results[0]['question']?>" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label for="from_date">From Date <span style="color:#FF0000;">*</span>:</label>
											<input type="text" class="form-control a_date" name="from_date" id="from_date"  placeholder="DD-MM-YYYY" value="<?php if(!empty($results[0]['from_date'])){ echo date('d-m-Y',strtotime($results[0]['from_date'])); } ?>" readonly required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label for="to_date">To Date <span style="color:#FF0000;">*</span>:</label>
											<input type="text" class="form-control b_date" name="to_date" id="to_date"  placeholder="DD-MM-YYYY" value="<?php if(!empty($results[0]['to_date'])){ echo date('d-m-Y',strtotime($results[0]['to_date'])); } ?>" readonly required>
										</div>
									</div>

									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label for="poll_ans1">Option 1 <span style="color:#FF0000;">*</span>:</label>
											<input type="hidden" name="opt1" value="<?php if(!empty($options[0]['id'])){ echo $options[0]['id']; } ?>">
											<input type="text" class="form-control" name="poll_ans1" id="poll_ans1" placeholder="Enter option 1" value="<?php if(!empty($options[0]['options'])){ echo $options[0]['options']; } ?>" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label for="poll_ans2">Option 2 <span style="color:#FF0000;">*</span>:</label>
											<input type="hidden" name="opt2" value="<?php if(!empty($options[1]['id'])){ echo $options[1]['id']; } ?>">
											<input type="text" class="form-control" name="poll_ans2" id="poll_ans2" placeholder="Enter option 2" value="<?php if(!empty($options[1]['options'])){ echo $options[1]['options']; } ?>" autocomplete="off" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label for="poll_ans3">Option 3 :</label>
											<input type="hidden" name="opt3" value="<?php if(!empty($options[2]['id'])){ echo $options[2]['id']; } ?>">
											<input type="text" class="form-control" name="poll_ans3" id="poll_ans3" placeholder="Enter option 3" value="<?php if(!empty($options[2]['options'])){ echo $options[2]['options']; } ?>" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group ">
											<label for="poll_ans4">Option 4 :</label>
											<input type="hidden" name="opt4" value="<?php if(!empty($options[3]['id'])){ echo $options[3]['id']; } ?>">
											<input type="text" class="form-control" name="poll_ans4" id="poll_ans4" placeholder="Enter option 4" value="<?php if(!empty($options[3]['options'])){ echo $options[3]['options']; } ?>" autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="form-group ">
											<div class="col-md-12 col-sm-12" align="center">
												<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-pen"></i></b>Edit</button>
											</div>
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
	$('#btnsubmit').on('click',function()
  	{
	    if ($('#edit_poll').valid()==true) 
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
