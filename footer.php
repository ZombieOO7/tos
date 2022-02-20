<!-- include file -->
<footer class="site-footer">
	<!-- footer-widget-3 -->
    <div class="primary-footer cyan-bg" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="widget">
                        <h4 class="widget-title text-uppercase mb-30 title-ls">Useful Links</h4>
                        <ul class="dribble-shots">
                            <li><a href="about_us.php"><i class="material-icons">keyboard_arrow_right</i> About Us</a></li>
                            <!-- <li><a href="gallery.php"><i class="material-icons">keyboard_arrow_right</i> Gallery</a></li> -->
                            <li><a href="<?=ROOT_URL_FRONT;?>contact_us.php"><i class="material-icons">keyboard_arrow_right</i> Contact Us</a></li>
                            <li><a href="<?=ROOT_URL_FRONT;?>terms_and_conditions.php"><i class="material-icons">keyboard_arrow_right</i> Terms & Conditions</a></li>
                            <li><a href="<?=ROOT_URL_FRONT;?>privacy_policy.php"><i class="material-icons">keyboard_arrow_right</i> Privacy Policy</a></li>
                            <li><a href="<?=ROOT_URL_FRONT;?>cookies_policy.php"><i class="material-icons">keyboard_arrow_right</i> Cookies Policy</a></li>
                        </ul>
                         <ul class="social-2 flex mt-20">
                            <li><a href="https://www.facebook.com/turnofspeed" class="facebook text-light" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/turnofspeed" class="twitter text-light" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.instagram.com/turnofspeed.in/" class="insta text-light" target="_blank"><i class="fa fa-instagram"></i></a></li>
                           <!--  <li><a href="#" class="gplus text-light"><i class="fa fa-youtube"></i></a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="widget">
                        <h4 class="widget-title text-uppercase mb-30 title-ls"><i class="fa fa-instagram" style="padding: 3px 3px 3px 5px;font-size: 25px;background:#cc0099"></i> Instagram Feed</h4>
                        <div class="widget-inner">
                            <?php
                                $insta_posts="SELECT posts FROM insta_posts ORDER BY id DESC LIMIT 6;";
                                $insta_posts = $conn->query($insta_posts);
                                $insta_posts=$insta_posts->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <ul class="instagram-widget" >
                                <?php
                                if(!empty($insta_posts)){ foreach($insta_posts as $ip){
                                $single_post=json_decode($ip['posts'], true);
                                $cURLConnection = curl_init();
                                $post_url="https://graph.facebook.com/v8.0/instagram_oembed?url=https:".$single_post['post_url']."&maxwidth=320&fields=thumbnail_url%2Cauthor_name%2Cprovider_name%2Cprovider_url&access_token=1427780094279868|5a682aa88cd1da291e6de477ac3c9284";
                                curl_setopt($cURLConnection, CURLOPT_URL, $post_url);
                                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                                $phoneList = curl_exec($cURLConnection);
                                curl_close($cURLConnection);
                                $phoneList=json_decode($phoneList,true);
                                ?>
                                <li><a href="<?=$single_post['post_url'];?>" target="_blank"><img src="<?=$phoneList['thumbnail_url'];?>"/></a></li>
                                <?php }} ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="widget">
                    <h4 class="widget-title text-uppercase mb-30 title-ls"><i class="fa fa-twitter" style="padding: 3px 3px 3px 5px;font-size: 25px;background:#55acee"></i> Twitter Feed</h4>
                    <a class="twitter-timeline" data-width="320" data-height="240" data-lang="en" data-theme="dark" href="https://twitter.com/turnofspeed?ref_src=twsrc%5Etfw" data-chrome="noheader nofooter noborders noscrollbar" data-aria-polite="assertive">Tweets by turnofspeed</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-widget-3 -->
    <div class="secondery-footer">
        <div class="container">
            <div class="inner-footer border-top">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-8">
                        <p align="center" style="margin-bottom: 9px !important;">Copyright &copy; <?=date("Y");?> Carte Blanche Media (OPC) Private Limited. All Rights Reserved.</p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                       <p align="center" style="margin-bottom: 9px !important;">Designed & Managed By <a href="https://www.arinesolutions.com/" title="Web Development Company in Thane, Mumbai">Arine Solutions</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if (date("Y-m-d H:i") > "2021-01-01 00:00") { ?>
        <a href="javascript:void(0)" id="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <?php } ?>
    </div>
</footer>
<!-- Modal Structure -->
<div id="modal-search" class="modal ml-modal">
    <div class="modal-content">
        <div class="modal-header text-center mb-50">
            <img src="<?=ROOT_URL_FRONT."images/logo.png"?>" style="background-color: #000; border:5px solid #000;" height="60px" width="150px"><hr>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- <h4 class="mag-widget-title-2">Search</h4> -->
                    <form action="<?=ROOT_URL_FRONT; ?>search_results" class="widget-inner search-form" id="global-search" method="get">
                        <input type="text" name="q" id="keyword" placeholder="Search here..." required>
                         <center><button type="submit" class="btn btn-primary btn-default btn-lg mt-10">Search</button></center>
                    </form>
                </div><!-- end. col-12 -->
            </div><!-- end. row-->
        </div>
    </div>
</div> <!-- end #modal-id-1 -->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154928749-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154928749-1');
</script>

<!-- include file -->
<!--JavaScripts========================== -->
<script src="<?=ROOT_URL;?>global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script src="<?=ROOT_URL_FRONT;?>js/jquery.min.js"></script>
<script src="<?=ROOT_URL_FRONT;?>js/masterslider/masterslider.min.js"></script> 
<script src="<?=ROOT_URL_FRONT;?>js/scripts.minified.js"></script>
<script src="<?=ROOT_URL_FRONT;?>js/main.js"></script>
<script src="<?=ROOT_URL_FRONT;?>js/form_validation.js"></script>
<!-- <script src="js/polls.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){
    $(".ml-modal").modal();
    $('[data-toggle="popover"]').popover();
    $(".tooltipped").tooltip({delay: 50});
   $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
           $('#dynamic').addClass('sticky-fixed-top');
        } else {
           $('#dynamic').removeClass('sticky-fixed-top');
        }
    });
   $("#poll_before").show();

 function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$("input[name=poll_ans]").click(function(e){
        e.preventDefault();
        var poll=$("#poll_id").val();
        var cookies=document.cookie;
        var pollid;
        my_cook=cookies.split(" ");
        $.each(my_cook, function(){
            if(this.includes("pollid=")){
                var test=this.split("=");
                value=test[1];
                pollid=value.replace(';','');
            }
        });
        if(pollid!==poll)
        {
            var opt_id=$(this).data("id");
            $.ajax({
                type:'POST',
                url:'<?=ROOT_URL; ?>models/submit_poll_response.php',
                data:{'poll':poll,'opt_id':opt_id},
                dataType:'html',
                success: function(resp2) {
                    $("#poll_after").html(resp2);
                    setCookie("pollid",poll,365);
                }
            });
        }
        else
        {
            swal({
                title: "You have already Voted !!!",
                confirmButtonColor: "#2196F3",
                type: "info",
                confirmButton:true,
                timer:3500
            });
        }
    });
});
</script>
</body>
</html>