<?php
$page_name="Home";
session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';
include 'string-shortner/short_string.php';
?>
<?php include 'header.php'; ?>
<main id="main" class="site-content">
<?php
    $sliders="SELECT * FROM ((SELECT featured_photo,featured_title,name_color,name_align,p_name as head_name,url_id,created_at, 'review' as type FROM reviews WHERE featured='1' AND publish='1' ORDER BY p_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,e_name as head_name,url_id,created_at, 'evs' as type FROM evs WHERE featured='1' AND publish='1' ORDER BY e_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id,created_at, 'feature' as type FROM features WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id,created_at, 'article' as type FROM articles WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id,created_at, 'column' as type FROM columns WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)) t1 ORDER BY created_at DESC";
    $sliders = $conn->query($sliders);
    $sliders=$sliders->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlo="SELECT * FROM organization;";
    $qo = $conn->query($sqlo);
    $orgData=$qo->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- slider start -->
<section class="mb-60" width="100%">
<!-- masterslider -->
  <div class="master-slider ms-skin-default masterslider">
    <?php if($orgData[0]['slider_logo']=="1"){ ?>  
    <div class="ms-slide slide-1" data-delay="4"> 
        <!--<img src="js/masterslider/blank.gif" data-src="<?=ROOT_URL_FRONT."images/logo1.png"; ?>" class="img-responsive"/>-->
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 817.8 344.3" style="enable-background:new 0 0 817.8 344.3;" xml:space="preserve"><style type="text/css">.st0{fill:#B62125;}.st1{fill:#FFFFFF;}.st2{fill:none;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;}.st3{fill:#FFFFFF;stroke:#FFFFFF;stroke-width:2;stroke-miterlimit:10;}</style><title>logo1</title><rect width="817.8" height="344.3"/><g><path class="st0" d="M531.2,195.6v5.7H436l-52.5-52.5h48.4c4,0,7.3-3.3,7.3-7.3c0-4-3.3-7.3-7.3-7.3h-61.6v6.9l-4.3-3v-8.3h65.9 c6.4-0.2,11.7,4.9,11.9,11.3s-4.9,11.7-11.3,11.9c-0.2,0-0.4,0-0.6,0H394l43.8,43.8h89v-5.4L531.2,195.6z M344.1,123.1V108h87.8 c18.5,0,33.5,15,33.5,33.5c0,13.7-8.3,26-21,31.1l2.4,2.4h58v-3.9l4.3,4v4.2h-64.2l-8.3-8.3l6.1-2.5c14.9-6,22.2-23,16.2-38 c-4.4-11-15.1-18.3-27-18.3h-83.5v13.7L344.1,123.1z"/><polygon class="st1" points="504.9,175 504.9,108 542,108 598.2,164.1 598.2,108 624.5,108 624.5,201.3 598.2,201.3 531.2,134.2 531.2,201.3 526.8,196.9 526.8,123.8 600,196.9 620.1,196.9 620.1,112.3 602.6,112.3 602.6,174.6 540.2,112.3 509.3,112.3 509.3,179.4 509.3,179.4 	"/><path class="st1" d="M204.2,108h99.2v46.6c0,11.3,9.1,20.4,20.4,20.4c11.3,0,20.4-9.1,20.4-20.4V108l4.3,4.3v42.3 c0,13.7-11.1,24.7-24.7,24.7S299,168.3,299,154.6v-42.3H175v17.6h33.5v67h17.6v-67h55.3v24.7c-0.3,23.4,18.4,42.6,41.7,42.9 s42.6-18.4,42.9-41.7c0-0.4,0-0.8,0-1.1v-24.7l4.3,4.3v20.4c0,25.8-20.9,46.6-46.7,46.6c-25.8,0-46.6-20.9-46.6-46.6v-20.4h-46.6 v67h-26.3v-67h-33.6V108H204.2z"/><path class="st0" d="M359.4,133.6v-10.3h72.5c10.1-0.2,18.4,7.8,18.6,17.8c0.2,10.1-7.8,18.4-17.8,18.6c-0.2,0-0.5,0-0.7,0h-22 l30.6,30.6h79.7v-5l-4.3-4v4.6h-73.5l-15.8-15.8l-1.5-1.5l-4.6-4.6H432c4.8,0,9.5-1.5,13.3-4.5c10-7.4,12.1-21.5,4.7-31.5 c-4.3-5.7-11-9.1-18.1-9.1h-76.9v11.7L359.4,133.6z"/><polygon class="st1" points="520.2,190.3 520.2,120.4 532.8,120.4 602.7,190.3 603.3,190.3 603.3,190.3 612.2,190.3 613.5,190.3 613.5,118.9 609.2,118.9 609.2,186 604.5,186 536.9,118.4 536.9,118.4 535.7,117.2 534.6,116 515.9,116 515.9,118.9 515.9,120.4 515.9,186 	"/><path class="st1" d="M181.6,118.9v4.4h33.5v67h4.3v-67H288v31.4c0,19.7,16,35.7,35.7,35.7c19.7,0,35.7-16,35.7-35.7v-31.4l-4.3-4.3 v35.7C355,172,341,186,323.7,186c-17.3,0-31.3-14-31.3-31.3v-35.7H181.6z"/><path class="st1" d="M430.3,243.1c1.4,0,2.7-0.1,4.1-0.2c0.9-0.1,1.9-0.3,2.7-0.8c0.7-0.4,1.2-0.9,1.5-1.6c0.6-1.7,0.6-3.6,0-5.4 c-0.3-0.7-0.8-1.2-1.5-1.6c-0.8-0.4-1.8-0.7-2.7-0.8c-2.7-0.3-5.4-0.3-8.1,0c-0.9,0.1-1.9,0.3-2.7,0.8c-0.7,0.4-1.2,0.9-1.5,1.6 c-0.6,1.7-0.6,3.6,0,5.4c0.3,0.7,0.8,1.3,1.5,1.6c0.8,0.4,1.8,0.7,2.7,0.8C427.6,243.1,428.9,243.1,430.3,243.1 M430.3,227.2 c5,0,8.8,0.9,11.3,2.6c2.5,1.7,3.8,4.4,3.8,8.1c0,3.7-1.3,6.4-3.8,8.1c-2.5,1.7-6.3,2.6-11.3,2.6c-5.1,0-8.8-0.9-11.3-2.6 c-2.5-1.7-3.8-4.4-3.8-8.1c0-3.7,1.3-6.4,3.8-8.1C421.5,228,425.2,227.2,430.3,227.2L430.3,227.2z"/><polygon class="st1" points="471.7,227.5 467.6,232.9 455,232.9 455,235.6 470.6,235.6 466.7,240.6 455,240.6 455,248.1 448.6,248.1 448.6,227.5 	"/><path class="st1" d="M504.8,235.8c2.5,0,4.5,0.5,5.8,1.4c1.3,1,2.1,2.6,2,4.2c0,1-0.2,1.9-0.5,2.8c-0.3,0.8-0.8,1.6-1.5,2.1 c-0.8,0.6-1.8,1.1-2.8,1.3c-1.3,0.3-2.7,0.5-4,0.5h-19.3l4.1-5.3h15.6c0.6,0,1.2-0.1,1.7-0.4c0.4-0.3,0.6-0.7,0.5-1.2 c0-0.4-0.2-0.9-0.5-1.1c-0.5-0.3-1.1-0.4-1.7-0.3H493c-1.2,0-2.3-0.1-3.5-0.4c-0.9-0.2-1.7-0.6-2.4-1.2c-0.6-0.5-1.1-1.1-1.4-1.9 c-0.3-0.8-0.5-1.6-0.5-2.4c0-0.9,0.2-1.8,0.5-2.6c0.3-0.8,0.9-1.5,1.5-2c0.8-0.6,1.8-1,2.7-1.3c1.3-0.3,2.7-0.5,4-0.5H512l-4.1,5.4 h-14.3c-0.6,0-1.1,0.1-1.6,0.3c-0.4,0.2-0.6,0.7-0.5,1.1c0,0.4,0.2,0.9,0.5,1.1c0.5,0.2,1.1,0.4,1.6,0.3L504.8,235.8z"/><path class="st1" d="M542.7,235.3c0,1.1-0.2,2.2-0.7,3.1c-0.5,0.9-1.1,1.8-2,2.4c-1,0.7-2,1.2-3.2,1.5c-1.4,0.4-2.8,0.6-4.3,0.6 h-10.8v5.3h-6.4v-10.6h17.8c0.8,0.1,1.6-0.2,2.3-0.6c0.5-0.4,0.8-1.1,0.8-1.7c0-0.7-0.3-1.3-0.8-1.7c-0.7-0.5-1.5-0.7-2.3-0.6 h-17.8l4.2-5.4h13c1.5,0,2.9,0.2,4.3,0.6c1.1,0.3,2.2,0.9,3.2,1.6c0.8,0.6,1.5,1.5,2,2.4C542.4,233.1,542.7,234.1,542.7,235.3"/><polygon class="st1" points="569.9,242.8 565.8,248.1 545.9,248.1 545.9,227.5 569.8,227.5 565.7,232.9 552.3,232.9 552.3,235.3 568.7,235.3 565,240 552.3,240 552.3,242.8 	"/><polygon class="st1" points="596,242.8 591.9,248.1 572,248.1 572,227.5 596,227.5 591.8,232.9 578.5,232.9 578.5,235.3 594.8,235.3 591.1,240 578.5,240 578.5,242.8 	"/><path class="st1" d="M624.5,237.6c0,1.4-0.3,2.9-0.9,4.2c-0.6,1.3-1.5,2.4-2.6,3.3c-1.2,1-2.5,1.7-3.9,2.2c-1.6,0.5-3.3,0.8-5,0.8 h-13.8v-12.9h6.4v7.6h7.4c0.8,0,1.7-0.1,2.4-0.4c0.7-0.2,1.4-0.5,1.9-1c0.5-0.4,1-0.9,1.3-1.5c0.6-1.3,0.6-2.8,0-4 c-0.3-0.6-0.8-1.2-1.3-1.6c-0.6-0.5-1.2-0.8-1.9-1c-0.8-0.3-1.6-0.4-2.4-0.4h-13.8l4.1-5.4h9.7c1.7,0,3.4,0.3,5,0.8 c1.4,0.4,2.8,1.1,3.9,2.1c1.1,0.9,2,2,2.6,3.2C624.2,234.8,624.5,236.2,624.5,237.6"/><path class="st1" d="M344.1,97h87.8c24.5,0.1,44.4,19.9,44.5,44.5c0,7.9-2.1,15.7-6.2,22.6h28.1v4.3h-36.6 c14.9-16.4,13.6-41.8-2.8-56.7c-7.4-6.7-17-10.4-26.9-10.4h-87.8V97z"/><polygon class="st1" points="385.1,159.7 433.3,207.9 531.2,207.9 531.2,212.2 437.6,212.2 432.1,212.2 431.5,212.2 378.9,159.7 "/><polygon class="st1" points="353.6,227.7 398.6,227.7 385.4,247.9 340.4,247.9 	"/><polygon class="st0" points="294.9,227.7 346.2,227.7 333,247.9 281.7,247.9 	"/><polygon class="st1" points="236.2,227.7 287.5,227.7 274.3,247.9 223,247.9 	"/><polygon class="st0" points="170.6,247.9 170.6,247.9 183.8,227.7 228.8,227.7 215.6,247.9 	"/><circle class="st2" cx="638.6" cy="104.4" r="8.6"/><path class="st3" d="M635.8,100.4c0.3-0.1,0.7-0.1,1.1-0.1c0.4,0,0.8,0,1.2,0c0.6,0,1.2,0,1.8,0.2c0.4,0.1,0.8,0.2,1.2,0.5 c0.2,0.2,0.4,0.4,0.6,0.6c0.1,0.2,0.2,0.5,0.2,0.8c0,0.5-0.2,1-0.6,1.3c-0.5,0.4-1,0.6-1.5,0.7l0,0c0.4,0.1,0.8,0.3,1.1,0.6 c0.3,0.3,0.5,0.7,0.6,1.1c0.2,0.6,0.3,1.1,0.5,1.4c0.1,0.2,0.2,0.5,0.4,0.7h-0.8c-0.1-0.2-0.2-0.4-0.3-0.7 c-0.1-0.3-0.2-0.7-0.4-1.2c-0.1-0.5-0.4-0.9-0.8-1.2c-0.5-0.3-1.1-0.4-1.7-0.4h-1.7v3.5h-0.8L635.8,100.4z M636.5,104h1.7 c0.7,0,1.4-0.1,2-0.5c0.5-0.2,0.8-0.7,0.8-1.2c0-0.3-0.1-0.5-0.2-0.8c-0.2-0.2-0.4-0.4-0.6-0.5c-0.3-0.1-0.6-0.2-0.9-0.3 c-0.4-0.1-0.8-0.1-1.2-0.1c-0.4,0-0.7,0-0.9,0l-0.6,0.1L636.5,104z"/></g></svg>
    </div>
    <?php } ?>
    <?php if(!empty($sliders)){ foreach($sliders as $slider){ if(!empty($slider['featured_photo'])){ ?> 
    <div class="ms-slide slide-2" data-delay="4"> 
        <img src="js/masterslider/blank.gif" data-src="<?=ROOT_URL.$slider['featured_photo']; ?>" class="img-responsive"/>
    <?php if($slider['featured_title']=="1"){ ?>
        <h3 class="ms-layer slide-title <?php if($slider['name_color']=="0"){ echo 'text-white'; }else{ echo 'text-black'; } ?>" <?php if($slider['name_align']=="0"){ echo 'style="left:180px; width:600px;"';}else{ echo 'style="right:180px; width:600px; text-align:right;"'; } ?> data-type="text" data-delay="0" data-effect="scale(1,1)"><?=$slider['head_name']; ?></h3>
    <?php } ?>
        <a class="ms-layer sbut6 slide-btn"  <?php if($slider['name_align']=="0"){ echo 'style="left:180px;"';}else{ echo 'style="right:180px;"'; } ?> data-type="text" data-delay="0"
            href="<?=ROOT_URL_FRONT.$slider['type']."/".$slider['url_id'].".html"; ?>">Read More</a>
    </div>
    <?php }}} ?>
  </div>
  <!-- end of masterslider -->
