<?php 
$page_name="News";

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';
include 'pagination/paginate.php';
include 'string-shortner/short_string.php';

extract($_GET);

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
$limit = 9; // records per page
$startpoint = ($page * $limit) - $limit;
$table="news";

if(isset($_GET['cat_id']))
{
	$n_cat=$_GET['cat_id'];
	$catid="n_cat_id";
}

$sqlo="SELECT * FROM organization;";
$qo = $conn->query($sqlo);
$orgData=$qo->fetchAll(PDO::FETCH_ASSOC);

if(empty($n_cat))
{
	$sql="SELECT * FROM $table WHERE publish='1' ORDER BY n_date DESC,id DESC LIMIT $startpoint,$limit;";
}
else
{
    if($n_cat==1){$cat_name="CAR ";}else{$cat_name="BIKE ";}
	$sql="SELECT * FROM $table WHERE n_cat_id=$n_cat AND publish='1' ORDER BY n_date DESC,id DESC LIMIT $startpoint,$limit;";
}

$q= $conn->query($sql);
$news=$q->fetchAll(PDO::FETCH_ASSOC);

$sqlp="SELECT * FROM reviews WHERE publish='1' ORDER BY p_date DESC,id DESC LIMIT 3;";
$qp= $conn->query($sqlp);
$posts=$qp->fetchAll(PDO::FETCH_ASSOC);

$sqlb="SELECT * FROM features WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
$qb = $conn->query($sqlb);
$blog=$qb->fetchAll(PDO::FETCH_ASSOC);

