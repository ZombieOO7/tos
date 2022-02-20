<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
if(isset($_SESSION['user_id']))
{

	if($_SESSION['user_role']=="1")
	{
		$sql="SELECT o.id,o.org_name,o.org_cpname,o.org_pemail,o.org_semail,o.org_pphone,o.org_sphone,o.org_country,o.org_state,o.org_address,o.org_pin,o.org_gstno,o.org_logo,o.org_cin,o.org_llpin,o.org_url,co.countries_name,s.state_name FROM organization o 
				JOIN ".$rootdb.".countries co ON o.org_country=co.countries_id
				JOIN ".$rootdb.".states s ON o.org_state=s.id;";
		$query=$conn->query($sql);
		$results=$query->fetchAll(PDO::FETCH_ASSOC);

		$sqlc="SELECT * FROM ".$rootdb.".countries;";
		$queryc= $conn->query($sqlc);
		$countries=$queryc->fetchAll(PDO::FETCH_ASSOC);

		$sqls="SELECT * from ".$rootdb.".states order by state_name;";
		$querys= $conn->query($sqls);
		$states=$querys->fetchAll(PDO::FETCH_ASSOC);

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

<?php $page="edit_organization"; ?>
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
								<h2 class="no-margin text-light">EDIT ORGANIZATION</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/edit_organization.php" class="validate-add-organization" method="post" enctype="multipart/form-data">
											<?php if(!empty($results)){ foreach($results as $result){ ?>
												<div class="col-md-6 col-sm-6">
													<div class="form-group ">
														<input type="hidden" name="org_id" value="<?=$id;?>">
														<label for="org_name">Organization Name <span style="color:#FF0000">*</span> :</label>
														<input type="text" class="form-control" value="<?=$result['org_name'];?>" name="org_name"  placeholder="Enter Organization Name" required >
													</div>
													<div class="form-group ">
														<label for="org_cpname">Contact Person Name <span style="color:#FF0000">*</span> :</label>
														<input type="text" class="form-control" value="<?=$result['org_cpname'];?>" name="org_cpname"  placeholder="Enter Contact Person Name" required >
													</div>
													<div class="form-group ">
														<label for="org_pphone">Primary Contact No <span style="color:#FF0000">*</span> :</label>
														<input type="text" class="form-control" value="<?=$result['org_pphone'];?>" name="org_pphone"  placeholder="Enter Primary Phone" required >
													</div>
													<div class="form-group ">
														<label for="org_pemail">Primary Email <span style="color:#FF0000">*</span> :</label>
														<input type="email" class="form-control" value="<?=$result['org_pemail'];?>" name="org_pemail"  placeholder="Enter Primary Email" required >
													</div>
													<div class="form-group ">
														<label for="org_sphone">Secondary Contact No :</label>
														<input type="text" class="form-control" value="<?=$result['org_sphone'];?>" name="org_sphone"  placeholder="Enter Secondary Phone" >
													</div>
													<div class="form-group ">
														<label for="org_semail">Secondary Email :</label>
														<input type="email" class="form-control" value="<?=$result['org_semail'];?>" name="org_semail"  placeholder="Enter Secondary Email" >
													</div>

													<div class="form-group ">
														<label for="org_country">Country <span style="color:#FF0000">*</span> : </label>
														<select class="form-control select-search" name="org_country" id="org_country" required >
															<option value="">--Select Country--</option>
															<?php if(!empty($countries)){ foreach ($countries as $country) { if($country['countries_name']==$result['countries_name']){ ?>
																<option value="<?=$country['countries_id'];?>" selected><?=$country['countries_name'];?></option>	
															<?php }else{ ?>
																<option value="<?=$country['countries_id'];?>"><?=$country['countries_name'];?></option>
															<?php }}} ?>
														</select>
													</div>

													<div class="form-group ">
														<label for="org_state">State <span style="color:#FF0000">*</span> :  </label>
														<select class="form-control select-search" name="org_state" id="org_state" required >
															<option value="">--Select State--</option>
															<?php if(!empty($states)){ foreach ($states as $state) { if($state['state_name']==$result['state_name']){?>
																<option value="<?=$state['id'];?>" selected><?=$state['state_name'];?></option>
															<?php }else{?>
																<option value="<?=$state['id'];?>"><?=$state['state_name'];?></option>
															<?php }}} ?>
														</select>
													</div>
												</div>
												<div class="col-md-6 col-sm-6">
													<div class="form-group ">
														<label for="org_address">Address <span style="color:#FF0000">*</span> :</label>
														<textarea class="form-control" name="org_address" style="height:119px;"  placeholder="Enter Organization Address" required><?=$result['org_address'];?></textarea> 
													</div>

													<div class="form-group ">
														<label for="org_pin">Pincode <span style="color:#FF0000">*</span> :</label>
														<input type="text" class="form-control" value="<?=$result['org_pin'];?>" name="org_pin" id="org_pin" placeholder="Enter Pincode" required>
													</div>

													<div class="form-group ">
														<label for="org_gstno">GST No : </label>
														<?php $gstcode=substr($result['org_gstno'],0,2);
														$result['org_gstno']=str_replace($gstcode, "", $result['org_gstno']);	
														?>
														<div class="input-group">
															<span class="input-group-addon" id="gst"></span>
															<input type="hidden" name="gstcode" id="gstcode">
															<input type="text" class="form-control" name="org_gstno" id="org_gstno" value="<?=$result['org_gstno'];?>" placeholder="Enter GST No" >
														</div>
													</div>
													<div class="form-group ">
														<label for="org_logo">Upload Logo :</label>
														<input type="file" class="form-control file-upload" name="org_logo" accept="image/x-png,image/jpeg"  placeholder="Upload Logo">
													</div>
													<div class="form-group ">
														<label for="org_cin">CIN No :</label>
														<input type="text" class="form-control" value="<?=$result['org_cin'];?>" name="org_cin"  placeholder="Enter Organization CIN" >
													</div>
													<div class="form-group ">
														<label for="org_llpin">LLP-IN No :</label>
														<input type="text" class="form-control" value="<?=$result['org_llpin'];?>" name="org_llpin"  placeholder="Enter Organization LLP-IN" >
													</div>
													<div class="form-group ">
              											<label for="org_url">Website URL : </label>
                										<input type="text" class="form-control" name="org_url" id="org_url" value="<?=$result['org_url'];?>" placeholder="example.com">
            										</div>
												</div>

												<div class="row">
													<div class="col-md-12 col-sm-12" align="center">
														<div class="form-group ">
															<button type="submit" name="submit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Save</button>
														</div>
													</div>
												</div>
											<?php }} ?>
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
	$(document).ready(function() {

		var c_id=$('#org_country').val();
	        $.ajax({
            	type: 'POST',
            	url: '<?=ROOT_URL;?>functions/get_states.php',
            	data: {'c_id':c_id},
            	dataType:'json',
            	success: function (data) 
            	{
            		$('#org_state').empty();
            		var optionArray =[];
            		optionArray.push("<option value=''>--select--</option>");
            		$.each(data, function () 
            		{
			       		if(this.id==<?=$results[0]['org_state']?>)
			       		{
			       			optionArray.push("<option value='"+this.id+"' selected>"+ this.state_name+"</option>");
			       		}
			       		else
			       		{
			       			optionArray.push("<option value='"+this.id+"'>"+ this.state_name+"</option>");
			       		}	
		   			});
		   				
		   			for (i = 0; i < optionArray.length; i++) 
		   			{ 
						$('#org_state').append(optionArray[i]);
					}
            	}
            });

		$("#org_country").change(function() 
		{
	        var c_id=$('#org_country').val();
	        $.ajax({
            	type: 'POST',
            	url: '<?=ROOT_URL;?>functions/get_states.php',
            	data: {'c_id':c_id},
            	dataType:'json',
            	success: function (data) 
            	{
            		$('#org_state').empty();
            		var optionArray =[];
            		$.each(data, function () 
            		{
			       		if(this.id==<?=$results[0]['org_state']?>)
			       		{
			       			optionArray.push("<option value='"+this.id+"' selected>"+ this.state_name+"</option>");
			       		}
			       		else
			       		{
			       			optionArray.push("<option value='"+this.id+"'>"+ this.state_name+"</option>");
			       		}		
		   			});
		   				
		   			for (i = 0; i < optionArray.length; i++) 
		   			{ 
						$('#org_state').append(optionArray[i]);
					}
            	}
            });
	    });

	    var s_id=$('#org_state').val();
	    $('#org_gstno').empty();
	    $.ajax({
           	type: 'POST',
            url: '<?=ROOT_URL;?>functions/get_gstin.php',
            data: {'s_id':s_id},
            dataType:'json',
            success: function (data) 
            {
            	/*alert(data);*/
				$('#gst').html(data);	
				$('#gstcode').val(data);
            }
        });

		$("#org_state").change(function() {
			$('#org_gstno').empty();
		    var s_id=$('#org_state').val();
		    $.ajax({
	            type: 'POST',
	            url: '<?=ROOT_URL;?>functions/get_gstin.php',
	            data: {'s_id':s_id},
	            dataType:'json',
	            success: function (data) 
	            {
	            	/*alert(data);*/
					$('#gst').html(data);	
					$('#gstcode').val(data);
	            }
	        });
	    });
	});
</script>

<!-- FOOTER START -->
<?php include'footer.php'; ?>
<!-- FOOTER END -->
	</body>

</html>
