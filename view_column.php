<?php 
session_start();

$share_link=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

include 'manage/config/master.inc.php';
include 'manage/config/connection.php';

if(!empty($_GET['b_id']))
{
	extract($_GET);
	if(strpos($share_link, "view_column.php?b_id=")!==false)
    {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location:'.ROOT_URL_FRONT.'column/'.$b_id.'.html');
        exit();
    }

    if(array_key_exists("user_role", $_SESSION))
    {
        $sqlb="SELECT * FROM columns WHERE url_id='$b_id';";
        $qb= $conn->query($sqlb);
        $columns=$qb->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
    	$sqlb="SELECT * FROM columns WHERE publish='1' AND url_id='$b_id';";
    	$qb= $conn->query($sqlb);
    	$columns=$qb->fetchAll(PDO::FETCH_ASSOC);

        $sqlup="UPDATE columns SET view_count=(view_count+1) WHERE publish='1' AND id='".$columns[0]['id']."';";
        $qup= $conn->prepare($sqlup);
        $qup->execute();
    }

    $sqlc="SELECT c.*,ct.cust_name FROM comments c LEFT JOIN customers ct ON  c.cust_id=ct.id WHERE c.nblog_id='".$columns[0]['id']."';";
    $qc= $conn->query($sqlc);
    $comments=$qc->fetchAll(PDO::FETCH_ASSOC);

    $sqlo="SELECT post_by FROM organization;";
    $qo = $conn->query($sqlo);
    $orgData=$qo->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($_COOKIE["cust_hash"])) {
    $likes="SELECT * FROM like_section WHERE cust_hash='".$_COOKIE['cust_hash']."' AND article_id='".$columns[0]['id']."';";
    $likes=$conn->query($likes);
    $likes=$likes->fetchAll(PDO::FETCH_ASSOC);
}

