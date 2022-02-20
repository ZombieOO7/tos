<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, must-revalidate");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php 
    $og_image=ROOT_URL_FRONT."/images/logo1.png";
    if($page_name=='Reviews'){$rss_type="reviews";}
    elseif($page_name=='News'){$rss_type="news";}
    elseif($page_name=="Features"){$rss_type="features";}
    elseif($page_name=="Articles"){$rss_type="articles";}
    elseif($page_name=="Columns"){$rss_type="columns";}
    elseif($page_name=='Electric Vehicle'){$rss_type="evs";}
    elseif($page_name=="Video Gallery"){$rss_type="videos";}
    else{$rss_type="";}
    
    if(!empty($post_ones[0]['cover_photo'])){$cp_images=json_decode($post_ones[0]['cover_photo'],true);$og_image=ROOT_URL.$cp_images[0];}
    elseif(!empty($news[0]['cover_photo'])){$og_image=ROOT_URL.$news[0]['cover_photo'];}
    elseif(!empty($blog[0]['cover_photo'])){$og_image=ROOT_URL.$blog[0]['cover_photo'];}
    elseif(!empty($new_blog[0]['cover_photo'])){$og_image=ROOT_URL.$new_blog[0]['cover_photo'];}
    elseif(!empty($columns[0]['cover_photo'])){$og_image=ROOT_URL.$columns[0]['cover_photo'];}
    elseif(!empty($evs[0]['cover_photo'])){$og_image=ROOT_URL.$evs[0]['cover_photo'];}
    list($og_width, $og_height) = getimagesize($og_image);
    if(!empty($rss_type)){
        echo '<link rel="alternate" type="application/rss+xml" title="" href="'.ROOT_URL_FRONT."rss/".$rss_type.'"/>';
    }
    $descrip=$desc;
    if(!empty($post_ones)){if(!empty($post_ones[0]['p_subhead'])){ $descrip=$post_ones[0]['p_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($post_ones[0]['p_content']))));}}
    elseif(!empty($news)){if(!empty($news[0]['n_subhead'])){ $descrip=$news[0]['n_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($news[0]['n_content']))));}}
    elseif(!empty($blog)){if(!empty($blog[0]['b_subhead'])){ $descrip=$blog[0]['b_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($blog[0]['b_content']))));}}
    elseif(!empty($evs)){if(!empty($evs[0]['e_subhead'])){ $descrip=$evs[0]['e_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($evs[0]['e_content']))));}}
    elseif(!empty($columns)){if(!empty($columns[0]['b_subhead'])){ $descrip=$columns[0]['b_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($columns[0]['b_content']))));}}
    elseif(!empty($new_blog)){if(!empty($new_blog[0]['b_subhead'])){ $descrip=$new_blog[0]['b_subhead']; }else{ $descrip=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($new_blog[0]['b_content']))));}}
    if(empty($descrip)){$descrip='Latest car &amp; bike news and the most comprehensive reviews, pictures of new and upcoming cars &amp; bikes.';}
    ?>
    <?php $final_title=strtoupper($page_name); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Rachna Tyagi">
    <title><?=$final_title;?> | TURN OF SPEED</title>
    <meta name="description" content="<?=$descrip; ?>">
    <meta name="keywords" content="<?=$desc; ?>">
    <link rel="shortcut icon" href="<?=ROOT_URL_FRONT;?>images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,900|Abril+Fatface:300,400,500,700,900|Alfa+Slab+One:300,400,500,700,900|Anton:300,400,500,700,900|Archivo+Black:300,400,500,700,900|DM+Serif+Display:300,400,500,700,900|Ultra:300,400,500,700,900|Lalezar:300,400,500,700,900|Yeseva+One:300,400,500,700,900|Oswald:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>css/style.minified.css">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>css/main.css">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>css/custom.css">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>css/sweet-alert.css">
    <link rel="stylesheet" href="<?=ROOT_URL_FRONT;?>js/masterslider/style/masterslider.css" />
    <meta property="og:locale" content="en_GB"/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="TURN OF SPEED"/>
    <meta property="og:url" content="<?=ROOT_URL_FRONT;?>"/>
    <meta property="og:image" content="<?=$og_image;?>"/>
    <meta property="og:image:width" content="<?=$og_width;?>">
    <meta property="og:image:height" content="<?=$og_height;?>">
    <meta property="og:description" content="<?=$descrip;?>">
    <meta property="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image" content="<?=$og_image;?>"/>
    <meta name="twitter:description" content="<?=$descrip;?>">
    <script type="text/javascript">
        $(document).ready(function(){
            <?php if(!empty($_SESSION['s'])){ ?>
                swal({
                    title: "Success!",
                    text: "<?=$_SESSION['s'];?>",
                    confirmButtonColor: "#66BB6A",
                    type: "success",
                    confirmButton:true,
                    timer:5000

                });
            <?php } unset($_SESSION['s']); ?>
            <?php if(!empty($_SESSION['e'])){ ?>
                swal({
                    title: "Error!",
                    text: "<?=$_SESSION['e'];?>",
                    confirmButtonColor: "#EF5350",
                    type: "error",
                    confirmButton:true,
                    timer:5000
                });
            <?php } unset($_SESSION['e']); ?>
            <?php if(!empty($_SESSION['i'])){ ?>
                swal({
                    title: "Information!",
                    text: "<?=$_SESSION['i'];?>",
                    confirmButtonColor: "#2196F3",
                    type: "info",
                    confirmButton:true
                    timer:5000
                });
            <?php } unset($_SESSION['i']); ?>

            $(".post-slider").masterslider({width:800,height:450,space:0,speed:45,layout:"fillwidth",loop:!0,preload:0,autoplay:!0,view:"parallaxMask",instantStartLayers:!0,controls:{arrows:{autohide:!1}}}),
            $(".post-slider-sidebar").masterslider({width:400,height:250,space:0,speed:45,layout:"fillwidth",loop:!0,preload:0,autoplay:!0,view:"parallaxMask",instantStartLayers:!0,controls:{arrows:{autohide:!1}}});
        });
    </script>
</head>
<body>
<!-- include header -->
<header id="header" class="site-header header-sp menu-dark sticky">
    <div class="header-inner">
        <div class="container">
            <a class="site-logo" href="<?=ROOT_URL_FRONT;?>">
                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 810.09 270.36"><title>Turn of Speed</title><path d="M652.55,260.92v10.23H482.68l-93.73-93.73h86.47a13,13,0,1,0,0-25.94H365.51v12.33l-7.75-5.34V143.73H475.41a20.72,20.72,0,1,1,0,41.43H407.65l78.24,78.24H644.8v-9.68ZM318.64,131.52V104.61H475.41a59.82,59.82,0,0,1,22.33,115.32l4.35,4.35h103.6v-6.91l7.75,7.2V232H498.88L484,217.15l10.83-4.39a52.07,52.07,0,0,0-19.42-100.39h-149v24.5Z" transform="translate(-9 -85.05)" style="fill:#b72225;fill-rule:evenodd"/><polygon points="596.68 139.23 596.68 19.56 662.96 19.56 763.22 119.82 763.22 19.56 810.09 19.56 810.09 186.1 763.22 186.1 643.55 66.43 643.55 186.1 635.8 178.35 635.8 47.73 766.43 178.35 802.34 178.35 802.34 27.31 770.97 27.31 770.97 138.52 659.75 27.31 604.43 27.31 604.43 146.98 604.43 146.98 596.68 139.23" style="fill:#fff;fill-rule:evenodd"/><path d="M68.84,104.61h177v83.27a36.4,36.4,0,1,0,72.8,0V104.61l7.75,7.75v75.52a44.15,44.15,0,1,1-88.3,0V112.36H16.75v31.37H76.58V263.4H108V143.73h98.76v44.15a75.52,75.52,0,1,0,151,0V143.73l7.75,7.75v36.4a83.27,83.27,0,0,1-166.54,0v-36.4H115.7V271.15H68.84V151.48H9V104.61Z" transform="translate(-9 -85.05)" style="fill:#fff;fill-rule:evenodd"/><path d="M345.95,150.34V131.92H475.41a32.53,32.53,0,1,1,0,65.06H436.16l54.61,54.62H633v-8.84l-7.75-7.2v8.29H494l-28.21-28.21L463,212.9l-8.18-8.17h20.77a38.45,38.45,0,0,0,23.74-8,40.23,40.23,0,0,0-24-72.57H338.2V145Z" transform="translate(-9 -85.05)" style="fill:#b72225;fill-rule:evenodd"/><polygon points="623.99 166.54 623.99 41.67 646.46 41.67 771.32 166.54 772.27 166.54 772.27 166.54 788.14 166.54 790.53 166.54 790.53 39.12 782.78 39.12 782.78 158.79 774.53 158.79 653.82 38.08 653.82 38.08 651.71 35.97 649.66 33.92 616.24 33.92 616.24 39.12 616.24 41.67 616.24 158.79 623.99 166.54" style="fill:#fff;fill-rule:evenodd"/><path d="M28.56,124.17v7.75H88.4V251.59h7.75V131.92H218.53v56a63.71,63.71,0,1,0,127.42,0v-56l-7.75-7.75v63.71a56,56,0,0,1-111.92,0V124.17H28.56Z" transform="translate(-9 -85.05)" style="fill:#fff;fill-rule:evenodd"/><path d="M472.45,345.83a62.3,62.3,0,0,0,7.27-.36,12.92,12.92,0,0,0,4.82-1.4,6.17,6.17,0,0,0,2.67-2.89,14.47,14.47,0,0,0,0-9.64,6,6,0,0,0-2.67-2.86,13.29,13.29,0,0,0-4.82-1.38,74.06,74.06,0,0,0-14.54,0,13.29,13.29,0,0,0-4.82,1.38,6,6,0,0,0-2.67,2.86,14.46,14.46,0,0,0,0,9.64,6.17,6.17,0,0,0,2.67,2.89,12.93,12.93,0,0,0,4.82,1.4,62.33,62.33,0,0,0,7.27.36m0-28.47q13.44,0,20.18,4.57t6.75,14.43q0,9.91-6.72,14.48t-20.21,4.57q-13.55,0-20.24-4.57t-6.69-14.48q0-9.86,6.72-14.43T472.45,317.36Z" transform="translate(-9 -85.05)" style="fill:#fff"/><polygon points="537.46 232.92 530.08 242.5 507.61 242.5 507.61 247.29 535.37 247.29 528.43 256.27 507.61 256.27 507.61 269.76 496.16 269.76 496.16 232.92 537.46 232.92" style="fill:#fff"/><path d="M605.54,332.67q6.77,0,10.3,2.51t3.52,7.57a13.83,13.83,0,0,1-.88,5.07,9,9,0,0,1-2.81,3.8,13.55,13.55,0,0,1-4.93,2.37,27.32,27.32,0,0,1-7.19.83H569.26l7.32-9.47h27.86a5.43,5.43,0,0,0,3-.63,2.31,2.31,0,0,0,.94-2.06,2.24,2.24,0,0,0-.94-2,5.64,5.64,0,0,0-3-.61h-20a21.76,21.76,0,0,1-6.17-.77,12.4,12.4,0,0,1-4.3-2.15,8.46,8.46,0,0,1-2.53-3.33,11,11,0,0,1-.83-4.32,11.84,11.84,0,0,1,.91-4.71,9.07,9.07,0,0,1,2.81-3.61,13.82,13.82,0,0,1,4.9-2.31,27.33,27.33,0,0,1,7.19-.83h32L611,327.55H585.5a6.12,6.12,0,0,0-2.95.55,2.08,2.08,0,0,0-1,2,2.15,2.15,0,0,0,1,2,5.87,5.87,0,0,0,2.95.58Z" transform="translate(-9 -85.05)" style="fill:#fff"/><path d="M673.05,331.79a12.68,12.68,0,0,1-1.21,5.59,11.64,11.64,0,0,1-3.55,4.27,17.73,17.73,0,0,1-5.7,2.75,27.08,27.08,0,0,1-7.65,1H635.66v9.42H624.32V336H656a6.46,6.46,0,0,0,4.1-1.16,3.73,3.73,0,0,0,1.46-3.08,3.66,3.66,0,0,0-1.46-3.06,6.57,6.57,0,0,0-4.1-1.13H624.32l7.54-9.58H655a26.37,26.37,0,0,1,7.65,1,17.12,17.12,0,0,1,5.67,2.84,12.17,12.17,0,0,1,3.52,4.35,12.85,12.85,0,0,1,1.21,5.62" transform="translate(-9 -85.05)" style="fill:#fff"/><polygon points="712.62 260.29 705.3 269.76 669.84 269.76 669.84 232.92 712.51 232.92 705.13 242.5 681.29 242.5 681.29 246.91 710.47 246.91 703.92 255.27 681.29 255.27 681.29 260.29 712.62 260.29" style="fill:#fff"/><polygon points="759.32 260.29 751.99 269.76 716.53 269.76 716.53 232.92 759.21 232.92 751.83 242.5 727.99 242.5 727.99 246.91 757.17 246.91 750.62 255.27 727.99 255.27 727.99 260.29 759.32 260.29" style="fill:#fff"/><path d="M819.09,336a16.78,16.78,0,0,1-1.68,7.46,18.21,18.21,0,0,1-4.63,5.95,21.9,21.9,0,0,1-7,3.94,26.56,26.56,0,0,1-8.87,1.43H772.23v-23h11.45v13.49H796.9a14.5,14.5,0,0,0,4.38-.63,10.38,10.38,0,0,0,3.44-1.79,8.48,8.48,0,0,0,2.26-2.78,8.23,8.23,0,0,0,0-7.19,8.39,8.39,0,0,0-2.31-2.84,11.64,11.64,0,0,0-3.47-1.87,13,13,0,0,0-4.3-.69H772.23L779.5,318h17.4a28.76,28.76,0,0,1,8.92,1.32,21.52,21.52,0,0,1,7,3.72,17.1,17.1,0,0,1,4.6,5.73,16.19,16.19,0,0,1,1.65,7.3" transform="translate(-9 -85.05)" style="fill:#fff"/><path d="M318.64,85.05H475.39a79.6,79.6,0,0,1,79.42,79.42,78.79,78.79,0,0,1-11,40.26h50.08v7.75H528.51A71.59,71.59,0,0,0,475.39,92.8H318.64Z" transform="translate(-9 -85.05)" style="fill:#fff;fill-rule:evenodd"/><polygon points="382.8 111.92 468.78 197.91 643.55 197.91 643.55 205.66 476.53 205.66 466.64 205.66 465.58 205.66 371.84 111.92 382.8 111.92" style="fill:#fff;fill-rule:evenodd"/><polygon points="326.59 233.32 406.87 233.32 383.33 269.35 303.05 269.35 326.59 233.32" style="fill:#fff;fill-rule:evenodd"/><polygon points="221.85 233.32 313.31 233.32 289.76 269.35 198.31 269.35 221.85 233.32" style="fill:#b72225;fill-rule:evenodd"/><polygon points="117.11 233.32 208.57 233.32 185.02 269.35 93.56 269.35 117.11 233.32" style="fill:#fff;fill-rule:evenodd"/><polygon points="0 269.35 0 269.35 23.54 233.32 103.82 233.32 80.28 269.35 0 269.35" style="fill:#b72225;fill-rule:evenodd"/></svg>
            </a>
            <!-- end .site-logo -->
            <button class="nav-hamburger dark hidden-md hidden-lg">
                <span>Toggle Menu</span>
            </button>
            <!-- end .header-right -->
            <nav class="primary-nav clear">
                <ul class="menu-list nav-hover-4 sf-menu list-none">
                    <li <?php echo $page_name=="Home" ? 'class="active"' : ''; ?>>
                        <a href="<?=ROOT_URL_FRONT;?>index.html">HOME</a>
                    </li>
                    <li <?php echo $page_name=='News' ? 'class="has-dropdown active"' : ''; ?> class="has-dropdown">
                        <a class="feature relative" href="<?=ROOT_URL_FRONT;?>news.html">NEWS</a>
                        <?php $sqlnc="SELECT * FROM news_category WHERE status=0 ORDER BY id ASC;";
                        $qnc=$conn->query($sqlnc);
                        $n_category=$qnc->fetchAll(PDO::FETCH_ASSOC);
                        if(!empty($n_category)){ ?>
                        <ul class="sub-menu light text-uppercase">
                            <?php foreach($n_category as $n_cat){ ?>
                                <li><a href="<?=ROOT_URL_FRONT;?>news.html?cat_id=<?=$n_cat['id']; ?>"><?=$n_cat['name']; ?></a></li>
                            <?php }?>
                        </ul>
                        <?php } ?>
                    </li>
                    <li <?php echo $page_name=='Reviews' ? 'class="has-dropdown active"' : ''; ?> class="has-dropdown">
                        <a class="feature relative" href="<?=ROOT_URL_FRONT;?>reviews.html">REVIEWS</a>
                        <?php if(!empty($n_category)){ ?>
                        <ul class="sub-menu light text-uppercase">
                            <?php foreach($n_category as $n_cat){ ?>
                                <li><a href="<?=ROOT_URL_FRONT;?>reviews.html?cat_id=<?=$n_cat['id']; ?>"><?=$n_cat['name']; ?></a></li>
                            <?php }?>
                        </ul>
                        <?php } ?>
                    </li>
                    <li <?php echo $page_name=="Features" ? 'class="active"' : ''; ?> >
                        <a href="<?=ROOT_URL_FRONT;?>features.html">FEATURES</a>
                    </li>
                    <li <?php echo $page_name=="Articles" ? 'class="active"' : ''; ?> >
                        <a href="<?=ROOT_URL_FRONT;?>articles.html">Articles</a>
                    </li>
                    <li <?php echo $page_name=='Electric Vehicle' ? 'class="has-dropdown active"' : ''; ?> class="has-dropdown">
                        <a class="feature relative" href="<?=ROOT_URL_FRONT;?>electric_vehicles.html">EV<span style="text-transform: lowercase;">s</span></a>
                        <?php if(!empty($n_category)){ ?>
                        <ul class="sub-menu light text-uppercase">
                            <?php foreach($n_category as $n_cat){ ?>
                                <li><a href="<?=ROOT_URL_FRONT;?>electric_vehicles.html?cat_id=<?=$n_cat['id']; ?>"><?=$n_cat['name']; ?></a></li>
                            <?php }?>
                        </ul>
                        <?php } ?>
                    </li>
                    <li <?php echo $page_name=="Stories" ? 'class="active"' : ''; ?> >
                        <a href="<?=ROOT_URL_FRONT;?>stories.html">STORIES</a>
                    </li>
                    <?php $sqlvs="SELECT id FROM videos WHERE publish='1' ORDER BY id ASC LIMIT 1;";
                    $qvs=$conn->query($sqlvs);
                    $vids=$qvs->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($vids)){ ?>
                    <li <?php echo $page_name=="Video Gallery" ? 'class="active"' : ''; ?> >
                        <a href="<?=ROOT_URL_FRONT;?>video_gallery.html">VIDEOS</a>
                    </li>
                    <?php } ?>
                    <!-- <li <?php echo $page_name=="Contact Us" ? 'class="active"' : ''; ?> >
                        <a href="contact_us.php">CONTACT US</a>
                    </li> 
                    <li <?php echo $page_name=="About Us" ? 'class="active"' : ''; ?> >
                        <a href="about_us.php">ABOUT US</a>
                    </li>  -->
                    <?php if(isset($_SESSION['user_id'])){ ?>
                    <li>
                        <a href="<?=ROOT_URL; ?>models/cust_logout.php">Logout</a>
                    </li>
                    <?php  } ?>
                    <li <?php echo $page_name=="Search" ? 'class="active"' : ''; ?>>
                        <a href="#modal-search"><i class="fa fa-search"></i>&nbsp;Search</a>
                    </li>
                </ul>
            </nav> 
        </div>
    </div>
</header>
<style>.blink_me{animation-duration:1.2s;animation-name:blink;animation-iteration-count:infinite;animation-direction:alternate;-webkit-animation:blink 1.2s infinite;background:#000;padding:0 5px}@keyframes blink{from{color:#b71c0c}to{color:#fff}}@-webkit-keyframes blink{from{color:#b71c0c}to{color:#fff}}</style>
<!-- include header -->
<?php if (date("Y-m-d H:i") > "2020-12-25 13:00" && date("Y-m-d H:i") < "2021-01-01 00:00") { ?>
<style type="text/css">
    #ann{
        position: fixed;
        z-index: 9999;
        bottom: 5px;
        right: 0;
    }
</style>
<a href="javascript:void(0)" id="ann">
    <img src="images/first_ann.jpg" style="width: 150px;">
</a>
<?php } ?>
<?php
$sqlpoll="SELECT * FROM polls ORDER BY id DESC LIMIT 1;";
$qpoll = $conn->query($sqlpoll);
$polls=$qpoll->fetchAll(PDO::FETCH_ASSOC);
$two_days=date("Y-m-d",strtotime($polls[0]['from_date']. " + 2 days"));

$sqlpop="SELECT * FROM poll_options WHERE poll_id='".$polls[0]['id']."' ORDER BY id ASC;";
$qpop = $conn->query($sqlpop);
$poll_options=$qpop->fetchAll(PDO::FETCH_ASSOC);
?>