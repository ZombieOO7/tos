<?php 
$page_name="Reviews"; 

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
$table="reviews";

if(isset($_GET['cat_id']))
{
    $n_cat=$_GET['cat_id'];
    $catid="p_cat_id";
}

$sqlo="SELECT * FROM organization;";
$qo = $conn->query($sqlo);
$orgData=$qo->fetchAll(PDO::FETCH_ASSOC);

if(empty($n_cat))
{
    $sql="SELECT * FROM $table WHERE publish='1' ORDER BY p_date DESC,id DESC LIMIT $startpoint,$limit;";
}
else
{
    if($n_cat==1){$cat_name="CAR ";}else{$cat_name="BIKE ";}
    $sql="SELECT * FROM $table WHERE p_cat_id=$n_cat AND publish='1' ORDER BY p_date DESC,id DESC LIMIT $startpoint,$limit;";
}

$query_db = $conn->query($sql);
$posts=$query_db->fetchAll(PDO::FETCH_ASSOC);

$sqln="SELECT * FROM news WHERE publish='1' ORDER BY n_date DESC,id DESC LIMIT 3;";
$qn = $conn->query($sqln);
$news=$qn->fetchAll(PDO::FETCH_ASSOC);

$sqlb="SELECT * FROM features WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
$qb = $conn->query($sqlb);
$blog=$qb->fetchAll(PDO::FETCH_ASSOC);

$sqlb="SELECT * FROM articles WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
$qb=$conn->query($sqlb);
$new_blogs=$qb->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>

<main id="main" class="site-content">
    <!-- <?php include 'page_header.php'; ?> -->
    <section class="section-full">
        <div class="mag-content-body">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <h4 class="mag-widget-title-1"><?=$cat_name;?>Reviews</h4><hr>
                        <div class="isotope-gutter">
                            <?php if(!empty($posts)){ foreach($posts as $post){ $cp_images=[]; $cp_images=json_decode($post['cover_photo'],true); if(count($cp_images)==1){ ?> 
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-30">
                                    <article class="hentry-card">
                                        <div class="div-card">
                                         <?php foreach ($cp_images as $cp_image) { ?> 
                                            <figure class="media">
                                                <img src="<?=ROOT_URL.$cp_image; ?>" alt="" class="img-responsive">
                                            </figure>
                                        <?php } ?>
                                            <div class="overlap-top-23 relative">
                                                <header class="hentry-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                                 <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>" ><?=$post['p_name']; ?></a></h3>
                                                 </header>
                                                 <div class="hendtry-content">
                                                    <h6><i><?=$post['p_subhead']; ?></i></h6><br>
                                                    <p><?=string_short($post['p_content'], 0,180); ?></p>
                                                </div>
                                                <div class="hentry-meta">
                                                    <!-- <p>Date : <?=date("j<\s\u\p>S</\s\u\p> F, Y",strtotime($post['p_date'])); ?></p> -->
                                                    <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                        <?php if(!empty($post['p_author'])){ ?>
                                                            <p><i class="f700">By</i> : <span class="by-line"> <?=$post['p_author'];?></span></p>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div> <!-- end .col-xs-12 col-sm-6 col-md-4 -->
                            <?php }else{ ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-30">
                                <article class="hentry-card">
                                    <div class="div-card">
                                        <div class="post-slider ms-skin-default">
                                            <?php foreach ($cp_images as $cp_image) { ?> 
                                            <div class="ms-slide slide-1" data-delay="2"> 
                                                <img src="js/masterslider/blank.gif" data-src="<?=ROOT_URL.$cp_image; ?>" class="img-responsive"/>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="overlap-top-23 relative">
                                            <header class="hentry-header">
                                                <!-- <span class="block title-ls  fz-10 mb-5">Cultural News</span> -->
                                                <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>"><?=$post['p_name']; ?></a></h3>
                                            </header>
                                            <div class="hendtry-content">
                                                <p><?=string_short($post['p_content'], 0,180); ?></p>
                                            </div>
                                            <div class="hentry-meta">
                                                <!-- <p>Date : <?=date("j<\s\u\p>S</\s\u\p> F, Y",strtotime($post['p_date'])); ?></p> -->
                                                <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                    <?php if(!empty($post['p_author'])){ ?>
                                                        <p><i class="f700">By</i> : <span class="by-line"> <?=$post['p_author'];?></span></p>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div> <!-- end .col-xs-12 col-sm-6 col-md-4 -->
                            <?php }}} ?>
                        </div> <!-- end isotope-gutter -->
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
                </div>
            </div> <!-- end .container -->
        </div>
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