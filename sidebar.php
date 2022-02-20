<?php
    $sqlp="SELECT * FROM reviews WHERE publish='1' ORDER BY p_date DESC,id DESC LIMIT 3;";
    $qp= $conn->query($sqlp);
    $posts=$qp->fetchAll(PDO::FETCH_ASSOC);
    
    $sqln="SELECT * FROM news WHERE publish='1' ORDER BY n_date DESC,id DESC LIMIT 3;";
    $qn = $conn->query($sqln);
    $news=$qn->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlb="SELECT * FROM features WHERE publish='1' ORDER BY b_date DESC,id DESC LIMIT 3;";
    $qb = $conn->query($sqlb);
    $blog=$qb->fetchAll(PDO::FETCH_ASSOC);
?>
 <aside class="col-xs-12 col-md-4 widget-area">
    <!--<section class="widget magazine-widget">
        <div class="widget-inner" align='center'>
            <small>Advertisement</small><br><a href="https://www.turnofspeed.in/view_evs.php?ev_id=god-is-in-the-detel" target="_blank"><img src="<?=ROOT_URL_FRONT; ?>images/detel-easy.jpg" alt="" class="img-responsive center-block"></a>
        </div>
    </section>-->
    <?php $curPageName=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
    <section class="widget magazine-widget">
        <h4 class="mag-widget-title-2">Latest</h4>
        <div class="tab-8">
            <!-- Nav tabs -->
            <ul class="tab-nav text-center mb-30" role="tablist">
                <?php $act=0; if($page_name!=="Reviews" && $curPageName!=="view_review.php"){ $act=1; ?>
                    <li <?php if( $act==1){echo "class='active'"; } ?> >
                        <a href="#tab-post" data-toggle="tab">REVIEWS</a>
                    </li>
                <?php } if($page_name!=="News" && $curPageName!=="view_news.php") { ?>
                    <li <?php if( $act==0){echo "class='active'"; } ?> >
                        <a href="#tab-news" data-toggle="tab">NEWS</a>
                    </li>
                <?php } if($page_name!=="Features" && $curPageName!=="view_feature.php"){ ?>
                    <li>
                        <a href="#tab-blog" data-toggle="tab">FEATURES</a>
                    </li>
                <?php } if($page_name!=="Articles" && ($curPageName!=="view_article.php" && $curPageName!=="view_evs.php")){ ?>
                    <li>
                        <a href="#tab-new_blog" data-toggle="tab">ARTICLES</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php if($page_name!=="Reviews"){  ?>
                    <ul id="tab-post" <?php if($act==1){ echo 'class="tab-pane fade widget-post-list active in"'; }else{ echo 'class="tab-pane fade widget-post-list"'; } ?> >
                    <?php if(!empty($posts)){ foreach($posts as $post){ $cp_images=[]; $cp_images=json_decode($post['cover_photo'],true); if(count($cp_images)==1){ ?>
                        <li class="flex">
                            <article class="hentry-card">
                                <?php foreach ($cp_images as $cp_image) { ?> 
                                    <figure class="media">
                                        <img src="<?=ROOT_URL.$cp_image; ?>" alt="" class="img-responsive">
                                    </figure>
                                <?php } ?>
                                <div class="overlap-sidebar relative">
                                    <header class="hentry-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                        <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>"><?=$post['p_name']; ?></a></h3>
                                    </header>
                                </div>
                            </article>
                        </li>
                    <?php }else{ ?>
                        <li class="flex">
                            <div class="post-slider-sidebar ms-skin-default">
                                <?php foreach ($cp_images as $cp_image) { ?> 
                                <div class="ms-slide slide-1" data-delay="2"> 
                                    <img src="js/masterslider/blank.gif" data-src="<?=ROOT_URL.$cp_image; ?>" class="img-responsive"/>
                                </div>
                                <?php } ?>
                                <div class="overlap-sidebar hentry-card relative">
                                    <header class="hentry-header">
                                        <h3><a href="<?=ROOT_URL_FRONT."review/".$post['url_id'].".html"; ?>"><?=$post['p_name']; ?></a></h3>
                                    </header>
                                </div>
                            </div>
                        </li>
                    <?php }}} ?>
                    </ul>
                <?php } if($page_name!=="News") { ?>
                    <ul id="tab-news" <?php if($act==0){ echo 'class="tab-pane fade widget-post-list active in"'; }else{ echo 'class="tab-pane fade widget-post-list"'; } ?> >
                    <?php if(!empty($news)){ foreach($news as $nws){ ?>
                        <li class="flex">
                            <article class="hentry-card">
                                <figure class="media">
                                    <img src="<?=ROOT_URL.$nws['cover_photo']; ?>" alt="" class="img-responsive">
                                </figure>
                                <div class="overlap-sidebar relative">
                                    <header class="hentry-header">
                                        <h3><a href="<?=ROOT_URL_FRONT."news/".$nws['url_id'].".html"; ?>"><?=$nws['n_name']; ?></a></h3>
                                    </header>
                                </div>
                            </article>
                        </li>
                    <?php }} ?>
                    </ul>
                <?php } if($page_name!=="Features"){ ?>
                    <ul id="tab-blog" class="tab-pane fade widget-post-list">
                    <?php if(!empty($blog)){ foreach($blog as $blg){ ?>
                        <li class="flex">
                            <article class="hentry-card">
                                <figure class="media">
                                    <img src="<?=ROOT_URL.$blg['cover_photo']; ?>" alt="" class="img-responsive">
                                </figure>
                                <div class="overlap-sidebar relative">
                                    <header class="hentry-header">
                                        <h3><a href="<?=ROOT_URL_FRONT."feature/".$blg['url_id'].".html"; ?>"><?=$blg['b_name']; ?></a></h3>
                                    </header>
                                </div>
                            </article>
                        </li>
                    <?php }} ?>
                    </ul>
                <?php } if($page_name!=="Articles"){  ?>
                     <ul id="tab-new_blog" class="tab-pane fade widget-post-list">
                    <?php if(!empty($new_blogs)){ foreach($new_blogs as $nblg){ ?>
                        <li class="flex">
                            <article class="hentry-card">
                                <figure class="media">
                                    <img src="<?=ROOT_URL.$nblg['cover_photo']; ?>" alt="" class="img-responsive">
                                </figure>
                                <div class="overlap-sidebar relative">
                                    <header class="hentry-header">
                                        <h3><a href="<?=ROOT_URL_FRONT."article/".$nblg['url_id'].".html"; ?>"><?=$nblg['b_name']; ?></a></h3>
                                    </header>
                                </div>
                            </article>
                        </li>
                    <?php }} ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- end .widget -->

    <?php if(!empty($poll_options)){ ?>
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

 <!--    <section class="widget magazine-widget">
        <div class="widget-inner">
            <a href="#"><img src="images/widget-ad.jpg" alt="" class="img-responsive center-block"></a>
        </div>
    </section> -->

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
</aside><!-- /.col-md-4 -->