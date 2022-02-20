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
    $sliders="(SELECT featured_photo,featured_title,name_color,name_align,p_name as head_name,url_id, 'review' as type FROM reviews WHERE featured='1' AND publish='1' ORDER BY p_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,e_name as head_name,url_id, 'evs' as type FROM evs WHERE featured='1' AND publish='1' ORDER BY e_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id, 'feature' as type FROM features WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id, 'article' as type FROM articles WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)
            UNION ALL (SELECT featured_photo,featured_title,name_color,name_align,b_name as head_name,url_id, 'column' as type FROM columns WHERE featured='1' AND publish='1' ORDER BY b_date DESC,id DESC LIMIT 3)";
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
        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 817.75 344.32"><title>logo1</title><rect width="817.75" height="344.32"/><path d="M595.09,320.81v7.44H471.54l-68.17-68.17h62.89a9.43,9.43,0,1,0,0-18.86H386.32v9l-5.63-3.88V235.58h85.56a15.07,15.07,0,1,1,0,30.13H417l56.9,56.9H589.45v-7ZM352.24,226.7V207.13h114A43.5,43.5,0,0,1,482.49,291l3.16,3.16H561v-5l5.63,5.24v5.42H483.32L472.5,289l7.88-3.2a37.87,37.87,0,0,0-14.12-73H357.87v17.82Z" transform="translate(-12.75 -119.06)" style="fill:#b62125;fill-rule:evenodd"/><polygon points="548.25 175.1 548.25 88.07 596.46 88.07 669.37 160.98 669.37 88.07 703.46 88.07 703.46 209.19 669.37 209.19 582.34 122.15 582.34 209.19 576.7 203.56 576.7 108.55 671.71 203.56 697.82 203.56 697.82 93.7 675.01 93.7 675.01 174.59 594.12 93.7 553.89 93.7 553.89 180.74 553.89 180.74 548.25 175.1" style="fill:#fff;fill-rule:evenodd"/><path d="M170.56,207.13H299.29v60.56a26.47,26.47,0,1,0,52.95,0V207.13l5.63,5.63v54.93a32.11,32.11,0,1,1-64.22,0V212.76h-161v22.82h43.52v87H199v-87h71.83v32.11a54.93,54.93,0,1,0,109.85,0V235.58l5.63,5.63v26.47a60.56,60.56,0,0,1-121.12,0V241.21H204.64v87H170.56v-87H127V207.13Z" transform="translate(-12.75 -119.06)" style="fill:#fff;fill-rule:evenodd"/><path d="M372.1,240.38V227h94.16a23.66,23.66,0,1,1,0,47.31H437.71L477.43,314H580.86v-6.43l-5.63-5.24v6H479.77l-20.52-20.52-2-2-5.95-5.94h15.1a28,28,0,0,0,17.27-5.8,29.26,29.26,0,0,0-17.43-52.78H366.46V236.5Z" transform="translate(-12.75 -119.06)" style="fill:#b62125;fill-rule:evenodd"/><polygon points="568.11 194.96 568.11 104.15 584.45 104.15 675.26 194.96 675.95 194.96 675.95 194.96 687.49 194.96 689.23 194.96 689.23 102.3 683.6 102.3 683.6 189.33 677.6 189.33 589.8 101.53 589.8 101.53 588.27 100 586.78 98.52 562.48 98.52 562.48 102.3 562.48 104.15 562.48 189.33 568.11 194.96" style="fill:#fff;fill-rule:evenodd"/><path d="M141.27,221.35V227h43.52v87h5.63V227h89v40.7a46.33,46.33,0,1,0,92.67,0V227l-5.63-5.63v46.33a40.7,40.7,0,0,1-81.4,0V221.35H141.27Z" transform="translate(-12.75 -119.06)" style="fill:#fff;fill-rule:evenodd"/><path d="M464.1,382.56a45.31,45.31,0,0,0,5.29-.26,9.4,9.4,0,0,0,3.5-1,4.49,4.49,0,0,0,1.94-2.1,10.53,10.53,0,0,0,0-7,4.38,4.38,0,0,0-1.94-2.08,9.66,9.66,0,0,0-3.5-1,53.87,53.87,0,0,0-10.57,0,9.67,9.67,0,0,0-3.5,1,4.38,4.38,0,0,0-1.94,2.08,10.52,10.52,0,0,0,0,7,4.48,4.48,0,0,0,1.94,2.1,9.4,9.4,0,0,0,3.5,1,45.33,45.33,0,0,0,5.29.26m0-20.7q9.77,0,14.68,3.32t4.91,10.49q0,7.21-4.89,10.53t-14.7,3.32q-9.85,0-14.72-3.32t-4.87-10.53q0-7.17,4.89-10.49T464.1,361.86Z" transform="translate(-12.75 -119.06)" style="fill:#fff"/><polygon points="505.18 243.24 499.81 250.21 483.47 250.21 483.47 253.69 503.65 253.69 498.61 260.22 483.47 260.22 483.47 270.03 475.14 270.03 475.14 243.24 505.18 243.24" style="fill:#fff"/><path d="M560.9,373q4.93,0,7.49,1.82a6.31,6.31,0,0,1,2.56,5.51,10.06,10.06,0,0,1-.64,3.68,6.52,6.52,0,0,1-2,2.76,9.85,9.85,0,0,1-3.58,1.72,19.87,19.87,0,0,1-5.23.6h-25l5.33-6.89H560.1a4,4,0,0,0,2.16-.46,1.68,1.68,0,0,0,.68-1.5,1.63,1.63,0,0,0-.68-1.48,4.1,4.1,0,0,0-2.16-.44H545.52a15.83,15.83,0,0,1-4.49-.56,9,9,0,0,1-3.12-1.56,6.15,6.15,0,0,1-1.84-2.42,8,8,0,0,1-.6-3.14,8.61,8.61,0,0,1,.66-3.42,6.6,6.6,0,0,1,2-2.62,10,10,0,0,1,3.56-1.68,19.88,19.88,0,0,1,5.23-.6h23.27l-5.33,7H546.32a4.45,4.45,0,0,0-2.14.4,1.52,1.52,0,0,0-.7,1.44,1.56,1.56,0,0,0,.7,1.46,4.27,4.27,0,0,0,2.14.42Z" transform="translate(-12.75 -119.06)" style="fill:#fff"/><path d="M610,372.35a9.22,9.22,0,0,1-.88,4.06,8.46,8.46,0,0,1-2.58,3.1,12.89,12.89,0,0,1-4.15,2,19.69,19.69,0,0,1-5.57.72h-14v6.85h-8.25v-13.7h23.07a4.7,4.7,0,0,0,3-.84,2.72,2.72,0,0,0,1.06-2.24,2.66,2.66,0,0,0-1.06-2.22,4.78,4.78,0,0,0-3-.82H574.55l5.49-7h16.82a19.18,19.18,0,0,1,5.57.74,12.45,12.45,0,0,1,4.12,2.06,8.85,8.85,0,0,1,2.56,3.16,9.35,9.35,0,0,1,.88,4.09" transform="translate(-12.75 -119.06)" style="fill:#fff"/><polygon points="632.57 263.14 627.25 270.03 601.45 270.03 601.45 243.24 632.49 243.24 627.13 250.21 609.78 250.21 609.78 253.41 631.01 253.41 626.24 259.5 609.78 259.5 609.78 263.14 632.57 263.14" style="fill:#fff"/><polygon points="666.53 263.14 661.21 270.03 635.41 270.03 635.41 243.24 666.45 243.24 661.09 250.21 643.75 250.21 643.75 253.41 664.97 253.41 660.21 259.5 643.75 259.5 643.75 263.14 666.53 263.14" style="fill:#fff"/><path d="M716.21,375.43a12.2,12.2,0,0,1-1.22,5.43,13.24,13.24,0,0,1-3.36,4.33,15.93,15.93,0,0,1-5.11,2.86,19.32,19.32,0,0,1-6.45,1H682.12v-16.7h8.33v9.81h9.61a10.55,10.55,0,0,0,3.18-.46,7.55,7.55,0,0,0,2.5-1.3,6.17,6.17,0,0,0,1.64-2,6,6,0,0,0,0-5.23,6.11,6.11,0,0,0-1.68-2.06,8.46,8.46,0,0,0-2.52-1.36,9.46,9.46,0,0,0-3.12-.5H682.12l5.29-7h12.65a20.92,20.92,0,0,1,6.49,1,15.65,15.65,0,0,1,5.11,2.7,12.44,12.44,0,0,1,3.34,4.17,11.78,11.78,0,0,1,1.2,5.31" transform="translate(-12.75 -119.06)" style="fill:#fff"/><path d="M352.24,192.9h114A57.89,57.89,0,0,1,524,250.66a57.3,57.3,0,0,1-8,29.28h36.43v5.63H504.87a52.07,52.07,0,0,0-38.63-87h-114Z" transform="translate(-12.75 -119.06)" style="fill:#fff;fill-rule:evenodd"/><polygon points="392.69 155.24 455.23 217.78 582.34 217.78 582.34 223.41 460.87 223.41 453.67 223.41 452.9 223.41 384.73 155.24 392.69 155.24" style="fill:#fff;fill-rule:evenodd"/><polygon points="351.82 243.53 410.2 243.53 393.08 269.74 334.69 269.74 351.82 243.53" style="fill:#fff;fill-rule:evenodd"/><polygon points="275.64 243.53 342.16 243.53 325.03 269.74 258.52 269.74 275.64 243.53" style="fill:#b62125;fill-rule:evenodd"/><polygon points="199.46 243.53 265.98 243.53 248.86 269.74 182.34 269.74 199.46 243.53" style="fill:#fff;fill-rule:evenodd"/><polygon points="114.29 269.74 114.29 269.74 131.41 243.53 189.8 243.53 172.68 269.74 114.29 269.74" style="fill:#b62125;fill-rule:evenodd"/><circle cx="721.75" cy="83.47" r="11.16" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/><path d="M730.87,197.3q.65-.1,1.49-.16t1.57-.05a10.74,10.74,0,0,1,2.33.21,4.37,4.37,0,0,1,1.51.62,2.28,2.28,0,0,1,.74.79,2,2,0,0,1,.27,1,2.07,2.07,0,0,1-.78,1.67,4.88,4.88,0,0,1-2,.94v0a2.72,2.72,0,0,1,1.43.74,3.42,3.42,0,0,1,.79,1.41q.37,1.17.6,1.78a3.23,3.23,0,0,0,.47.89h-1.08a3.44,3.44,0,0,1-.4-.85q-.23-.63-.51-1.58a2.92,2.92,0,0,0-1.08-1.6,4,4,0,0,0-2.16-.55h-2.18v4.58h-1Zm1,4.71h2.22a5.18,5.18,0,0,0,2.66-.59,1.8,1.8,0,0,0,1-1.61,1.68,1.68,0,0,0-.28-1,2.08,2.08,0,0,0-.79-.67,4.35,4.35,0,0,0-1.22-.39,8.93,8.93,0,0,0-1.55-.13q-.71,0-1.23,0l-.8.09Z" transform="translate(-12.75 -119.06)" style="fill:#fff;stroke:#fff;stroke-miterlimit:10;stroke-width:2px"/></svg>
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
                                            <h3><a href="view_review.php?p_id=<?=$post['url_id']; ?>" ><?=$post['p_name']; ?></a></h3>
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
                                                <h3><a href="view_review.php?p_id=<?=$post['url_id']; ?>"><?=$post['p_name']; ?></a></h3>
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
                                            <h3><a href="view_article.php?b_id=<?=$article['url_id']; ?>" ><?=$article['b_name']; ?></a></h3>
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
                                            <h3><a href="view_evs.php?ev_id=<?=$ev['url_id']; ?>" class="title-link"><?=$ev['e_name']; ?></a></h3>
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
                                                <a href="view_video.php?v_id=<?=$video['url_id']; ?>"><?=$video['v_title']; ?></a>
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
                                                <h3 style="padding-top:10px"><a href="view_feature.php?b_id=<?=$blg['url_id']; ?>"><?=$blg['b_name']; ?></a></h3>
                                            </header>
                                        </div>
                                    </article>
                                </li>
                            <?php }} ?>
                            </ul>
                        </div>
                    </section>
                    
                    <?php
                    $columns="SELECT * FROM columns WHERE publish='1' ORDER BY id DESC LIMIT 3;";
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
                                                <h3 style="padding-top:10px"><a href="view_column.php?b_id=<?=$column['url_id']; ?>"><?=$column['b_name']; ?></a></h3>
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