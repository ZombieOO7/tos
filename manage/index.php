<?php 
session_start();
include_once 'config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(!empty($_SESSION['user_id']))
{
	header("LOCATION:".ROOT_URL."home.php");
}

$digits = 5;
$captcha= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login | Turn Of Speed </title>
	<meta name="description" content="Contact Us | Arine Solutions&reg; is Leading Web Designers,eCommerce website development,digital marketing,website designing company in Thane,Mumbai">
	<meta name="keywords" content="Contact Us,Arine Solutions Thane,Website Design Company Thane,Web Design Company Thane,Website Design Thane,Web Designer Thane,Logo Design Thane,Brochure Design Thane, Thane Based Website Company,Web Designing, Web Development Company,Web Developers,Php Developers, Php Web Development,ECommerce Web Development,Linux Web Hosting, Search Engine Optimization,SEO Experts, Thane, India"/>
	<meta name="Copyright" content="Arine Solutions" />
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?=ROOT_URL;?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/loaders/pace.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/core/libraries/jquery.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/core/libraries/bootstrap.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<!-- /core JS files -->
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
</head>

<body class="login-container login-cover" style="background:#000;">
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="content pb-20" style="min-height: auto;">
					<form action="<?=ROOT_URL;?>models/login.php" method="post" class="form-validate">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="border-slate-300 text-slate-300"><img src="<?=ROOT_URL_FRONT."images/logo.png";?>" width="80%" style="background: #000;border: 10px solid #000;"/></div>
								<h5 class="content-group">Login to your account <small class="display-block">Your credentials</small></h5>
							</div>
							<br>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="username" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<input type="text" class="form-control text-center text-info" size="10" style="font-weight:bold;color:#b71c0c !important;" disabled value="<?=$captcha; ?>">
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="hidden" value="<?=$captcha;?>" name="captcha">
								<input type="text" class="form-control" placeholder="Enter Captcha" name="Ucaptcha" required="required" autocomplete="off">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options" style="display:none;">
								<div class="row">
									<div class="col-sm-6">
										<input type="checkbox" name="remember" id="remember" checked>
										Remember
									</div>

									<div class="col-sm-6 text-right">
										<a href="login_password_recover.php">Forgot password?</a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-block" style="background:#b71c0c;color:#fff;">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Theme JS files -->
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/forms/validation/validate.min.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?=ROOT_URL;?>assets/js/app.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<!-- /theme JS files -->
	<!-- page js -->
	<script src="<?=ROOT_URL;?>global_assets/js/demo_pages/form_select2.js"></script>
	<script src="<?=ROOT_URL;?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<!-- /page js-->
</body>
</html>