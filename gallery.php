<?php 
$page_name="Gallery"; 

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

$sql="SELECT * FROM gallery WHERE status='0' ORDER BY id DESC;";
$query_db = $conn->query($sql);
$gallery=$query_db->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'header.php'; ?>
<style type="text/css">
/* ---- grid ---- */
.grid {
  position: relative;
  background: #FFF;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .grid-item ---- */

.grid-sizer,
.grid-item {
  width: 33.333%;
}

.grid-item {
  float: left;
}

.grid-item img {
  display: block;
  max-width: 100%;
}
</style>

<main id="main" class="site-content">
<section class="section-full">	
	<div class="mag-content-body">
		<div class="container">
			<div class="row">
          <div class="col-xs-12 col-md-12">
              <div class="row mag-row">
                   	<h3 class="mag-widget-title-1">GALLERY</h3><hr>
            	</div>
        	</div>
      </div> <!-- end .row -->
    </div>
  </div>
  <div class="container-fluid" style="padding-left:0px; padding-right:0px;">
  		<div class="grid">
  			<div class="grid-sizer"></div>
  			<?php if(!empty($gallery)){ foreach($gallery as $gal){ ?>
  				<div class="grid-item">
  					<img src="<?=ROOT_URL.$gal['img_path']; ?>" />
  				</div>
  			<?php }} ?>
  		</div>
	</div> <!-- //#service -->
</section>
</main>
<?php include 'footer.php'; ?>

<script type="text/javascript">
  	var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
  });
// layout Masonry after each image loads

  $grid.imagesLoaded().progress( function() {
    $grid.masonry();
  });  
</script>