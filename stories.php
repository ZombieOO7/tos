<?php 
$page_name="Stories"; 

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

$sql="SELECT * FROM stories WHERE publish='1' ORDER BY id DESC;";
$query_db = $conn->query($sql);
$stories=$query_db->fetchAll(PDO::FETCH_ASSOC);

$sqln="SELECT * FROM news WHERE publish='1' ORDER BY n_date DESC,id DESC LIMIT 3;";
$qn = $conn->query($sqln);
$news=$qn->fetchAll(PDO::FETCH_ASSOC);

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
<style type="text/css">
.img-hover-zoom {
    height: auto;
    overflow: hidden;
    position: relative;
    display: inline-block;
    border: 1px solid #ccc;
}

.img-hover-zoom img {
    transition: transform .5s ease;
    width: 250px;
    height: 250px;
    object-fit: cover;
}

.img-hover-zoom:hover img {
    transform: scale(1.1);

}

.img-hover-zoom .text {
    position: absolute;
    padding-top: 15px;
    padding-bottom: 15px;
    font-size:22px;
    font-weight:bold;
    left: 0px;
    bottom: 0px;
    margin: 0px auto;
    text-align: center;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    width: 100%;

}
</style>

<main id="main" class="site-content">
	<section class="section-full">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<h4 class="mag-widget-title-1">Stories</h4>
					<hr>
                    <?php if(!empty($stories)){ foreach($stories as $story){ ?>
                    <div class="timeline-container relative features">
                    	<article class="hentry-card mb-40">
                    		<div class="div-card">
                    			<figure class="hentry-media">
                    				<img src="<?=ROOT_URL.$story['cover_img']; ?>" class="img-responsive" alt="">
                    			</figure>
                    			<div class="overlap-top-20 relative" style="padding-bottom:0;">
                    				<header class="hentry-header">
                    					<h3><a href="story/<?=$story['url'];?>.html"><?=$story['name']; ?></a></h3>
                    				</header>
                    			</div>
                    		</div>
                    	</article> <!-- end .hentry-timeline -->
                    </div> <!-- end .timeline-container -->
                    <?php }} ?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>

<script type="text/javascript">
  	var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
  });
  $grid.imagesLoaded().progress( function() {
    $grid.masonry();
  });  
</script>