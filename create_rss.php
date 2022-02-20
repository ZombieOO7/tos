<?php
    header('Content-type: text/xml; charset=utf-8');
    include_once 'manage/config/master.inc.php';
    include "manage/config/connection.php";
    extract($_GET);
    $prev_date=date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d"))));
    $limit=20;
    
    if($rss=="reviews"){$results="SELECT id,url_id,p_name as heading,p_subhead as subhead,p_content as content,p_author as author,cover_photo,created_at,updated_at FROM reviews ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="news") {$results="SELECT id,url_id,n_name as heading,n_subhead as subhead,n_content as content,n_author as author,cover_photo,created_at,updated_at  FROM news ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="features") {$results="SELECT id,url_id,b_name as heading,b_subhead as subhead,b_content as content,b_author as author,cover_photo,created_at,updated_at  FROM features ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="articles") {$results="SELECT id,url_id,b_name as heading,b_subhead as subhead,b_content as content,b_author as author,cover_photo,created_at,updated_at  FROM articles ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="columns") {$results="SELECT id,url_id,b_name as heading,b_subhead as subhead,b_content as content,b_author as author,cover_photo,created_at,updated_at  FROM columns ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="evs") {$results="SELECT id,url_id,e_name as heading,e_subhead as subhead,e_content as content,e_author as author,cover_photo,created_at,updated_at  FROM evs ORDER BY id DESC LIMIT $limit;";}
    elseif($rss=="videos"){$results="SELECT id,url_id,v_title as headin,'' as subhead,v_description as content,v_descauthor as author,cover_photo,created_at,updated_at FROM videos ORDER BY id DESC LIMIT $limit;";}
    
    $results= $conn->query($results);
    $results=$results->fetchAll(PDO::FETCH_ASSOC);
    
    $rss_title="TURN OF SPEED - ".strtoupper($rss);
    $rss_path="https://www.turnofspeed.in/rss/".$rss;
    
    $lastBuildDate=$results[0]['updated_at'];
    if(empty($lastBuildDate)){
        $lastBuildDate=date("Y-m-d H:i:s", strtotime(strtotime($results[0]['created_at'])));
    }
    
    $rss_data='';
    $rss_data=$rss_data."<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
    "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\" xmlns:media=\"http://search.yahoo.com/mrss/\">\n".
    "   <channel>\n".
    "       <atom:link href=\"".$rss_path."\" rel=\"self\" type=\"application/rss+xml\" />\n".
	"       <title>".$rss_title."</title>\n".
	"       <link>http://www.turnofspeed.in</link>\n".
	"       <description>Latest car &amp; bike news and the most comprehensive reviews, pictures of new and upcoming cars &amp; bikes.</description>\n".
	"       <language>en-gb</language>\n".
	"       <copyright>Copyright:(C) 2016-".date("Y")." Falcon Ebiz Private Limited</copyright>\n".
	"       <lastBuildDate>".date(DATE_RFC2822, (strtotime($lastBuildDate)+substr($results[0]['id'], -2)))."</lastBuildDate>\n".
	"       <category>News,Auto News</category>\n".
	"       <image>\n".
    "           <url>https://www.turnofspeed.in/images/logo1.png</url>\n".
    "           <title>".$rss_title."</title>\n".
    "           <link>http://www.turnofspeed.in</link>\n".
    "       </image>\n";
    
    foreach($results as $result){
        $content=str_replace('<p style="text-align:justify">','<p style="text-align:justify;font-family: Calibri,sans-serif;">',str_replace('<p>','<p style="font-family: Calibri,sans-serif;">',str_replace("REPLACE_URL",ROOT_URL,$result['content'])));
        $post_link='https://www.turnofspeed.in/'.$rss.'/'.$result['url_id'].'.html';
        
        $title=htmlspecialchars($result['heading']);
        $content=trim(preg_replace('/\s\s+/', ' ', str_replace("\n", " ", $content)));
        
        if($rss=="reviews"){
            $get_image=json_decode($result['cover_photo']);
            $image="https://www.turnofspeed.in/manage/".$get_image[0];
        }
        else{
            $image="https://www.turnofspeed.in/manage/".$result['cover_photo'];
        }
        
        if(!empty($result['author'])){$author=$result['author'];}
        else{$author="TURN OF SPEED";}
        
        
        list($width, $height) = getimagesize($image);
        $rss_data=$rss_data."		<item>\n".
            "			<guid isPermaLink=\"false\">".$rss."_".$result['id']."</guid>\n".
            "			<pubDate>".date(DATE_RFC2822, strtotime($result['created_at']))."</pubDate>\n".
            "			<title>".$title."</title>\n".
            "			<description>".str_replace('&','&amp;',$result['subhead'].htmlspecialchars(strip_tags($content)))."</description>\n".
            "           <content:encoded><![CDATA[".$result['subhead'].htmlspecialchars($content)."]]></content:encoded>\n".
            "			<category>".$rss."</category>\n".
            "			<media:content url='".$image."' height='".$height."' width='".$width."' type='image/png'/>\n".
            "		    <link>".$post_link."</link>\n".
            "			<author>mail@turnofspeed.in (".trim($author).")</author>\n".
            "		</item>\n";
    }    
    $rss_data=$rss_data."\n   </channel>\n</rss>\n";
    print_r($rss_data);
?>