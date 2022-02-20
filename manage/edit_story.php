<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		extract($_GET);
		$sql="SELECT * FROM stories WHERE id='$id';";
		$query_db = $conn->query($sql);
		$results=$query_db->fetchAll(PDO::FETCH_ASSOC);

		$story_data="SELECT * FROM story_items WHERE story_id='".$results[0]['id']."';";
		$story_data = $conn->query($story_data);
		$story_data=$story_data->fetchAll(PDO::FETCH_ASSOC);
	}else{ header('LOCATION: home.php'); }	
}
else
{
	header('LOCATION: index.php'); 
}

?>
<!DOCTYPE html>
<html lang="en">
<?php $page="edit_story"; ?>
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
								<h2 class="no-margin text-light">EDIT STORY</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL; ?>models/edit_story.php" method="post" enctype="multipart/form-data">
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<input type="hidden" name="st_id" value="<?=$results[0]['id'];?>">
													<label for="gallery_file">Name : <span style="color:#F00;">*</span></label>
													<input type="text" class="form-control" name="name" value="<?=$results[0]['name'];?>" required>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label for="gallery_file">Cover Image : </label>
													<input type="file" class="form-control file-upload" name="cover_img">
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
															<?php $i=0; foreach ($story_data as $sd) { ?>
															<tr>
																<td><input type="file" class="form-control" name="all_data[<?=$i;?>][img]" id="img<?=$i;?>"></td>
																<td>
																	<select class="form-control" name="all_data[<?=$i;?>][animation]">
																		<option value="1" <?php echo $sd['animation']=="1" ? 'selected' : ''; ?>>Left to Right</option>
																		<option value="2" <?php echo $sd['animation']=="2" ? 'selected' : ''; ?>>Right to Left</option>
																		<option value="3" <?php echo $sd['animation']=="3" ? 'selected' : ''; ?>>Zoom Out</option>
																	</select>
																</td>
																<td><input type="text" class="form-control" name="all_data[<?=$i;?>][title]" id="title<?=$i;?>" value="<?=$sd['title'];?>"></td>
																<td><input type="text" size="10" class="form-control" name="all_data[<?=$i;?>][description]" id="description<?=$i;?>" value="<?=$sd['description'];?>"></td>
																<td><input type="text" class="form-control" name="all_data[<?=$i;?>][link]" id="link<?=$i;?>" value="<?=$sd['link'];?>"></td>
															</tr>
															<?php $i++; } ?>
															<?php for ($j=count($story_data); $j < 7 ; $j++) { ?>
															<tr>
																<td><input type="file" class="form-control" name="all_data[<?=$j;?>][img]" id="img<?=$j;?>"></td>
																<td>
																	<select class="form-control" name="all_data[<?=$i;?>][animation]">
																		<option value="1">Left to Right</option>
																		<option value="2">Right to Left</option>
																		<option value="3">Zoom Out</option>
																	</select>
																</td>
																<td><input type="text" class="form-control" name="all_data[<?=$j;?>][title]" id="title<?=$j;?>"></td>
																<td><input type="text" size="10" class="form-control" name="all_data[<?=$j;?>][description]" id="description<?=$j;?>"></td>
																<td><input type="text" class="form-control" name="all_data[<?=$j;?>][link]" id="link<?=$j;?>"></td>
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
