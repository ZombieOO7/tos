<?php 
session_start();
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sqlp="SELECT * FROM news_category WHERE status='0' ORDER BY id DESC;";
		$queryp= $conn->query($sqlp);
		$news_category=$queryp->fetchAll(PDO::FETCH_ASSOC);
		
	}else{ header('LOCATION: home.php'); }

} 
else
{ 
	header('LOCATION: index.php'); 
} 
?>

<?php $page="view_news_category"; ?>
<!-- Main navbar -->
<?php include'header.php'; ?>
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
						<h2 class="no-margin text-light">NEWS CATEGORIES</h2>
					</div>
					<div class="heading-elements">
						<div class="heading-btn-group">
							<button name="submit" data-toggle="modal" data-target="#modal_addNC" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b>Add News Category</button>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="panel panel-flat">
							<div class="panel-body">
								<table class="table datatable-basic-uo table-striped table-bordered">
									<thead>
										<tr>
											<th>Category</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($news_category)){ foreach ($news_category as $nc) { ?>
											<tr>
												<td><?=$nc['name'];?></td>
												<td>
													<ul class="icons-list">
														<li class="text-primary-600">
															<a data-toggle="modal" data-target="#modal_editNC" data-id="<?=$nc['id'];?>" class="modelopen" data-popup="tooltip" data-original-title="Edit"><i class="icon-pencil6"></i></a>
														</li>
														<li class="text-primary-600">
															<a data-id="<?=$nc['id'];?>" class="modeldelete" data-popup="tooltip" data-original-title="Delete"><i class="icon-trash"></i></a>
														</li>
													</ul>
												</td>
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


<!-- edit review Model -->
<div id="modal_editNC" class="modal fade open">
	<div class="modal-dialog">
		<div class="modal-content" style="border:2px solid #ddd;">
			<div class="modal-header" style="border:2px solid #ddd;">
				<h5 class="modal-title">EDIT NEWS CATEGORY</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('edit_nc_form').reset();" >×</button>
			</div>
			<div class="modal-body">
				<div id="msg"></div>
				<form action="<?=ROOT_URL;?>models/edit_nc.php" id="edit_nc_form" method="post" class="validate-edit-incategory">
					<div class="col-md-12 col-sm-12">
						<input type="hidden" name="en_id" id="en_id" readonly>
						<div class="form-group">
							<label class="col-lg-4 control-label" for="enews_name">News Category <span style="color:#FF0000;">*</span> :</label>
							<div class="col-lg-7">
								<input name="enews_name" id="enews_name" class="form-control" required>
							</div>
						</div><br>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12" align="center">
							<div class="form-group"><br>
								<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-pen"></i></b>Edit</button>
								<a data-dismiss="modal" onclick="document.getElementById('edit_nc_form').reset();" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!-- /edit review Model -->

<!--add review Model -->
<div id="modal_addNC" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content" style="border:2px solid #ddd;">
			<div class="modal-header" style="border:2px solid #ddd;">
				<h5 class="modal-title">ADD NEWS CATEGORY</h5>
				<button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('add_nc_form').reset();" >×</button>
			</div>
			<div class="modal-body">
				<div id="msg"></div>
				<form action="<?=ROOT_URL;?>models/add_nc.php" id="add_nc_form" method="post" class="validate-add-incategory">
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label class="col-lg-4 control-label" for="news_name">News Category <span style="color:#FF0000;">*</span> :</label>
							<div class="col-lg-7">
								<input name="news_name" id="news_name" class="form-control" required>
							</div>
						</div><br>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12" align="center">
							<div class="form-group "><br>
								<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Add</button>
								<a data-dismiss="modal" onclick="document.getElementById('add_nc_form').reset();" class="btn btn-md btn-danger btn-labeled"><b><i class="icon-reload-alt"></i></b>Cancel</a>
							</div>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
<!-- /add review Model -->


<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','.modelopen', function (e) {
			e.preventDefault();
			var r_id = $(this).data('id');

			if(r_id=="")
			{
				return false;
			}
			else
			{	
				$.ajax({
					type: 'POST',
					url: '<?=ROOT_URL;?>models/get_nc.php',
					data:{'r_id':r_id},
					dataType:'json',
					success: function (response) 
					{
						$.each(response, function () 
						{
							$("#en_id").val(this.id);
							$("#enews_name").val(this.name);
						});
					}
				});
			}
		});

		$(document).on('click','.modeldelete', function (e) {
			e.preventDefault();
			var dr_id =$(this).data('id');

			if(dr_id=="")
			{
				return false;
			}
			else
			{	
				swal({
					title: 'Are You Sure ?',
					text: 'Delete This News Category',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#EF5350',
					confirmButtonText: 'Yes, Delete',
					cancelButtonText: 'No, Cancel',
					closeOnConfirm: true,
					closeOnCancel: true
				},
				function(isConfirm)
				{
					if (isConfirm) 
					{
						$.ajax({
							type: 'POST',
							url: '<?=ROOT_URL;?>models/delete_nc.php',
							data:{'dr_id':dr_id},
							/*dataType:'json',*/
							success: function (response) 
							{
								window.location.reload();
							}
						});
					}
				});
			}
		});	

		$('#btnsubmit').on('click',function()
		{
			if ($('#add_nc_form').valid()==true) 
			{
				setTimeout(function () { disableButton(); }, 0);
			}
		});

	});
	function disableButton() 
	{
		$("#btnsubmit").html('<b><i class="icon-spinner6"></i></b>Please wait').attr('disabled','disabled');
	}
</script>
<!-- FOOTER START -->
<?php include 'footer.php'; ?>
<!-- FOOTER END -->
</body>

</html>