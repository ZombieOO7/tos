<?php
include_once'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

// $formatter = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);
if(isset($_SESSION['user_id']))
{
	$sql="SELECT org_logo FROM organization;";
	$query=$conn->query($sql);
	$orgLogo=$query->fetchAll(PDO::FETCH_ASSOC);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$final_title=ucwords(str_replace("_", " ", $page));
	?>
	<title><?=$final_title; ?> | Turn of Speed</title>
	<meta name="description" content="Contact Us | Arine Solutions&reg; is Leading Web Designers,eCommerce website development,digital marketing,website designing company in Thane,Mumbai">
	<meta name="keywords" content="Contact Us,Arine Solutions Thane,Website Design Company Thane,Web Design Company Thane,Website Design Thane,Web Designer Thane,Logo Design Thane,Brochure Design Thane, Thane Based Website Company,Web Designing, Web Development Company,Web Developers,Php Developers, Php Web Development,ECommerce Web Development,Linux Web Hosting, Search Engine Optimization,SEO Experts, Thane, India">
	<meta name="Copyright" content="Arine Solutions">
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<!-- 	<link href="<?=ROOT_URL;?>global_assets/js/plugins/editors/ckeditor/contents.css" rel="stylesheet" type="text/css"> -->
	<link href="<?=ROOT_URL;?>global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
	<!-- <link href="<?=ROOT_URL;?>global_assets/js/plugins/editors/summernote-0.8.12/summernote.css" rel="stylesheet" type="text/css"> -->
	<!-- /Global stylesheets -->
	<!-- Core JS files -->
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<script src="<?=ROOT_URL;?>assets/js/app.js"></script>
	<script src="<?=ROOT_URL;?>assets/js/jquery.easy-autocomplete.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/visualization/sparkline.min.js"></script>
	<link href="<?=ROOT_URL;?>global_assets/mystyle.css" rel="stylesheet" type="text/css">
</head>

<body class="navbar-top has-detached-left">
	<!-- Main navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="home.php">
				<?php if(!empty($orgLogo[0]['org_logo'])){ ?>
					<img src="<?=ROOT_URL.$orgLogo[0]['org_logo'];?>" alt="Logo" height="50%"></a>
				<?php }else{ ?>
					<img src="<?=ROOT_URL;?>global_assets/images/logo.png" alt="Logo" height="50%"></a>
				<?php } ?>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a class="sidebar-mobile-detached-toggle"><i class="icon-grid7"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-user"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<?php if(!empty($_SESSION['pic_path'])){ ?>
							<img src="<?=ROOT_URL.$_SESSION['pic_path']; ?>" alt="profile">
						<?php }else{ ?>
							<img src="<?=ROOT_URL?>global_assets/images/user_logo.png" alt="profile">
						<?php } ?>	
						<span><?php if(isset($_SESSION['username'])){echo $_SESSION['username']; }else{ echo $_SESSION['user_name']; } ?></span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?=ROOT_URL;?>models/logout.php"><i class="icon-switch2"></i> Logout</a></li>
						<?php if(strpos($_SERVER["PHP_SELF"], "view_all_organizations.php")!==false){}else{ ?>
						<li><a href="change_profile.php"><i class="icon-user-plus"></i>Change Profile</a></li>
						<li><a href="change_password.php"><i class="icon-lock"></i>Change Password</a></li>
						<?php } ?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	
	<!-- /main navbar -->
<script type="text/javascript">
$(document).ready(function(){
	<?php if(!empty($_SESSION['s'])){ ?>
        swal({
            title: "Success!",
            text: "<?=$_SESSION['s'];?>",
            confirmButtonColor: "#66BB6A",
            type: "success",
            confirmButton:true,
            timer:5000

        });
   <?php } unset($_SESSION['s']); ?>
    // Error alert
    <?php if(!empty($_SESSION['e'])){ ?>
        swal({
            title: "Error!",
            text: "<?=$_SESSION['e'];?>",
            confirmButtonColor: "#EF5350",
            type: "error",
            confirmButton:true,
            timer:5000
        });
    <?php } unset($_SESSION['e']); ?>
     // Info alert
     <?php if(!empty($_SESSION['i'])){ ?>
        swal({
            title: "Information!",
            text: "<?=$_SESSION['i'];?>",
            confirmButtonColor: "#2196F3",
            type: "info",
            confirmButton:true,
            timer:5000
        });
   <?php } unset($_SESSION['i']); ?>
});

</script>




