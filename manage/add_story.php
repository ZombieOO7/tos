<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{

	}else{ header('LOCATION: home.php'); }	
}
else
{
	header('LOCATION: index.php'); 
}

?>
<!DOCTYPE html>
<html lang="en">
<?php $page="add_story"; ?>
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
								<h2 class="no-margin text-light">ADD STORY</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL; ?>models/add_story.php" method="post" enctype="multipart/form-data">
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="gallery_file">Name : <span style="color:#F00;">*</span></label>
													<input type="text" class="form-control" name="name" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="gallery_file">Cover Image : <span style="color:#F00;">*</span></label>
													<input type="file" class="form-control file-upload" name="cover_img" required>
												</div>
											</div>
											<div class="col-md-12 col-sm-12">
												<div class="table-responsive">
													<table class="table table-striped table-bordered" id="myTable">
														<thead>
															<tr>
																<th width="15%">Image</th>
																<th width="10%">Animation</th>
																<th width="10%">Title</th>
																<th width="20%">Description</th>
																<th width="10%">Button/Link</th>
															</tr>
														</thead>
														<tbody>
															<?php for ($i=0; $i <= 7 ; $i++) { ?>
															<tr>
																<td><input type="file" class="form-control" name="all_data[<?=$i;?>][img]" id="img<?=$i;?>"></td>
																<td>
																	<select class="form-control" name="all_data[<?=$i;?>][animation]">
																		<option value="1">Left to Right</option>
																		<option value="2">Right to Left</option>
																		<option value="3">Zoom Out</option>
																	</select>
																</td>
																<td><input type="text" class="form-control" name="all_data[<?=$i;?>][title]" id="title<?=$i;?>"></td>
																<td><input type="text" size="10" class="form-control limit" name="all_data[<?=$i;?>][description]" id="description<?=$i;?>"></td>
																<td><input type="text" class="form-control" name="all_data[<?=$i;?>][link]" id="link<?=$i;?>"></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
											
											<div class="col-md-12 col-sm-12" align="center">
												<div class="form-group" style="margin-top: 25px;">
													<button type="submit" class="btn btn-success btn-labeled" name="submit"><b><i class="icon-check"></i></b>Submit</button>
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
<script type="text/javascript">
	$(document).ready(function(){
		$('.addRow').click(function () {
			var count = $('#myTable tbody tr:last').attr('id');
			if(isNaN(count))
			{
				count=1;
			}
			else
			{
				count++;
			}

			$('#myTable tbody').append('<tr id="'+count+'"><td><input type="file" class="form-control" name="all_data[img][]" id="img'+count+'" required></td><td><input type="text" class="form-control" name="all_data[title][]" id="title'+count+'" required></td><td><input type="text" size="10" class="form-control" name="all_data[description][]" id="description'+count+'" required></td><td><input type="text" class="form-control" name="all_data[link][]" id="link'+count+'"></td><td><a class="btn btn-xs btn-danger" id="row'+count+'" onclick="removeRow(this);"><i class="icon-trash"></i></a></td></tr>');
		});  
	});

	function removeRow(data)
	{
		var count = $('#myTable tbody tr:last').attr('id');
		var rowCount = $('#myTable tbody tr').length;
		if(rowCount<=1)
		{
			swal({title: "Add Items In Invoice !!!",type: "info"});
		}
		else
		{
			data.closest("tr").remove();	
		}
	}
</script>
<?php include 'footer.php'; ?>
