<?php
$page_name="Home";

session_start();
include 'admin/config/master.inc.php';
include 'admin/config/connection.php';
include 'string-shortner/short_string.php';

if(isset($_POST['keyword']))
{
    extract($_POST);
  
    $final_result=[];
    $tables=array("posts","news","blog","videos");

    foreach ($tables as $table) 
    {
        if($table=="posts")
        {
            $sql="SELECT id,p_name as heading,p_content as content  FROM $rootdb.posts WHERE CONVERT(`p_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_content` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $posts=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) 
            {
                $final_result[]="<a href='view_post.php?id=".$post['id']."'>".string_short($post['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($post['content'], 0,500)."</p>";
            }
        }
        elseif($table=="news") 
        {
            $sql="SELECT id,n_name as heading,n_content as content  FROM $rootdb.news WHERE CONVERT(`n_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_content` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $news=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($news as $new) 
            {
                $final_result[]="<a href='view_news.php?id=".$new['id']."'>".string_short($new['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($new['content'], 0,500)."</p>";
            }
        }
        elseif($table=="blog") 
        {
            $sql="SELECT id,b_name as heading,b_content as content  FROM $rootdb.blog WHERE CONVERT(`b_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_content` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $blogs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($blogs as $blg) 
            {
                $final_result[]="<a href='view_blog.php?id=".$blg['id']."'>".string_short($blg['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($blg['content'], 0,500)."</p>";
            }
        }
        elseif($table=="videos")
        {
            $sql="SELECT id,v_title as heading,v_description as content  FROM $rootdb.videos WHERE CONVERT(`v_title` USING utf8) LIKE '%$keyword%' OR CONVERT(`v_description` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $videos=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($videos as $video) 
            {
                $final_result[]="<a href='view_video.php?id=".$video['id']."'>".string_short($video['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($video['content'], 0,500)."</p>";
            }
        }
    }
}

?>
<?php include 'header.php'; ?>

<main id="main" class="site-content">
<section class="section-full">
    <div class="mag-content-body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <h4 class="mag-widget-title-1">Search Results</h4><hr>
                    <?php if(!empty($final_result)){ foreach($final_result as $fr){ ?>
                    	<p align="justify-all"><?=$fr; ?></p>
                	<?php }} ?>
				</div>
        	</div> <!-- end .container -->
    	</div>
    </div>
</section> <!-- end .section-full -->
</main> <!--  .site-content  -->
<?php include 'footer.php'; ?>