<?php 
$page_name="Features";

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';
include 'pagination/paginate.php';
include 'string-shortner/short_string.php';

$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(strpos($url, '&'))
{
    $url_exp=[];
    $url_exp=explode('&', $url);
    array_pop($url_exp);
    $page_url=implode('&', $url_exp);
}
else
{
    $page_url=$url;
}

$table="";
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 5; // records per page
$startpoint = ($page * $limit) - $limit;
$table="features";


$sqlo="SELECT * FROM organization;";
$qo = $conn->query($sqlo);
$orgData=$qo->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * FROM $table WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT $startpoint,$limit;";
$query_db = $conn->query($sql);
$blog=$query_db->fetchAll(PDO::FETCH_ASSOC);

$sqlp="SELECT * FROM reviews WHERE publish='1' ORDER BY p_date DESC,id DESC LIMIT 3;";
$qp= $conn->query($sqlp);
$posts=$qp->fetchAll(PDO::FETCH_ASSOC);

$sqln="SELECT * FROM news WHERE publish='1' ORDER BY n_date DESC,id DESC LIMIT 3;";
$qn = $conn->query($sqln);
$news=$qn->fetchAll(PDO::FETCH_ASSOC);

$sqlb="SELECT * FROM articles WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
$qb=$conn->query($sqlb);
$new_blogs=$qb->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
	<section class="section-full">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<h4 class="mag-widget-title-1">Features</h4>
					<hr>
					<?php if(!empty($blog)){ foreach($blog as $blg){ ?>
					<div class="timeline-container relative features">
						<article class="hentry-card mb-40">
							<div class="div-card">
								<figure class="hentry-media">
									<img src="<?=ROOT_URL.$blg['cover_photo']; ?>" class="img-responsive" alt="">
								</figure>
								<div class="overlap-top-20 relative">
									<header class="hentry-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
										<h3><a href="<?=ROOT_URL_FRONT."feature/".$blg['url_id'].".html"; ?>"><?=$blg['b_name']; ?></a></h3>
									</header>
									<div class="hendtry-content">
                                        <h6><i><?=$blg['b_subhead']; ?></i></h6><br>
										<p><?=string_short($blg['b_content'], 0, 200); ?></p>
                                        <!-- <p>Date : <?=date("j<\s\u\p>S</\s\u\p> F, Y",strtotime($blg['b_date'])); ?></p> -->
                                        <?php if($orgData[0]['post_by']=="1"){ ?> 
                                            <?php if(!empty($blg['b_author'])){ ?>
                                                <p><i class="f700">By</i> : <span class="by-line"> <?=$blg['b_author'];?></span></p>
                                            <?php } ?>
                                        <?php } ?>
									</div>
								</div>
							</div>
						</article> <!-- end .hentry-timeline -->
					</div> <!-- end .timeline-container -->
					<?php }} ?>
					<?php if(!isset($_GET['cat_id'])){ $page_nav=pagination($conn,$table,$limit,$page); if(!empty($page_nav)){ ?>
				        <div class="col-md-12 col-sm-12">
				            <nav class="mt-50 text-center">
				                <?=$page_nav; ?>
				            </nav>
				        </div>
				    <?php }else{} }else{ $page_nav=news_pagination($conn,$table,$catid,$limit,$page,$page_url,$_GET['cat_id']); if(!empty($page_nav)){ ?>
                            <div class="col-md-12 col-sm-12">
                                <nav class="mt-50 text-center">
                                    <?=$page_nav; ?>
                                </nav>
                            </div>
                        <?php }else{} } ?>
				</div> <!-- end .col-xs-12 col-md-8 -->
				<?php include 'sidebar.php'; ?>
			</div> <!-- end .row -->
		</div> <!-- end .container -->
	</section> <!-- end .section-full -->
</main> <!--  .site-content  -->
<?php include 'footer.php'; ?>
<script type="text/javascript">
(function($) {
   $('#s_id').attr("required",false);
    $('#s_otp').attr("required",false);
    $('#s_otp').hide();
    $('.otp-section').hide();

    $("#subscribe").click(function(e){
        e.preventDefault();

        if ($('#subscriber_form').valid()==true) 
        {
            disableButton();

            $.ajax({
                type:'POST',
                url:'<?=ROOT_URL; ?>models/add_subscriber.php',
                data:$('#subscriber_form').serialize(),
                dataType:'json',
                success: function(resp) {
                    if(resp.status==true)
                    {
                        $('.otp-section').show();
                        $('#s_otp').show();
                        $('#s_id').attr("required",true);
                        $('#s_otp').attr("required",true);
                        $('#s_id').val(resp.s_id);

                        swal({
                            title: "Success!",
                            text: resp.msg,
                            confirmButtonColor: "#66BB6A",
                            type: "success",
                            confirmButton:true,
                            timer:5000
                        });

                        $("#subscribe").html('Done !!!').attr('disabled','disabled');

                    }
                    else if(resp.status==false)
                    {
                         swal({
                            title: "Information!",
                            text: resp.msg,
                            confirmButtonColor: "#2196F3",
                            type: "info",
                            confirmButton:true,
                            timer:5000
                        });

                        $("#subscribe").html('Subscribe Now');
                        $("#subscribe").removeAttr("disabled");
                        
                    }else{ return false;}
                }
            });
        }
    });    

    function disableButton() 
    {
        $("#subscribe").html('Sending...Please wait').attr('disabled','disabled');
    }


    $('#s_otp').on('keyup paste',function(e){

        e.preventDefault();
        var s_id=$.trim($('#s_id').val());
        var checkotp=$.trim($('#s_otp').val());

        $.ajax({
                type:'POST',
                url:'<?=ROOT_URL; ?>models/get_otp.php',
                data:{'id':s_id,'otp':checkotp},
                dataType:'json',
                success: function(resp1) {
                    if(resp1.status==true)
                    {
                        $("#s_otp").css('border', '2px solid #0F0');
                        $("#verify").removeAttr("disabled");
                    }
                    else
                    {
                         $("#s_otp").css('border', '2px solid #F00');
                         return false;
                    }

                }
        });

    });

})(jQuery);
</script>