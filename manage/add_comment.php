<?php
session_start();
include_once'config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

if(isset($_SESSION['user_id']))
{
	if($_SESSION['user_role']=="1")
	{
		$sqlc="SELECT * FROM customers;";
		$qc=$conn->query($sqlc);
		$customers=$qc->fetchAll(PDO::FETCH_ASSOC);

		$sqlp="SELECT * FROM posts ORDER BY id DESC;";
		$qp=$conn->query($sqlp);
		$posts=$qp->fetchAll(PDO::FETCH_ASSOC);

		$sqln="SELECT * FROM news ORDER BY id DESC;";
		$qn=$conn->query($sqln);
		$news=$qn->fetchAll(PDO::FETCH_ASSOC);

		$sqlb="SELECT * FROM blog ORDER BY id DESC;";
		$qb=$conn->query($sqlb);
		$blog=$qb->fetchAll(PDO::FETCH_ASSOC);

		$sqlv="SELECT * FROM videos ORDER BY id DESC;";
		$qv=$conn->query($sqlv);
		$videos=$qv->fetchAll(PDO::FETCH_ASSOC);

		$sqlev="SELECT * FROM evs ORDER BY id DESC;";
		$qev=$conn->query($sqlev);
		$evs=$qev->fetchAll(PDO::FETCH_ASSOC);

	}else{header('LOCATION: home.php');}	
}
else
{
	header('LOCATION: index.php'); 
}

?>

<!DOCTYPE html>
<html lang="en">

<?php $page="add_comment"; ?>
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
								<h2 class="no-margin text-light">ADD COMMENT</h2>
							</div>
						</div>
					</div>
					<div class="content">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="panel panel-flat">
									<div class="panel-body">
										<form action="<?=ROOT_URL;?>models/add_comment.php" method="post" class="validate-add-customer" id="add_comment">
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<label for="cust_id">Customer <span style="color:#FF0000;">*</span>:</label>
													<select name="cust_id" id="cust_id" class="form-control select-search" required>
														<option value="">--Select Customer--</option>
													<?php if(!empty($customers)){ foreach($customers as $cust){ ?>
														<option value="<?=$cust['id']; ?>"><?=$cust['cust_name']; ?></option>
													<?php }} ?>	
													</select>
												</div>
												<div class="form-group post">
													<label for="post_id">Post <span style="color:#FF0000;">*</span>:</label>
													<select name="post_id" id="post_id" class="form-control select-search" required>
														<option value="">--Select Post--</option>
													<?php if(!empty($posts)){ foreach($posts as $post){ ?>
														<option value="<?=$post['id']; ?>"><?=$post['p_name']; ?></option>
													<?php }} ?>
													</select>
												</div>
												<div class="form-group blog">
													<label for="blog_id">Blog <span style="color:#FF0000;">*</span>:</label>
													<select name="blog_id" id="blog_id" class="form-control select-search" required>
														<option value="">--Select blog--</option>
													<?php if(!empty($blog)){ foreach($blog as $blg){ ?>
														<option value="<?=$blg['id']; ?>"><?=$blg['b_name']; ?></option>
													<?php }} ?>
													</select>
												</div>
												<div class="form-group news">
													<label for="news_id">News <span style="color:#FF0000;">*</span>:</label>
													<select name="news_id" id="news_id" class="form-control select-search" required>
														<option value="">--Select News--</option>
													<?php if(!empty($news)){ foreach($news as $new){ ?>
														<option value="<?=$new['id']; ?>"><?=$new['n_name']; ?></option>
													<?php }} ?>	
													</select>
												</div>
												<div class="form-group video">
													<label for="video_id">Video <span style="color:#FF0000;">*</span>:</label>
													<select name="video_id" id="video_id" class="form-control select-search" required>
														<option value="">--Select Video--</option>
													<?php if(!empty($videos)){ foreach($videos as $video){ ?>
														<option value="<?=$video['id']; ?>"><?=$video['v_title']; ?></option>
													<?php }} ?>	
													</select>
												</div>
												<div class="form-group evs">
													<label for="ev_id">EV's <span style="color:#FF0000;">*</span>:</label>
													<select name="ev_id" id="ev_id" class="form-control select-search" required>
														<option value="">--Select EV--</option>
													<?php if(!empty($evs)){ foreach($evs as $ev){ ?>
														<option value="<?=$ev['id']; ?>"><?=$ev['e_name']; ?></option>
													<?php }} ?>	
													</select>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group ">
													<label for="comment">Comment <span style="color:#FF0000;">*</span>:</label>
													<textarea name="comment" class="form-control" rows="10" required></textarea>
												</div>
											</div>
											<div class="row">
												<div class="form-group ">
													<div class="col-md-12 col-sm-12" align="center">
														<button type="submit" name="submit" id="btnsubmit" class="btn btn-success btn-labeled"><b><i class="icon-check"></i></b>Add</button>
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