$page_name=$columns[0]['b_name'];
$desc= $columns[0]['b_subhead'];
?>
<?php include 'header.php'; ?>
<script type="application/ld+json">
{
    "@context":"http://schema.org",
    "@type":"NewsArticle",
    "mainEntityOfPage":
    {
        "@type":"WebPage",
        "@id":"<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"},
        "headline":"<?=$columns[0]['b_name']; ?>",
        "datePublished":"<?=date("c",strtotime($columns[0]['b_date'])); ?>",
        "dateModified":"<?=date("c",strtotime($columns[0]['updated_at'])); ?>",
        "articleBody":"<?=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($columns[0]['b_content']))));?>",
        "keywords":"<?=$columns[0]['tags'];?>",
        "url":"<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>",
        "description":"<?php if (!empty($columns[0]['b_subhead'])) { echo $columns[0]['b_subhead']; }else{ echo trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", strip_tags($columns[0]['b_content'])))); } ?>",
        "author":
        [
            {
                "@type":"Person",
                "name":"<?php if (!empty($columns[0]['b_author'])) { echo $columns[0]['b_author']; }else{ echo "Rachna Tyagi"; } ?>"
            },
            {
                "@type":"Thing",
                "name":"Turn of Speed",
                "url":"<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"
            }
        ],
        "publisher":
        {
            "@type":"Organization",
            "name":"Turn of Speed",
            "logo":
                {
                    "@type":"ImageObject",
                    "url":"<?=ROOT_URL_FRONT;?>images/logo.png"
                }
        },
        "image":
        [
            {
                "@type":"ImageObject",
                "url":"<?=ROOT_URL.$columns[0]['cover_photo']; ?>"
            }
        ]
    }
}
</script>
<?php
if($columns[0]['is_cover_story']=='1'){ ?>
    <style>
        html::before {background-image: url('../images/tos_grey.jpg') !important;opacity: 1 !important; background-color:#000;}
        .hentry-single{background-color: rgba(0,0,0,0.5) !important;}
        .hentry-title{color:#fff !important;}
        body{color:#fff !important;}
    </style>
<?php } ?>
<main id="main" class="site-content">
	<section class="section-full">	
		<div class="mag-content-body">
			<div class="container">
				<div class="row hentry-single">
                    <div class="col-sm-12 col-md-12">
                        <h3 class="hentry-title"> <?=$columns[0]['b_name']; ?></h3>
                        <span class="sep block mt-10 mb-10"></span>
                        <h6 class="hentry-title"><i><?=$columns[0]['b_subhead']; ?></i></h6>
                        <br>
    					<div class="col-xs-12 col-md-8">
    						<article>
                              <?php if(!empty($columns)){ foreach($columns as $blg){ ?>
                               <div class="hentry-meta flex flex-middle disable-flex-xs fw700 mt-15">
                                    <span class="posted-on mr-10"><i class="mr-5 fa fa-calendar-check-o"></i> <?=date("M d, Y",strtotime($blg['b_date'])); ?></span>
                                <?php if($orgData[0]['post_by']=="1"){ ?>     
                                    <?php if(!empty($blg['b_author'])){ ?>
                                    <span class="author mr-10"><i class="mr-5 fa fa-user"></i> <?=$blg['b_author']; ?></span>
                                     <?php } ?>
                                <?php } ?> 
                                <?php if(!empty($comments)){ ?>
                                     <?php if(count($comments)==1){ ?>
                                        <span class="comments mr-10"><i class="mr-5 fa fa-comments"></i> <?=count($comments); ?> Comment</span>
                                    <?php }else{ ?>
                                         <span class="comments mr-10"><i class="mr-5 fa fa-comments"></i> <?=count($comments); ?> Comments</span>
                                    <?php } ?> 
                                <?php }else{ ?>
                                    <span class="comments mr-10"><i class="mr-5 fa fa-comments"></i> No Comments</span>
                                <?php } ?>
                                    <span class="comments float l-review <?php if(!empty($likes)) { echo 'al-review'; }else{ echo 'l-review'; } ?>" data-id="<?=$columns[0]['id'];?>" style="cursor: pointer;"><i class="mr-5 ml-5 fa fa-thumbs-up"></i> <?php if(!empty($likes)) { echo 'Liked'; }else{ echo 'Like'; } ?></span>
                                    <!-- <span class="cats"><i class="mr-5 fa fa-folder-open"></i> General/Cultural</span> -->
                                </div> <!-- end .hentry-meta -->

                                <div class="hentry-content mt-20">
                                    <figure class="media mb-10">
                                        <img src="<?=ROOT_URL.$blg['cover_photo']; ?>" alt="" class="img-responsive">
                                        <?php if(!empty($blg['b_graphics'])){ ?>
                                            <div class="photo-credit pic"> GRAPHICS : <?=$blg['b_graphics'];?></div>
                                        <?php } ?>
                                        <?php if(!empty($blg['b_illustration'])){ ?>
                                            <div class="photo-credit ill"> ILLUSTRATION : <?=$blg['b_illustration'];?></div>
                                        <?php } ?>
                                        <?php if(!empty($blg['b_photo_credit'])){ ?>
                                            <div class="photo-credit gra"> PIC : <?=$blg['b_photo_credit'];?></div>
                                        <?php } ?>
                                    </figure>
                                    <div class="pull-left">
                                        <?php if($orgData[0]['post_by']=="1"){ ?>     
                                            <?php if(!empty($blg['b_author'])){ ?>
                                                <p><i class="f700">By</i> : <span class="by-line"><?=$blg['b_author']; ?></p>
                                            <?php } ?>
                                        <?php } ?>    
                                    </div><br><hr>   
                                    <p align="justify">
                                        <?php
										$content=str_replace('font-family:Calibri','',str_replace("REPLACE_URL",ROOT_URL,$blg['b_content']));
                                        if(!empty($blg['b_location']))
                                        { 
                                            echo $blg['b_location'].' : '.$content; 
                                        }
                                        else
                                        { 
                                            echo $content; 
                                        } 
                                        ?>
                                    </p>
                                    <hr>
                                </div> <!-- end .hentry-content -->

                                <div class="hentry-footer row flex flex-middle disable-flex-xs mt-30">
                                    <?php $all_tags=[]; $all_tags=explode(",", $blg['tags']); ?>
                                    <div class="col-xs-12 col-sm-6">
                                        <span class="tags">Tags :</span>
                                        <?php if(!empty($all_tags)){ foreach($all_tags as $at){  ?>
                                            <a href="<?=ROOT_URL_FRONT; ?>search_results.php?keyword=<?=trim($at); ?>" class="text-link inline ml-15"><?=$at; ?></a>
                                        <?php }} ?>
                                    </div> <!-- end .col-xs-12 -->

                                    <div class="col-xs-12 col-sm-6">
                                        <ul class="social-2 flex flex-middle flex-right">
                                            <li><a href="https://www.facebook.com/sharer.php?u=<?=$share_link; ?>&quote=Do read this on turn of speed" class="facebook text-light"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="https://twitter.com/intent/tweet?url=<?=$share_link; ?>&quote=Do read this on turn of speed" class="twitter text-light"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?=$share_link; ?>&quote=Do read this on turn of speed" class="linkedin text-light"><i class="fa fa-linkedin"></i></a></li>
                                            <li style="background-color:#4CAF50;color:#fff;"><a href="whatsapp://send?text=Do read this on turn of speed <?=$share_link; ?>" data-action="share/whatsapp/share"><i style="color:#fff;" class="fa fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div> <!-- end .col-xs-12 -->
                                </div> <!-- end .hentry-footer -->
                            <?php }} ?>
                            </article> <!-- /.hentry-single -->

                            <form action="<?=ROOT_URL; ?>models/add_comment_front.php" class="comment-form row mt-50" method="post">
                                <div class="col-xs-12 mb-20">
                                    <h3 class="mag-widget-title-2">Leave a Reply</h3>
                                </div>
                                <input type="hidden" name="redirect" value="<?=$share_link; ?>">
                                <input type="hidden" name="cust_id" value="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id']; } ?>">
                                <input type="hidden" name="nblog_id" value="<?=$columns[0]['id']; ?>">
                                <div class="col-xs-12">
                                    <div class="input-field">
                                        <textarea class="materialize-textarea mb-0 block" name="comment"  placeholder="Enter Comment Here..." style="padding:5px !important;" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-12 mb-20">
                                    <?php if(isset($_SESSION['user_id'])){ ?>
                                        <button class="btn btn-md  waves-effect" type="submit" name="submit">Comment As <?=$_SESSION['username']; ?></button>
                                    <?php }else{ ?>
                                        <a class="btn btn-md  waves-effect" href="#modal-id-1">Submit Comment</a>
                                    <?php } ?>
                                </div>
                            </form>
                            <!-- //.comment-form -->
                            <?php if(!empty($comments)){ ?>
                            <div class="comments-container mt-60 mb-30">
                                <h3 class="mag-widget-title-2">Comments</h3>
                                <div class="comment-list mt-20">
                                    <?php foreach($comments as $comment){ ?>    
                                        <div class="comment">
                                            <div class="comment-body flex disable-flex-xs flex-middle shadow-default">
                                                <div class="comment-content">
                                                    <div class="comment-meta mb-15">
                                                        <h4 class="fw400"><a class="title-link"><?=$comment['cust_name']; ?></a></h4>
                                                        <time datetime="" class="flex flex-middle fw300">
                                                            <?=date("F d, Y  H:i a",strtotime($comment['created_at'])); ?>
                                                        </time>
                                                        <span class="sep block mt-10 mb-10"></span>
                                                    </div>
                                                    <p class="fw300"><?=$comment['comment']; ?></p>
                                                </div> <!-- //.comment-content -->
                                            </div> <!-- //.comment-body -->
                                        </div> <!-- //.comment -->
                                    <?php } ?>
                                </div> <!-- //.comment-list -->
                            </div>
                            <?php } ?>
                            <!-- end .comments-container -->
                        </div><!-- /.col-md-8 -->
                        <?php include 'sidebar.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--  .site-content  -->
<?php include 'footer.php';?>
<!-- Modal Structure -->
<div id="modal-id-1" class="modal ml-modal">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="page-login-wrapper">
                        <!-- Nav tabs -->
                        <ul class="masonry-filter tab style-3 dark  mb-30 text-center">
                            <li class="active"><a href="#tab-login" data-toggle="tab">Login</a></li>
                            <li><a href="#tab-register" data-toggle="tab">Register</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <form id="tab-login" class="row tab-pane matex-login fade in active">
                             <div class="col-xs-12"> 
                                <div class="input-field">
                                    <input type="email" class="ml-input" name="cust_email" required autocomplete="off">
                                    <label for="email">Email <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <div class="col-xs-12"> 
                                <div class="input-field">
                                    <input class="ml-input" type="password" name="cust_pass" required autocomplete="off">
                                    <label for="password">Password <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <button class="waves-effect btn-large btn-round  w100" id="login-btn">Login</button>
                        </form>

                        <form id="tab-register" class="tab-pane matex-login fade">
                            <div class="col-xs-12"> 
                                <div class="input-field">
                                    <input type="hidden" name="redirect" value="<?=$share_link; ?>">
                                    <input type="text" class="ml-input" name="cust_name" required autocomplete="off">
                                    <label for="user_name">Username <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <div class="col-xs-12"> 
                                <div class="input-field">
                                    <input type="text" class="ml-input" name="cust_phone" required autocomplete="off">
                                    <label for="email">Phone No. <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <div class="col-xs-12"> 
                                <div class="input-field">
                                    <input type="email" class="ml-input" name="cust_email" required autocomplete="off">
                                    <label for="email">Email <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <div class="col-xs-12">     
                                <div class="input-field">
                                    <input type="password" class="ml-input" name="cust_pass" required autocomplete="off">
                                    <label for="password">Password <span style="color:#F00;">*</span></label>
                                </div>
                            </div>
                            <button class="waves-effect btn-large btn-round  w100" id="register-btn">Get Started</button>
                        </form>
                    </div>
                </div><!-- end. page-login-wrapper -->
            </div><!-- end. col-12 -->
        </div><!-- end. row-->
    </div>
</div>
</div> <!-- end #modal-id-1 -->
<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click','.l-review', function (e) {
            e.preventDefault();
            var a_id = $(this).data('id');

            if(a_id=="")
            {
                return false;
            }
            else
            {   
                $.ajax({
                    type: 'POST',
                    url: '<?=ROOT_URL;?>models/update_like_count.php',
                    data:{'a_id':a_id},
                    dataType:'json',
                    success: function (response) 
                    {
                        if (response==1) {
                            $(".float").removeClass("l-review");
                            $(".float").addClass("al-review");
                            $(".float").html("<i class='mr-5 ml-10 fa fa-thumbs-up'></i> Liked");
                        }
                    }
                });
            }
        });

        $(document).on('click','.al-review', function (e) {
            e.preventDefault();

            swal({
                title: "You have already Like !!!",
                confirmButtonColor: "#2196F3",
                type: "info",
                confirmButton:true,
                timer:3500
            });
        });

        $("#login-btn").click(function(e){
            e.preventDefault();

            if ($('#tab-login').valid()) 
            {
                $.ajax({
                  type: "POST",
                  url: "<?=ROOT_URL; ?>models/cust_login.php",
                  data: $("#tab-login").serialize(),
                  dataType:"json",
                  success: function(resp){
                      location.reload();
                  }
              });
            }
            else
            {
                return false;
            }
        });

        $("#register-btn").click(function(e){
            e.preventDefault();
            if ($('#tab-register').valid()) 
            {
                $.ajax({
                  type: "POST",
                  url: "<?=ROOT_URL; ?>models/cust_registration.php",
                  data: $("#tab-register").serialize(),
                  dataType:"json",
                  success: function(response){
                    if(response.status==true)
                    {
                        location.href="<?=ROOT_URL_FRONT; ?>thank_you.php";
                    }
                }
            });
            }
            else
            {
                return false;
            }
        });



        $('#s_id').attr("required",false);
        $('#s_otp').attr("required",false);
        $('#s_otp').hide();
        $('.otp-section').hide();

        $("#subscribe").click(function(e){
            e.preventDefault();

            if ($('#subscriber_form').valid()==true) 
            {
                disableButton();

                $.ajax({
                    type:'POST',
                    url:'<?=ROOT_URL; ?>models/add_subscriber.php',
                    data:$('#subscriber_form').serialize(),
                    dataType:'json',
                    success: function(resp) {
                        if(resp.status==true)
                        {
                            $('.otp-section').show();
                            $('#s_otp').show();
                            $('#s_id').attr("required",true);
                            $('#s_otp').attr("required",true);
                            $('#s_id').val(resp.s_id);

                            swal({
                                title: "Success!",
                                text: resp.msg,
                                confirmButtonColor: "#66BB6A",
                                type: "success",
                                confirmButton:true,
                                timer:5000
                            });

                            $("#subscribe").html('Done !!!').attr('disabled','disabled');

                        }
                        else if(resp.status==false)
                        {
                             swal({
                                title: "Information!",
                                text: resp.msg,
                                confirmButtonColor: "#2196F3",
                                type: "info",
                                confirmButton:true,
                                timer:5000
                            });

                            $("#subscribe").html('Subscribe Now');
                            $("#subscribe").removeAttr("disabled");
                            
                        }else{ return false;}
                    }
                });
            }
        });    

        function disableButton() 
        {
            $("#subscribe").html('Sending...Please wait').attr('disabled','disabled');
        }


        $('#s_otp').on('keyup paste',function(e){
            e.preventDefault();

            var s_id=$.trim($('#s_id').val());
            var checkotp=$.trim($('#s_otp').val());

            $.ajax({
                    type:'POST',
                    url:'<?=ROOT_URL; ?>models/get_otp.php',
                    data:{'id':s_id,'otp':checkotp},
                    dataType:'json',
                    success: function(resp1) {
                        if(resp1.status==true)
                        {
                            $("#s_otp").css('border', '2px solid #0F0');
                            $("#verify").removeAttr("disabled");
                        }
                        else
                        {
                             $("#s_otp").css('border', '2px solid #F00');
                             return false;
                        }

                    }
            });

        });

});
</script>