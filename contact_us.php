<?php 
$page_name="Contact Us";

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

$sql="SELECT content FROM cms WHERE id='1';";
$query_db = $conn->query($sql);
$results=$query_db->fetchAll(PDO::FETCH_ASSOC);
$result=json_decode($results[0]['content'],true);
?>
<?php include'header.php'; ?>
<main id="main" class="site-content">
<!-- <?php include 'page_header.php'; ?> -->
<!-- /.page-header -->
<section>
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15072.43205530489!2d72.96089982071211!3d19.19048405775934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b91f58af4a53%3A0xdf140e44dad3b6fd!2sThane%20West%2C%20Thane%2C%20Maharashtra%20400602!5e0!3m2!1sen!2sin!4v1573634810018!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
</section>
    <section class="section-full">
    	<div class="container">
    		<div class="row">
                <div class="col-xs-12 col-md-12">
                 <div class="col-xs-12 col-md-4">   
                    <div class="contact-block mb-30 dark" align="center">
                        <article class="hentry-card">
                            <div class="overlap-top-23 relative">
                                <header class="hentry-header">
                                    <h4 class="text-uppercase"><a>Location</a></h4>
                                </header>
                                <div class="hendtry-content">
                                        <p ><?=$result['address']; ?></p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">  
                    <div class="contact-block mb-30 dark" align="center">
                        <article class="hentry-card">
                            <div class="overlap-top-23 relative">
                                <header class="hentry-header">
                                    <h4 class="text-uppercase"><a>Contact</a></h4>
                                </header>
                                <div class="hendtry-content">
                                    <p >
                                        <?=$result['p_phone']; ?> <br><?php if(!empty($result['s_phone'])){ echo "Phone:".$result['s_phone']; } ?>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">  
                    <div class="contact-block dark" align="center">
                        <article class="hentry-card">
                            <div class="overlap-top-23 relative">
                                <header class="hentry-header">
                                    <h4 class="text-uppercase"><a>Email</a></h4>
                                </header>
                                <div class="hendtry-content">
                                    <p >
                                        <?=$result['p_email']; ?><br><?php if(!empty($result['s_email'])){ ?><?=$result['s_email']; ?><?php } ?>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                </div> <!-- /.col- -->
    			<div class="col-xs-12 col-md-12">
    				<form id="contact-form" class="row contact-form card hover-shadow pt-20">
    					<div class="col-xs-12">
    						<div class="input-field">
    							<input id="name" type="text" name="i_name" class="ml-input">
    							<label for="name">Name</label>
    						</div>
    					</div>
    					<div class="col-xs-12">
    						<div class="input-field">
    							<input id="phoneNumber" type="text" name="i_phone" class="ml-input">
    							<label for="phoneNumber">Phone Number</label>
    						</div>
    					</div>
    					<div class="col-xs-12">
    						<div class="input-field">
    							<input id="email" type="email" name="i_email" class="ml-input">
    							<label for="email">Email</label>
    						</div>
    					</div>
    					<div class="col-xs-12">
    						<div class="input-field">
    							<input id="subject" type="text" name="i_subject" class="ml-input">
    							<label for="subject">Subject</label>
    						</div>
    					</div>
    					<div class="col-xs-12">
    						<div class="input-field">
    							<textarea id="message" name="i_description" class="materialize-textarea"></textarea>
    							<label for="message">Message</label>
    						</div>
    					</div>
    					<div class="col-xs-12 text-center">
    						<button class="btn-flat btn-default radius text-uppercase transition" type="submit" name="submit" id="btnSubmit">Submit</button>
    					</div>
    					<div class="col-xs-12">
    						<div class="msg-success">Your message was sent successfully</div>
    						<div class="msg-error">Something went wrong, please try again later.</div>
    					</div>
    				</form> <!-- end .row -->
    			</div> <!-- /.col- -->
    		</div> <!-- /.row -->
    	</div> <!-- /.container -->
    </section>
    <!-- //.section-full -->
</main> <!--  .site-content  -->
<?php include'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#btnSubmit").click(function(e){
		e.preventDefault();
		if ($('#contact-form').valid()) 
		{
			$.ajax({
		        type: "POST",
		        data: $("#contact-form").serialize(),
		        url : "<?=ROOT_URL; ?>models/add_inquiry.php",
		        dataType:"json",
		        success: function(resp) {
		       		if(resp.status==true)
		       		{
			            $(".contact-form").fadeTo( "slow", 1, function() {
			                $(".contact-form .msg-success").slideDown();
			            });
			            $(".contact-form").resetForm();
		        	}
		        	else if(resp.status==false)
		        	{
		        		 $(".contact-form").fadeTo( "slow", 1, function() {
		                $(".contact-form .msg-error").slideDown();
		            	});
		        	}
		        	else{}
		        }
		    });
		}
	});
});
</script>