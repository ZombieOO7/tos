<?php
    session_start();
    include 'manage/config/master.inc.php';
    include 'manage/config/connection.php';

    extract($_GET);

    if(array_key_exists("user_role", $_SESSION))
    {
        $sql="SELECT * FROM stories WHERE url='$id';";
        $query_db = $conn->query($sql);
        $results=$query_db->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        $sql="SELECT * FROM stories WHERE url='$id' AND publish='1';";
        $query_db = $conn->query($sql);
        $results=$query_db->fetchAll(PDO::FETCH_ASSOC);

        $sqlup="UPDATE stories SET view_count=(view_count+1) WHERE publish='1' AND id='".$results[0]['id']."';";
        $qup= $conn->prepare($sqlup);
        $qup->execute();
    }

    $story_data="SELECT * FROM story_items WHERE story_id='".$results[0]['id']."';";
    $story_data = $conn->query($story_data);
    $story_data=$story_data->fetchAll(PDO::FETCH_ASSOC);
    
    $link_array=array_filter(array_column($story_data, "link"), function($value) { return !is_null($value) && $value !== ''; });
?>
<!DOCTYPE html>
<html amp lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <title><?=$results[0]['name']; ?></title>
        <meta name="keywords" property="keywords" content="<?=$results[0]['name']; ?>">
        <style amp-custom>body{style="font-family: 'Oswald',sans-serif;"}h1{font-weight:700;font-size:30px;line-height:1.1;color:#b71c0c;text-align:center}p{font-weight:700;font-size:22px;line-height:1.1em;color:#fff;text-align:center}.csoohfscqc[active] amp-img.pbrdepx>img{animation:pan-left-custom 8s linear forwards;width:auto}.csoohfscqc1[active] amp-img.pbrdepx>img{animation:pan-right-custom 8s linear forwards;width:auto}.csoohfscqc2[active] amp-img.pbrdepx>img{animation:bg-zoom-out 8s linear forwards;width:auto}.pbrdepxp amp-img.pbrdepx>img{max-width:unset;max-height:unset;margin:0;height:100%;left:0;object-fit:cover;object-position:97.7642276422764% 51.21951219512195%;top:0;transition:filter 0.5s ease;width:100%}.scrim#crbew{background:no-repeat linear-gradient(0deg,#000 0,rgba(0,0,0,0) 42.5%)}.yvqwh#jimpozkmva img{object-fit:cover;object-position:0 0;max-width:unset;max-height:unset;margin:unset;top:0;height:100.13%;left:0;width:100%}.yvqwh amp-img img{object-fit:cover;object-position:0 0}.yvqwh amp-img{transform:translateX(-50%) translateY(-50%)}.yvqwh{height:2.67em;left:49.82%;top:4.5%;width:11.8em}.kcwut{color:#fff;font-family:Oswald,sans-serif;font-size:1.69em;font-weight:400;left:6.94%;letter-spacing:.05em;line-height:1.4em;text-align:center;top:87.67%;width:85.83%}.vtfgr{color:#fcf304;font-family:Oswald,sans-serif;font-size:1.87em;font-weight:400;left:6.94%;letter-spacing:.05em;line-height:1.4em;text-align:center;top:82.83%;width:85.83%}.vldwl{border:2px solid #cfac6a;border-radius:100px;color:#cfac6a;font-family:Oswald,sans-serif;font-size:1.6em;font-weight:500;height:27px;left:29.44%;line-height:1.4em;text-align:center;top:60px;width:100%;background-color:#fff;border-radius:2px;border:0 none;color:#b71c0c;line-height:40px;width:100%}amp-img{position:relative}.cta-a{text-decoration:none;display:flex;align-items:center}.cta-a span{width:100%;font-size:14px}amp-story{font-size:3.125vw}@media screen and (min-aspect-ratio:3/5) and (max-aspect-ratio:5/5){amp-story{font-size:1.875vh}.letterbox{width:60vh;height:100vh;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)}amp-story-cta-layer .letterbox{height:20vh}}@media screen and (min-width:1024px){amp-story{font-size:1.8vh}}@media screen and (min-width:1024px) and (max-height:660px){amp-story{font-size:1.8vh}}::cue{background-color:rgba(0,0,0,.75);font-size:24px;line-height:1.5}@keyframes pan-right-custom{0%{transform:translateX(calc(-100% + 100vw))}100%{transform:translateX(0)}}@keyframes bg-zoom-out{0%{transform:scale(1.2)}100%{transform:scale(1)}}@keyframes pan-left-custom{0%{transform:translateX(0)}100%{transform:translateX(calc(-100% + 100vw))}}.vldwl{border:2px solid #cfac6a;border-radius:100px;color:#cfac6a;font-family:Oswald,sans-serif;font-size:1.6em;font-weight:500;height:27px;left:29.44%;line-height:1.4em;text-align:center;top:60px;width:100%;background-color:#fff;border-radius:2px;border:0 none;color:#b71c0c;line-height:40px;width:100%}amp-story-grid-layer.bottom{align-content:end}</style>
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
        <?php if(!empty($link_array)){ ?>
        <link rel="canonical" href="<?=$link_array[0];?>">
        <?php } ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?display=swap&family=Roboto:400,500" media="all">
    </head>
    <body style="font-family: 'Oswald', sans-serif;">
        <?php if (!empty($results)) { ?>
        <amp-story standalone title="Turn of Speed" publisher="Turn of Speed" publisher-logo-src="<?=ROOT_URL_FRONT;?>images/logo.png" poster-portrait-src="<?=ROOT_URL.$results[0]['cover_img']; ?>" style="background: #0b0b0c;">
            <?php $i=1; foreach ($story_data as $sd) { 
                if ($sd['animation']=='1') {
                    $animation="csoohfscqc";
                }
                elseif ($sd['animation']=='2') {
                    $animation="csoohfscqc1";
                }
                elseif ($sd['animation']=='3') {
                    $animation="csoohfscqc2";
                }
                else{
                    $animation="csoohfscqc";
                }
            ?>
            <!-- PAGE 1 STARTS HERE -->
                <amp-story-page id="csoohfscqc" class="<?=$animation;?> ms-st-pg" auto-advance-after="11000ms" >
                <!-- PAGE BACKGROUND LAYER (csoohfscqc) -->
                    <amp-story-grid-layer template="fill" class="pbrdepxp">
                        <amp-img width='720' height='1280' layout='responsive' class='pbrdepx' id='csoohfscqc-bg' src='<?=ROOT_URL.$sd['image']; ?>' alt='Background Image' ></amp-img>
                    </amp-story-grid-layer>
                    <!-- PAGE BACKGROUND LAYER (csoohfscqc) ENDS -->
                    <amp-story-grid-layer template="vertical">
                        <amp-img width='150' height='50' layout='fixed' src='<?=ROOT_URL_FRONT;?>images/logo.png' alt='Turn of Speed' style="background:#000;border:5px solid #000;border-left-width:10px;top:-55px;left:25%;"></amp-img>
                    </amp-story-grid-layer>
                    <amp-story-grid-layer template="vertical" class="bottom">
                        <h1><?=$sd['title']; ?></h1>
                        <p><?=$sd['description']; ?></p>
                        <?php if (!empty($sd['link'])) { ?>
                            <a class='vldwl pa cta-a' href='<?=$sd['link'];?>' id='cnovszqzdw' data-vars-ctalink='<?=$sd['link'];?>'><span>READ MORE</span></a>
                        <?php } ?>
                    </amp-story-grid-layer>
                </amp-story-page>
            <!-- PAGE 1 ENDS HERE -->
            <?php $i++; } ?>
            <amp-story-bookend src="bookend.json" layout="nodisplay"></amp-story-bookend>
        </amp-story>
        <?php } ?>
    </body>
</html>