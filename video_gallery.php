<?php
$page_name="Video Gallery";

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';
include 'pagination/paginate.php';
include 'string-shortner/short_string.php';

$table="";
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 10; // records per page
$startpoint = ($page * $limit) - $limit;
$table="videos";

$sqlo="SELECT * FROM organization;";
$qo = $conn->query($sqlo);
$orgData=$qo->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * FROM $table WHERE publish='1' ORDER BY id DESC LIMIT $startpoint,$limit;";
$query_db = $conn->query($sql);
$videos=$query_db->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
<!-- /.page-header -->
 <section class="section-full">
   	<div class="container">
    	<div class="row">
            <h4 class="mag-widget-title-1">Video Gallery</h4><hr>
        	<?php if(!empty($videos)){ foreach($videos as $video){ ?>
        		<div class="col-md-6 col-xs-12 col-sm-12 mb-30">
                    <div class="video-card hover-shadow">
                         <div class="service style16">
                             <figure class="thumb">
                               <iframe width="100%" height="300"  src="https://www.youtube.com/embed/<?=$video['v_code']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                            </figure>
                            <h3 class="mb-10" style="padding: 10px 20px 10px;">
                                <a href="<?=ROOT_URL_FRONT."video.php/".$video['url_id'].".html"; ?>"><?=$video['v_title']; ?></a>
                            </h3>
                            <p  style="line-height: 20px;"><?=string_short($video['v_description'], 0, 200); ?></p>
                            <p>Date : <?=date("M d, Y",strtotime($video['v_date'])); ?></p>
                            <?php if($orgData[0]['post_by']=="1"){ ?> 
                                <?php if(!empty($video['v_author'])){ ?>
                                    <p><i class="f700">By</i> : <span class="by-line"> <?=$video['v_author'];?></span></p>
                                <?php } ?>
                            <?php } ?>
                            <a href="view_video.php?v_id=<?=$video['url_id']; ?>" class="more">
                                <span class="text">Read More</span>
                                <span class="arrow flex flex-middle flex-center"><i class="material-icons">airport_shuttle</i></span>
                            </a>
                        </div>
                    </div>
        		</div>
        	<?php }} ?>
            <?php $page_nav=pagination($conn,$table,$limit,$page); if(!empty($page_nav)){ ?>
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <nav class="mt-50 text-center">
                        <?=$page_nav; ?>
                    </nav>
                </div>
            <?php }else{} ?>
    	</div>
    </div>
</section>
</main>
<?php include 'footer.php'; ?>
