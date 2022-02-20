<?php
$page_name="About Us";

session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

$sql="SELECT content FROM cms WHERE id='2';";
$query_db = $conn->query($sql);
$results=$query_db->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
<!-- section-full -->
<!--<section class="section-full">
    <div class="mag-content-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="section-title style3 text-center">
                        <h1 class="shade-text">Turn of Speed</h1>
                    </div><hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
</section>-->

<section class="section-full">
    <div class="container">
        <div class="section-title no-margin style3 text-center">
            <h1 class="text-uppercase">Turn of Speed</h1><hr>
            <?php if(!empty($results)){ foreach($results as $result){ ?>
                <p ><?=$result['content']; ?></p>
            <?php }} ?>
        </div>
    </div> <!-- container -->
</section>
</main> <!--  .site-content  -->
<?php include 'footer.php';?>