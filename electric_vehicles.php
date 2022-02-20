<?php 
$page_name="Electric Vehicle"; 

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
$table="evs";

$sqlo="SELECT * FROM organization;";
$qo = $conn->query($sqlo);
$orgData=$qo->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['cat_id']))
{
    $n_cat=$_GET['cat_id'];
    $catid="e_cat_id";
}

if(empty($n_cat))
{
    $sqle="SELECT * FROM $table WHERE publish='1' ORDER BY e_date DESC,id DESC LIMIT $startpoint,$limit;";
}
else
{
    $sqle="SELECT * FROM $table WHERE e_cat_id=$n_cat AND publish='1' ORDER BY e_date DESC,id DESC LIMIT $startpoint,$limit;";
}

$query_db = $conn->query($sqle);
$evs=$query_db->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
	<section class="section-full">
        <div class="mag-content-body">
            <div class="container">
                <div class="row">
                     <h4 class="mag-widget-title-1">Electric Vehicles</h4><hr>
                    <?php if(!empty($evs)){ foreach ($evs as $ev) {?> 
                    	<article class="hentry-horiz flex flex-middle disable-flex-xs mb-50" style="box-shadow: 0 0 15px #777">
                            <div class="col-xs-12 col-md-6" style="padding-left: 0;">
                    			<figure class="media">
                                    <img src="<?=ROOT_URL.$ev['cover_photo']; ?>" class="img-responsive">
                                </figure>
                            </div>
                            <div class="col-xs-12 col-md-6 mt-0  mb-25">
                                <header class="hentry-header mb-20"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                    <h3><a href="<?=ROOT_URL_FRONT."evs/".$ev['url_id'].".html"; ?>" class="title-link"><?=$ev['e_name']; ?></a></h3>
                                    <span class="sep block mt-10 mb-10"></span>
                                    <h6><i><?=$ev['e_subhead']; ?></i></h6>
                                </header>
                                <div >
                                    <p style="font-size: 15px;"><?=string_short($ev['e_content'], 0,200); ?></p>
                                    <!-- <p>Date : <?=date("j<\s\u\p>S</\s\u\p> F, Y",strtotime($ev['e_date'])); ?></p> -->
                                    <p>Date : <?=date("M d, Y",strtotime($ev['e_date'])); ?></p>
                                    <?php if($orgData[0]['post_by']=="1"){ ?> 
                                        <?php if(!empty($ev['e_author'])){ ?>
                                            <p><i class="f700">By</i> : <span class="by-line"> <?=$ev['e_author'];?></span></p>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </article>
                    <?php }} ?>
                </div>
                
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
            </div>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>