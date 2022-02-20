<?php $page_name="Home"; ?>
<?php
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

$sql="SELECT content FROM cms WHERE id='4';";
$query_db = $conn->query($sql);
$results=$query_db->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include 'header.php'; ?>

<main id="main" class="site-content">
<section class="section-full">
    <div class="mag-content-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <h4 class="mag-widget-title-1">Privacy Policy</h4><hr>
                <?php if(!empty($results)){ foreach($results as $result){ ?>
                    <p ><?=$result['content']; ?></p>
                <?php }} ?>
				</div>
        	</div> <!-- end .container -->
    	</div>
    </div>
</section> <!-- end .section-full -->
</main> <!--  .site-content  -->
<?php include 'footer.php'; ?>