<?php
session_start();
include 'manage/config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
?>

<?php $page_name="Registration Success"; ?>
<!-- Page container -->
<?php include 'header.php'; ?>
<main id="main" class="site-content">
	<section class="section-full">
		<div class="mag-content-body">
		    <div class="container">
		        <div class="row">
		        	<div class="col-md-6 col-sm-12 col-md-offset-3">
						<div class="hover-shadow" style="padding:10px; border-radius: 5px; background-color: #FFF;">
							<h5 style="text-align:center; color:#00b33c;">
								Thank you for your registration.<br>Email verification link has been sent to your registered email id.
							</h5><br>
							<h6 style="text-align:center; color:#e60000; font-size: 14px;">
								Please Check Your mails SPAM/JUNK folder if mail not found in inbox.<br><br>
								<a href ="index.php" class="btn btn-success">Go Back</a>
							</h6><br>
							<!-- <h6 style="text-align:center; color:#e60000;">
								 Verification link will expire Within 24 hours.
							</h6> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include 'footer.php'; ?>