$sqlb="SELECT * FROM articles WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
$qb=$conn->query($sqlb);
$new_blogs=$qb->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
	<section class="section-full">	
		<div class="mag-content-body">
			<div class="container">
				<div class="row">
	                <div class="col-xs-12 col-md-8">
						<h4 class="mag-widget-title-1"><?=$cat_name;?>News</h4><hr>
						<?php if(!empty($news)){ for($i=0; $i<count($news); $i++){ ?>
						<div class="row mb-20">
						    <?php if(!empty($news[$i]['id'])){ ?> 	
						        <div class="col-xs-12 col-md-7 bottom-margin">
						            <article class="hentry-card">
						                <div class="div-card">
						                    <figure class="media">
						                        <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                    </figure>
						                    <div class="overlap-top-23 relative">
						                        <header class="hentry-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						                            <h3><a href="<?=ROOT_URL_FRONT."news/".$news[$i]['url_id'].".html"; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                        </header>
						                        <div class="hendtry-content">
						                                <p ><?=string_short($news[$i]['n_content'], 0,210); ?></p>
						                        </div>
						                        <div class="hentry-meta">
						                            <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                            </p>
						                            <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                <?php if(!empty($news[$i]['n_author'])){ ?>
						                                    <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                <?php } ?>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						            </article>
						            <?php $i=$i+1; ?>
						        </div> <!-- /.col-xs-12 -->
						    <?php } ?>
						        <div class="col-lg-5 col-md-12 hidden-xs hidden-sm bottom-margin">
						            <ul class="widget-post-list-2">
						            <?php if(!empty($news[$i]['id'])){ ?>	
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="<?=ROOT_URL_FRONT."news/".$news[$i]['url_id'].".html"; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="<?=ROOT_URL_FRONT."news/".$news[$i]['url_id'].".html"; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						        <?php  $i=$i-1; ?>
						        <div class="col-xs-12 col-sm-12 hidden-lg hidden-md bottom-margin">
						            <ul class="widget-post-list-2">
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="<?=ROOT_URL_FRONT."news/".$news[$i]['url_id'].".html"; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p class="pb-15"><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="<?=ROOT_URL_FRONT."news/".$news[$i]['url_id'].".html"; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p class="pb-15"><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						    <?php  $i=$i+1; ?>
						</div>
						<div class="row mb-20">	
						        <div class="col-lg-5 col-md-12 hidden-xs hidden-sm bottom-margin">
						            <ul class="widget-post-list-2">
						           	<?php if(!empty($news[$i]['id'])){ ?> 	
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						        <?php  $i=$i-1; ?>
						        <div class="col-xs-12 col-sm-12 hidden-lg hidden-md bottom-margin">
						            <ul class="widget-post-list-2">
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						    	<?php  $i=$i+1; ?>
						    	<?php if(!empty($news[$i]['id'])){ ?>
						        <div class="col-xs-12 col-md-7 bottom-margin" style="float:right;">
						            <article class="hentry-card">
						                <div class="div-card">
						                    <figure class="media">
						                        <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                    </figure>
						                    <div class="overlap-top-23 relative">
						                        <header class="hentry-header">
						                            <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                        </header>
						                        <div class="hendtry-content">
						                                <p ><?=string_short($news[$i]['n_content'], 0,210); ?></p>
						                        </div>
						                        <div class="hentry-meta">
						                            <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                            </p>
						                            <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                <?php if(!empty($news[$i]['n_author'])){ ?>
						                                    <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                <?php } ?>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						            </article>
						            <?php $i=$i+1; ?>
						        </div>
						    	<?php } ?>
						</div>
						<div class="row mb-20">	
						    <?php if(!empty($news[$i]['id'])){ ?>
						        <div class="col-xs-12 col-md-7 bottom-margin bottom-margin">
						            <article class="hentry-card">
						                <div class="div-card">
						                    <figure class="media">
						                        <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                    </figure>
						                    <div class="overlap-top-23 relative">
						                        <header class="hentry-header">
						                            <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                        </header>
						                        <div class="hendtry-content">
						                                <p ><?=string_short($news[$i]['n_content'], 0,210); ?></p>
						                        </div>
						                        <div class="hentry-meta">
						                            <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                            </p>
						                            <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                <?php if(!empty($news[$i]['n_author'])){ ?>
						                                    <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                <?php } ?>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						            </article>
						            <?php $i=$i+1; ?>
						        </div> <!-- /.col-xs-12 -->
						    <?php } ?>
						        <div class="col-lg-5 col-md-12 hidden-xs hidden-sm bottom-margin">
						            <ul class="widget-post-list-2">
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>"><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						        <?php  $i=$i-1; ?>
						        <div class="col-xs-12 col-sm-12 hidden-lg hidden-md bottom-margin">
						            <ul class="widget-post-list-2">
						           	<?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						                <?php  $i=$i+1; ?>
						            <?php if(!empty($news[$i]['id'])){ ?>
						                <li class="flex">
						                    <article class="hentry-card">
						                        <figure class="media">
						                            <img src="<?=ROOT_URL.$news[$i]['cover_photo']; ?>" alt="" class="img-responsive">
						                        </figure>
						                        <div class="overlap-sidebar relative">
						                            <header class="hentry-header">
						                                <h3><a href="view_news.php?n_id=<?=$news[$i]['url_id']; ?>" ><?=$news[$i]['n_name']; ?></a></h3>
						                            </header>
						                            <div class="hendtry-content">
						                                    <p ><?=string_short($news[$i]['n_content'], 0,220); ?></p>
						                            </div>
						                            <div class="hentry-meta">
						                                <p>Date : <?=date("M d, Y",strtotime($news[$i]['n_date'])); ?>
						                                </p>
						                                <?php if($orgData[0]['post_by']=="1"){ ?> 
						                                    <?php if(!empty($news[$i]['n_author'])){ ?>
						                                       <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
						                                    <?php } ?>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </article>
						                </li>
						            <?php } ?>
						            </ul>
						        </div>
						</div>
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
	                </div> <!-- /.col-lg-8 -->
	                <?php include 'sidebar.php'; ?>
	            </div><!-- /row -->
	        </div><!-- /container -->
	    </div><!-- /mag-content-body -->
	</section>
</main>
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