</section>
<!-- slider end -->
<?php
    $sqln="SELECT * FROM news WHERE publish='1' ORDER BY n_date DESC, id DESC LIMIT 3;";
    $qn = $conn->query($sqln);
    $news=$qn->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="mag-content-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="row mag-row">
                        <div class="col-xs-12 col-md-12">
                            <h4 class="mag-widget-title-1">LATEST NEWS</h4><hr>
                        </div>
                        <?php if(!empty($news)){ for($i=0; $i<count($news); $i++){ ?>
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
                            <div class="col-lg-5 col-md-12 hidden-xs hidden-sm">
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

                            <div class="col-xs-12 col-sm-12 hidden-lg hidden-md">
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
                                                               <p><i class="f700">By</i> : <span class="by-line"><?=$news[$i]['n_author'];?></span></p>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </li>
                                    <?php } ?>
                                    </ul>
                            </div><!-- /.col-lg-5 -->
                        <?php }} ?>
                    </div> <!-- /.mag-row -->
                    
                    <div class="row mag-row">
                        <div class="col-xs-12 col-md-12">
                        <h4 class="mag-widget-title-1">LATEST REVIEWS</h4><hr>
                        <div class="isotope-gutter">
                        <?php
                        $sqlp="SELECT * FROM reviews WHERE publish='1' ORDER BY p_date DESC,id DESC LIMIT 4;";
                        $qp = $conn->query($sqlp);
                        $posts=$qp->fetchAll(PDO::FETCH_ASSOC);
                        if(!empty($posts)){ foreach($posts as $post){ $cp_images=[]; $cp_images=json_decode($post['cover_photo'],true); if(count($cp_images)==1){
                        ?> 
                            <div class="col-xs-12 col-sm-6 col-md-6 mb-30">
                                <article class="hentry-card">
                                    <div class="div-card">
                                       <?php foreach ($cp_images as $cp_image) { ?> 
                                            <figure class="media">
                                                <img src="<?=ROOT_URL.$cp_image; ?>" alt="" class="img-responsive">
                                            </figure>
                                        <?php } ?>
                                        <div class="overlap-top-23 relative">
                                            <header class="hentry-header">
                                            <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>" ><?=$post['p_name']; ?></a></h3>
                                            </header>
                                            <div class="hendtry-content">
                                                <p ><?=string_short($post['p_content'], 0,210); ?></p>
                                            </div>
                                            <div class="hentry-meta">
                                               <p>Date : <?=date("M d, Y",strtotime($post['p_date'])); ?></p>
                                                <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                    <?php if(!empty($post['p_author'])){ ?>
                                                        <p><i class="f700">By</i> : <span class="by-line"><?=$post['p_author'];?></span></p>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div> <!-- end .col-xs-12 col-sm-6 col-md-4 -->
                        <?php }else{ ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 mb-30">
                                <article class="hentry-card">
                                    <div class="div-card">
                                        <div class="post-slider ms-skin-default">
                                            <?php foreach ($cp_images as $cp_image) { ?> 
                                            <div class="ms-slide slide-1" data-delay="1"> 
                                                <img src="js/masterslider/blank.gif" data-src="<?=ROOT_URL.$cp_image; ?>" class="img-responsive"/>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="overlap-top-23 relative">
                                            <header class="hentry-header">
                                                <!-- <span class="block title-ls text-uppercase fz-10 mb-5">Cultural News</span> -->
                                                <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>" ><?=$post['p_name']; ?></a></h3>
                                            </header>
                                            <div class="hendtry-content">
                                                <p ><?=string_short($post['p_content'], 0,210); ?></p>
                                            </div>
                                            <div class="hentry-meta">
                                               <p>Date : <?=date("M d, Y",strtotime($post['p_date'])); ?></p>
                                                <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                    <?php if(!empty($post['p_author'])){ ?>
                                                         <p><i class="f700">By</i> : <span class="by-line"><?=$post['p_author'];?></span></p>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div> <!-- end .col-xs-12 col-sm-6 col-md-4 -->
                        <?php }}} ?>
                        </div> <!-- end isotope-gutter -->
                    </div> <!-- end .col-xs-12 col-md-8 -->
                    </div> <!-- /.mag-row -->
                    
                    <div class="row mag-row">
                        <div class="col-xs-12 col-md-12">
                        <h4 class="mag-widget-title-1">LATEST ARTICLES</h4><hr>
                        <div class="isotope-gutter">
                        <?php
                        $articles="SELECT * FROM articles WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 4;";
                        $articles = $conn->query($articles);
                        $articles=$articles->fetchAll(PDO::FETCH_ASSOC);
                        if(!empty($articles)){ foreach($articles as $article){
                        ?> 
                            <div class="col-xs-12 col-sm-6 col-md-6 mb-30">
                                <article class="hentry-card">
                                    <div class="div-card">
                                        <figure class="media">
                                            <img src="<?=ROOT_URL.$article['cover_photo']; ?>" alt="" class="img-responsive">
                                        </figure>
                                        <div class="overlap-top-23 relative">
                                            <header class="hentry-header">
                                               <!--  <span class="block title-ls text-uppercase fz-10 mb-5">Cultural News</span> -->
                                            <h3><a href="<?=ROOT_URL_FRONT."article/".$article['url_id'].".html"; ?>" ><?=$article['b_name']; ?></a></h3>
                                            </header>
                                            <div class="hendtry-content">
                                                <p ><?=string_short($article['b_content'], 0,210); ?></p>
                                            </div>
                                            <div class="hentry-meta">
                                               <p>Date : <?=date("M d, Y",strtotime($article['b_date'])); ?></p>
                                                <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                    <?php if(!empty($article['b_author'])){ ?>
                                                        <p><i class="f700">By</i> : <span class="by-line"><?=$article['b_author'];?></span></p>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div> <!-- end .col-xs-12 col-sm-6 col-md-4 -->
                        <?php }} ?>
                        </div> <!-- end isotope-gutter -->
                    </div> <!-- end .col-xs-12 col-md-8 -->
                    </div> <!-- /.mag-row -->

                    <div class="row mag-row">
                    <?php
                        $sqle="SELECT * FROM evs WHERE publish='1' ORDER BY e_date DESC,id DESC LIMIT 2;";
                        $query_db = $conn->query($sqle);
                        $evs=$query_db->fetchAll(PDO::FETCH_ASSOC);
                        if(!empty($evs)){
                    ?>
                        <div class="col-xs-12" style="padding-right: 0px;"><!-- style="padding-left: 0px; padding-right: 0px;" -->
                            <h4 class="mag-widget-title-1">LATEST EV<span style="text-transform:lowercase;">s</span></h4><hr>
                            <?php if(!empty($evs)){ foreach ($evs as $ev) {?>
                                <article class="hentry-horiz mb-10 flex flex-middle disable-flex-xs mb-50" style="box-shadow: 0 0 15px #777">
                                    <div class="col-xs-12 col-md-6" style="padding-left: 0px; padding-right: 0px;"><!-- style="padding:0px !important;"  -->
                                        <figure class="media">
                                            <img src="<?=ROOT_URL.$ev['cover_photo']; ?>" class="img-responsive">
                                        </figure>
                                    </div>
                                    <div class="col-xs-12 col-md-6 mt-0">
                                        <header class="hentry-header mb-20">
                                            <h3><a href="<?=ROOT_URL_FRONT."evs/".$ev['url_id'].".html"; ?>" class="title-link"><?=$ev['e_name']; ?></a></h3>
                                            <span class="sep block mt-10 mb-10"></span>
                                            <h6><?=$ev['e_subhead']; ?></h6>
                                        </header>
                                        <p>Date : <?=date("M d, Y",strtotime($ev['e_date'])); ?></p>
                                        <?php if($orgData[0]['post_by']=="1"){ ?> 
                                            <?php if(!empty($ev['e_author'])){ ?>
                                                <p><i class="f700">By</i> : <span class="by-line"> <?=$ev['e_author'];?></span></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </article>
                            <?php }} ?>   
                        </div>
                    <?php } ?>
                    </div> <!-- /.mag-row -->

                   <!--  <div class="row mag-row">
                        <div class="col-xs-12">
                            <div class="magazine-post text-center">
                                <a href="javascript:;"><img src="images/ad-header.png" class="img-responsive" alt=""></a>
                            </div>
                        </div>
                    </div> --> <!-- /.mag-row -->

                    <div class="row mag-row">
                    <?php 
                    $sqlv="SELECT * FROM videos WHERE publish='1' ORDER BY v_date DESC,id DESC LIMIT 2;";
                    $qv = $conn->query($sqlv);
                    $videos=$qv->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($videos)){
                    ?>
                        <div class="col-xs-12 col-md-12">
                            <h4 class="mag-widget-title-1">LATEST VIDEOS</h4><hr>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="row latest-videos">
                            <?php foreach($videos as $video){ ?>
                                <div class="col-md-6 col-xs-12 col-sm-12 mb-30">
                                    <div class="video-card hover-shadow">
                                         <div class="service style16">
                                             <figure class="thumb">
                                               <iframe width="100%" height="300"  src="https://www.youtube.com/embed/<?=$video['v_code']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                            </figure>
                                            <h3 class="mb-10" style="padding: 10px 20px 10px;">
                                                <a href="<?=ROOT_URL_FRONT."video/".$video['url_id'].".html"; ?>"><?=$video['v_title']; ?></a>
                                            </h3>
                                            <p  style="line-height: 20px;"><?=string_short($video['v_description'], 0, 120); ?></p>
                                            <p>Date : <?=date("M d, Y",strtotime($video['v_date'])); ?></p>
                                            <?php if($orgData[0]['post_by']=="1"){ ?> 
                                                <?php if(!empty($video['v_author'])){ ?>
                                                    <p><i class="f700">By</i> : <span class="by-line"> <?=$video['v_author'];?></span></p>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>    
                            </div>
                        </div>
                    <?php } ?>
                    </div> <!-- /.mag-row -->
                </div>
                <!-- /.col-md-8 -->
                <aside class="col-xs-12 col-md-4 widget-area">
                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Latest Features</h4><hr>
                        <div class="widget-inner">
                            <ul class="widget-post-list">
                            <?php
                            $sqlb="SELECT * FROM features WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
                            $qb = $conn->query($sqlb);
                            $blog=$qb->fetchAll(PDO::FETCH_ASSOC);
                            if(!empty($blog)){ foreach($blog as $blg){
                            ?>
                                <li class="flex">
                                    <article class="hentry-card">
                                        <figure class="media" style="height:220px;">
                                            <img src="<?=ROOT_URL.$blg['cover_photo']; ?>" style=" object-fit: contain !important;" class="img-responsive">
                                        </figure>
                                        <div class="overlap-sidebar relative">
                                            <header class="hentry-header">
                                                <h3 style="padding-top:10px"><a href="<?=ROOT_URL_FRONT."feature/".$blg['url_id'].".html"; ?>"><?=$blg['b_name']; ?></a></h3>
                                            </header>
                                        </div>
                                    </article>
                                </li>
                            <?php }} ?>
                            </ul>
                        </div>
                    </section>
                    
                    <?php
                    $columns="SELECT * FROM columns WHERE publish='1' ORDER BY id DESC LIMIT 1;";
                    $columns = $conn->query($columns);
                    $columns=$columns->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($columns)){
                    ?>
                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Latest Columns</h4><hr>
                        <div class="widget-inner">
                            <ul class="widget-post-list">
                            <?php if(!empty($columns)){ foreach($columns as $column){ ?>
                                <li class="flex">
                                    <article class="hentry-card">
                                        <figure class="media" style="height:220px;">
                                            <img src="<?=ROOT_URL.$column['cover_photo']; ?>" style=" object-fit: contain !important;" class="img-responsive">
                                        </figure>
                                        <div class="overlap-sidebar relative">
                                            <header class="hentry-header">
                                                <h3 style="padding-top:10px"><a href="<?=ROOT_URL_FRONT."column/".$column['url_id'].".html"; ?>"><?=$column['b_name']; ?></a></h3>
                                            </header>
                                        </div>
                                    </article>
                                </li>
                            <?php }} ?>
                            </ul>
                        </div>
                    </section>
                    <?php } ?>
                    
                    <style>
                        .blink_me {
                            animation-duration: 1200ms;
                            animation-name: blink;
                            animation-iteration-count: infinite;
                            animation-direction: alternate;
                            -webkit-animation:blink 1200ms infinite; /* Safari and Chrome */
                            background : #000000;
                            padding : 0 5px;
                        }
                        @keyframes blink {
                            from {
                                color:#B71C0C;
                            }
                            to {
                                color:#FFFFFF;
                            }
                        }
                        @-webkit-keyframes blink {
                            from {
                                color:#B71C0C;
                            }
                            to {
                                color:#FFFFFF;
                            }
                        }
                    </style>
                    <?php
                    $user_agent=$_SERVER['HTTP_USER_AGENT'];
                    if(strpos($user_agent, "Mobile")==true)
                    {
                      $device_type=1;
                    }
                    else
                    {
                      $device_type=2;
                    }
                    ?>
                    <?php if($device_type==2){ ?>
                    <?php if(!empty($poll_options)){?>
                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Poll <?php if(date("Y-m-d")<=$two_days){ ?> <span class="blink_me">NEW</span><?php } ?></h4><hr>
                        <div class="widget-inner">
                            <p ><?=$polls[0]['question']; ?></p>
                            <input type="hidden" id="poll_id" value="<?=$polls[0]['id']; ?>">
                            <div class="form-group" id="poll_before">
                            <?php $char='A'; foreach($poll_options as $poll_option){ ?>
                                <div class="custom-chekbox-2 round dark mb-15">
                                    <input type="radio" name="poll_ans" data-id="<?=$poll_option['id']; ?>" id="<?=$poll_option['id']; ?>" value="<?=$poll_option['id']; ?>">
                                    <label for="<?=$poll_option['id']; ?>" class="fw300"><b><?=$char.". ";?></b><?=$poll_option['options']; ?></label>
                                </div>
                            <?php $char++; } ?>
                            </div>
                            <div class="form-group" id="poll_after">
                                <!--<?php foreach($poll_options as $poll_option){ ?>
                                    <?=$poll_option['options']; ?> : <span id="<?='poll_'.$poll_option['id']; ?>"></span><br>
                                <?php } ?>-->
                            </div>
                        </div>
                    </section>
                    <?php } ?>

                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Newsletter</h4><hr>
                        <form class="widget-inner search-form" id="subscriber_form" >
                            <p>Subscribe to our Newsletter!<br> Don’t worry, we’ll only send you the best stuff - no spam.</p>
                            <input type="text" name="s_name" id="s_name"  placeholder="Enter Your Name" required>
                            <input type="email" name="s_email" id="s_email"  placeholder="Enter Your Email Address" required>
                            <button type="submit" name="submit" id="subscribe">Subscribe Now</button>
                        </form>
                        <div class="otp-section">
                            <form action="<?=ROOT_URL; ?>models/verify_otp.php" class="widget-inner search-form" id="otp-form" method="post">
                                <input type="hidden" name="s_id" id="s_id" required>
                                <input type="text" name="s_otp" id="s_otp"  placeholder="Enter Received OTP" required>
                                <button type="submit" name="submit" id="verify" disabled="disabled">Verify</button>
                            </form>
                        </div>
                    </section>
                    <?php } ?>
                    
                    <!--<section class="widget magazine-widget">
                        <div class="widget-inner" align='center'>
                            <small>Advertisement</small><br><a href="https://www.turnofspeed.in/view_evs.php?ev_id=god-is-in-the-detel" target="_blank"><img src="<?=ROOT_URL_FRONT; ?>images/detel-easy.jpg" alt="" class="img-responsive center-block"></a>
                        </div>
                    </section>-->
                    <?php
                    $stories="SELECT * FROM stories WHERE publish='1' ORDER BY id DESC LIMIT 3;";
                    $stories = $conn->query($stories);
                    $stories=$stories->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Latest STORIES</h4><hr>
                        <div class="widget-inner">
                            <ul class="widget-post-list">
                            <?php if(!empty($stories)){ foreach($stories as $story){ ?>
                                <li class="flex">
                                    <article class="hentry-card">
                                        <figure class="media" style="height:220px;">
                                            <img src="<?=ROOT_URL.$story['cover_img']; ?>" style=" object-fit: contain !important;" class="img-responsive">
                                        </figure>
                                        <div class="overlap-sidebar relative">
                                            <header class="hentry-header">
                                                <h3 style="padding-top:10px"><a href="story/<?=$story['url'];?>.html"><?=$story['name']; ?></a></h3>
                                            </header>
                                        </div>
                                    </article>
                                </li>
                            <?php }} ?>
                            </ul>
                        </div>
                    </section>
                    <!-- <section class="widget magazine-widget">
                        <div class="widget-inner">
                            <a href="#"><img src="images/widget-ad.jpg" alt="" class="img-responsive center-block"></a>
                        </div>
                    </section> -->
                    
                    <?php if($device_type==1){ ?>
                    <?php if(!empty($poll_options)){?>
                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Poll <?php if(date("Y-m-d")<=$two_days){ ?> <span class="blink_me">NEW</span><?php } ?></h4><hr>
                        <div class="widget-inner">
                            <p ><?=$polls[0]['question']; ?></p>
                            <input type="hidden" id="poll_id" value="<?=$polls[0]['id']; ?>">
                            <div class="form-group" id="poll_before">
                            <?php $char='A'; foreach($poll_options as $poll_option){ ?>
                                <div class="custom-chekbox-2 round dark mb-15">
                                    <input type="radio" name="poll_ans" data-id="<?=$poll_option['id']; ?>" id="<?=$poll_option['id']; ?>" value="<?=$poll_option['id']; ?>">
                                    <label for="<?=$poll_option['id']; ?>" class="fw300"><b><?=$char.". ";?></b><?=$poll_option['options']; ?></label>
                                </div>
                            <?php $char++; } ?>
                            </div>
                            <div class="form-group" id="poll_after">
                                <!--<?php foreach($poll_options as $poll_option){ ?>
                                    <?=$poll_option['options']; ?> : <span id="<?='poll_'.$poll_option['id']; ?>"></span><br>
                                <?php } ?>-->
                            </div>
                        </div>
                    </section>
                    <?php } ?>

                    <section class="widget magazine-widget">
                        <h4 class="mag-widget-title-2">Newsletter</h4><hr>
                        <form class="widget-inner search-form" id="subscriber_form" >
                            <p>Subscribe to our Newsletter!<br> Don’t worry, we’ll only send you the best stuff - no spam.</p>
                            <input type="text" name="s_name" id="s_name"  placeholder="Enter Your Name" required>
                            <input type="email" name="s_email" id="s_email"  placeholder="Enter Your Email Address" required>
                            <button type="submit" name="submit" id="subscribe">Subscribe Now</button>
                        </form>
                        <div class="otp-section">
                            <form action="<?=ROOT_URL; ?>models/verify_otp.php" class="widget-inner search-form" id="otp-form" method="post">
                                <input type="hidden" name="s_id" id="s_id" required>
                                <input type="text" name="s_otp" id="s_otp"  placeholder="Enter Received OTP" required>
                                <button type="submit" name="submit" id="verify" disabled="disabled">Verify</button>
                            </form>
                        </div>
                    </section>
                    <?php } ?>
                </aside>
                <!-- /.col-md-4 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div>
    <!-- /.mag-content-body -->
</main>
<!--  .site-content  -->
<?php include 'footer.php';?>
<script type="text/javascript">

(function($){
    $('.masterslider').masterslider({
    // adds Arrows navigation control to the slider.
         width:1600,  // slider standard width
         height:900,  // slider standard height
         space:0,
         speed:45,
         layout:'fullwidth',
         loop:true,
         preload:0,
         autoplay:true,
         view:"parallaxMask",
         instantStartLayers:true,
         controls : {
            arrows : {autohide:false},
            bullets : {autohide:false}
        }
    });

    $('#s_id').attr("required",false);
    $('#s_otp').attr("required",false);
    $('#s_otp').hide();
    $('.otp-section').hide();
    function disableButton(){$("#subscribe").html("Sending...Please wait").attr("disabled","disabled")}$("#subscribe").click(function(t){t.preventDefault(),1==$("#subscriber_form").valid()&&(disableButton(),$.ajax({type:"POST",url:"<?=ROOT_URL; ?>models/add_subscriber.php",data:$("#subscriber_form").serialize(),dataType:"json",success:function(t){if(1==t.status)$(".otp-section").show(),$("#s_otp").show(),$("#s_id").attr("required",!0),$("#s_otp").attr("required",!0),$("#s_id").val(t.s_id),swal({title:"Success!",text:t.msg,confirmButtonColor:"#66BB6A",type:"success",confirmButton:!0,timer:5e3}),$("#subscribe").html("Done !!!").attr("disabled","disabled");else{if(0!=t.status)return!1;swal({title:"Information!",text:t.msg,confirmButtonColor:"#2196F3",type:"info",confirmButton:!0,timer:5e3}),$("#subscribe").html("Subscribe Now"),$("#subscribe").removeAttr("disabled")}}}))}),$("#s_otp").on("keyup paste",function(t){t.preventDefault();var s=$.trim($("#s_id").val()),e=$.trim($("#s_otp").val());$.ajax({type:"POST",url:"<?=ROOT_URL; ?>models/get_otp.php",data:{id:s,otp:e},dataType:"json",success:function(t){1==t.status?($("#s_otp").css("border","2px solid #0F0"),$("#verify").removeAttr("disabled")):$("#s_otp").css("border","2px solid #F00")}})});

})(jQuery);

</script>