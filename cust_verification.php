<?php
$page_name="Customer Verification";

session_start();
include 'manage/config/master.inc.php';
include_once ROOT_PATH.'functions/mac_ip_mapping.php';
include_once ROOT_PATH.'config/connection.php';
$verify_date=date("Y-m-d H:i:s");
$digits = 5;
$captcha= str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

if(isset($_GET['email']))
{
	extract($_GET);
	$sqlhash="SELECT hash_key FROM customers WHERE cust_email='$email';";
	$qhash = $conn->query($sqlhash);
	$reshash=$qhash->fetchAll(PDO::FETCH_ASSOC);
	
	if(empty($reshash[0]['hash_key']))
	{
		$page_name='Customer Verification';
		include 'header.php';
		echo '<main id="main" class="site-content">
				<section class="section-full">
					<div class="mag-content-body">
					    <div class="container">
					        <div class="row">
					        	<div class="col-md-6 col-sm-12 col-md-offset-3">
									<div class="hover-shadow" style="padding:10px; border-radius: 5px; background-color: #FFF;">
										<h4 class=" bg-success" style="text-align:center;">Email Verification Already Done, Go Login !!!</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</main>';
		include 'footer.php';
		die();
	}
	else
	{
		$sqlcheck="SELECT * FROM customers WHERE hash_key='$hash' AND cust_email='$email';";
		$qcheck = $conn->query($sqlcheck);
		$results=$qcheck->fetchAll(PDO::FETCH_ASSOC);
	}	
	
}
?>

<?php $page_name="Customer Verification"; ?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
	<section class="section-full">
		<div class="mag-content-body">
		    <div class="container">
		        <div class="row">
		        	<div class="col-md-6 col-sm-12 col-md-offset-3">
						<div class="hover-shadow" style="padding:10px; border-radius: 5px; background-color: #FFF;">
							<?php  if(!empty($results)) { 
								$sqlup="UPDATE customers SET verify_status='1',verify_date='$verify_date' WHERE hash_key='$hash' AND cust_email='$email';";
								$qup=$conn->prepare($sqlup);
								$qup->execute();
								
								$sqldel="UPDATE customers SET hash_key=NULL WHERE hash_key='$hash' AND cust_email='$email';";
								$qdel=$conn->prepare($sqldel);
								$qdel->execute();

								$verify_status="success";
							?>
								<h3 class="no-margin text-center bg-success">VERIFIED SUCCESSFULLY !!!</h3>
							<?php }else{ $verify_status="failed"; ?>
								<h3 class="no-margin text-center bg-danger" id="msg">VERIFICATION FAILED !!!</h3>
							<?php } ?>

							<?php if($verify_status=="success")
							{ 
								$_SESSION["user_id"] =$results[0]['id'];
								$_SESSION["username"] =$results[0]['cust_name'];
								$_SESSION["user_email"] = $results[0]['cust_email'];
								$_SESSION["pic_path"] =$results[0]['pic_path'];
								$_SESSION["s"]="Logged In Successfully !!!";
							?>
								<p style="text-align:center; font-size: 15px; color:#00802b;">
									Thank You <?=$results[0]['cust_name'];?>,<br>
									Email Verified Successfully.
								</p>
								<p style="text-align:center;">
									<a href="<?=$redirect; ?>" class="btn btn-success btn-labeled">LOGIN</a>
								</p>
							<?php }else{ ?>
								<p style="text-align:center; font-size: 15px; color:#cc0000;" id="msg1">
									Email Verification Failed.
								</p>
								<form id="resend_verification_form">
									<div class="form-group text-center">
										<input type="hidden" name="email" id="email" value="<?=$email;?>">
										<p id="verified" style="text-align:center; font-size: 15px; color:#00802b;"></p>
										<button name="submit" id="resend" class="btn btn-primary" data-spinner-color="#333" data-style="slide-left"><b><i class="icon-loop3"></i></b><span class="ladda-label">RESEND VERIFICATION</span></button>
									</div>
								</form>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include 'footer.php'; ?>
<!-- <script type="text/javascript">
	$(document).ready(function() {

		$("#resend").click(function(e){
    		e.preventDefault();
    		var email=$("#email").val();

				$.ajax({
					type: 'POST',
					url: '<?=ROOT_URL;?>models/resend_verification.php',
					data: {'email':email},
					dataType:'json',
					success: function (data) 
					{
						if(data.status==true)
						{
							$("#resend").hide();
							$("p#msg1").hide();
							$("#msg").html("RE-VERIFICATION MAIL SENT !!!");
            				$("p#verified").html("Email sent for Re-verification. Check your registered email id !!!");
            			}
					}
				});

				setTimeout(function () {
   					window.location.href= 'index.php';
				}, 9000);
				return false;
  		});

	});
</script> -->