$("#post_id").change(function(){
	if($("#post_id").val())
	{
		$('#blog_id').attr("required",false);
		$('.blog').hide();

		$('#news_id').attr("required",false);
		$('.news').hide();

		$('#video_id').attr("required",false);
		$('.video').hide();

		$('#ev_id').attr("required",false);
		$('.evs').hide();
	}
	else
	{
		$('.blog').show();
		$('#blog_id').attr("required",true);

		$('.news').show();
		$('#news_id').attr("required",true);

		$('.video').show();
		$('#video_id').attr("required",true);

		$('.evs').show();
		$('#ev_id').attr("required",true);

	}

});

$("#blog_id").change(function(){

	if($("#blog_id").val())
	{
		$('#post_id').attr("required",false);
		$('.post').hide();

		$('#news_id').attr("required",false);
		$('.news').hide();

		$('#video_id').attr("required",false);
		$('.video').hide();

		$('#ev_id').attr("required",false);
		$('.evs').hide();
	}
	else
	{
		$('.post').show();
		$('#post_id').attr("required",true);

		$('.news').show();
		$('#news_id').attr("required",true);

		$('.video').show();
		$('#video_id').attr("required",true);

		$('.evs').show();
		$('#ev_id').attr("required",true);
	}
});

$("#news_id").change(function(){

	if($("#news_id").val())
	{
		$('#blog_id').attr("required",false);
		$('.blog').hide();

		$('#post_id').attr("required",false);
		$('.post').hide();

		$('#video_id').attr("required",false);
		$('.video').hide();

		$('#ev_id').attr("required",false);
		$('.evs').hide();
	}
	else
	{
		$('.blog').show();
		$('#blog_id').attr("required",true);

		$('.post').show();
		$('#post_id').attr("required",true);

		$('.video').show();
		$('#video_id').attr("required",true);

		$('.evs').show();
		$('#ev_id').attr("required",true);
	}
});


$("#video_id").change(function(){

	if($("#video_id").val())
	{
		$('#blog_id').attr("required",false);
		$('.blog').hide();

		$('#post_id').attr("required",false);
		$('.post').hide();

		$('#news_id').attr("required",false);
		$('.news').hide();

		$('#ev_id').attr("required",false);
		$('.evs').hide();
	}
	else
	{
		$('.blog').show();
		$('#blog_id').attr("required",true);

		$('.post').show();
		$('#post_id').attr("required",true);

		$('.news').show();
		$('#news_id').attr("required",true);

		$('.evs').show();
		$('#ev_id').attr("required",true);
	}
});

$("#ev_id").change(function(){

	if($("#ev_id").val())
	{
		$('#blog_id').attr("required",false);
		$('.blog').hide();

		$('#post_id').attr("required",false);
		$('.post').hide();

		$('#news_id').attr("required",false);
		$('.news').hide();

		$('#video_id').attr("required",false);
		$('.video').hide();
	}
	else
	{
		$('.blog').show();
		$('#blog_id').attr("required",true);

		$('.post').show();
		$('#post_id').attr("required",true);

		$('.news').show();
		$('#news_id').attr("required",true);

		$('.video').show();
		$('#video_id').attr("required",true);
	}
});

	$('#btnsubmit').on('click',function()
  	{
	    if ($('#add_comment').valid()==true) 
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
