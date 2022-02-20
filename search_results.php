<?php $page_name="Search";
session_start();
include 'manage/config/master.inc.php';
include 'manage/config/connection.php';
include 'string-shortner/short_string.php';

$final_result=[];
$tables=array("reviews","news","features","articles","evs","videos");

if(isset($_GET['q']))
{
    extract($_GET); 
    $keyword=$q;

    foreach ($tables as $table) 
    {
        if($table=="reviews")
        {
            $sql="SELECT id,url_id,p_name as heading,p_content as content  FROM $rootdb.reviews WHERE CONVERT(`p_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_content` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_author` USING utf8) LIKE '%$keyword%' OR CONVERT(`p_photo_credit` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $posts=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."review/".$post['url_id'].".html'>".string_short($post['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($post['content'], 0,500)."</p>";
            }
        }
        elseif($table=="news") 
        {
            $sql="SELECT id,url_id,n_name as heading,n_content as content  FROM $rootdb.news WHERE CONVERT(`n_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_content` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_author` USING utf8) LIKE '%$keyword%' OR CONVERT(`n_photo_credit` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $news=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($news as $new) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."news/".$new['url_id'].".html'>".string_short($new['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($new['content'], 0,500)."</p>";
            }
        }
        elseif($table=="features") 
        {
            $sql="SELECT id,url_id,b_name as heading,b_content as content  FROM $rootdb.features WHERE CONVERT(`b_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_content` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_author` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_photo_credit` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $blogs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($blogs as $blg) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."feature/".$blg['url_id'].".html'>".string_short($blg['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($blg['content'], 0,500)."</p>";
            }
        }
        elseif($table=="articles") 
        {
            $sql="SELECT id,url_id,b_name as heading,b_content as content  FROM $rootdb.articles WHERE CONVERT(`b_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_content` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_author` USING utf8) LIKE '%$keyword%' OR CONVERT(`b_photo_credit` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $new_blogs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($new_blogs as $n_blg) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."article/".$n_blg['url_id'].".html'>".string_short($n_blg['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($n_blg['content'], 0,500)."</p>";
            }
        }
        elseif($table=="evs") 
        {
            $sql="SELECT id,url_id,e_name as heading,e_content as content  FROM $rootdb.evs WHERE CONVERT(`e_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`e_subhead` USING utf8) LIKE '%$keyword%' OR CONVERT(`e_content` USING utf8) LIKE '%$keyword%' OR CONVERT(`e_author` USING utf8) LIKE '%$keyword%' OR CONVERT(`e_photo_credit` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $evs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($evs as $ev) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."evs/".$ev['url_id'].".html'>".string_short($ev['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($ev['content'], 0,500)."</p>";
            }
        }
        elseif($table=="videos")
        {
            $sql="SELECT id,url_id,v_title as heading,v_description as content  FROM $rootdb.videos WHERE CONVERT(`v_title` USING utf8) LIKE '%$keyword%' OR CONVERT(`v_description` USING utf8) LIKE '%$keyword%' OR CONVERT(`v_author` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $videos=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($videos as $video) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."video/".$video['url_id'].".html'>".string_short($video['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($video['content'], 0,500)."</p>";
            }
        }
    }
}
elseif (isset($_GET['keyword'])) 
{
   extract($_GET); 
    
    foreach ($tables as $table) 
    {
        if($table=="reviews")
        {
            $sql="SELECT id,url_id,p_name as heading,p_content as content  FROM $rootdb.reviews WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $posts=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."review/".$post['url_id'].".html'>".string_short($post['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($post['content'], 0,500)."</p>";
            }
        }
        elseif($table=="news") 
        {
            $sql="SELECT id,url_id,n_name as heading,n_content as content  FROM $rootdb.news WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $news=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($news as $new) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."news/".$new['url_id'].".html'>".string_short($new['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($new['content'], 0,500)."</p>";
            }
        }
        elseif($table=="features") 
        {
            $sql="SELECT id,url_id,b_name as heading,b_content as content  FROM $rootdb.features WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $blogs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($blogs as $blg) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."feature/".$blg['url_id'].".html'>".string_short($blg['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($blg['content'], 0,500)."</p>";
            }
        }
        elseif($table=="articles") 
        {
            $sql="SELECT id,url_id,b_name as heading,b_content as content  FROM $rootdb.articles WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $new_blogs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($new_blogs as $n_blg) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."article/".$n_blg['url_id'].".html'>".string_short($n_blg['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($n_blg['content'], 0,500)."</p>";
            }
        }
        elseif($table=="evs") 
        {
            $sql="SELECT id,url_id,e_name as heading,e_content as content  FROM $rootdb.evs WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $evs=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($evs as $ev) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."evs/=".$ev['url_id'].".html'>".string_short($ev['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($ev['content'], 0,500)."</p>";
            }
        }
        elseif($table=="videos")
        {
            $sql="SELECT id,url_id,v_title as heading,v_description as content  FROM $rootdb.videos WHERE CONVERT(`tags` USING utf8) LIKE '%$keyword%';";
            $query= $conn->query($sql);
            $videos=$query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($videos as $video) 
            {
                $final_result[]="<a href='".ROOT_URL_FRONT."video/".$video['url_id'].".html'>".string_short($video['heading'], 0,150)."</a><br><p align='justify-all'>".string_short($video['content'], 0,500)."</p>";
            }
        }
    }
}
else{}

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
                    	<p ><?=$fr; ?></p>
                	<?php }} ?>
				</div>
        	</div> <!-- end .container -->
    	</div>
    </div>
</section> <!-- end .section-full -->
</main> <!--  .site-content  -->
<?php include 'footer.php'; ?>