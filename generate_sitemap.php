<?php 
    session_start();
    include_once'manage/config/master.inc.php';
    include_once ROOT_PATH.'config/connection.php';

	$sqlchk="SELECT * FROM columns ORDER BY id DESC;";
	$qchk=$conn->query($sqlchk);
	$chk_res=$qchk->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($chk_res as $rs){
	    $timestamp = date("Y-m-d 10:52:17",strtotime($rs['b_date']));
	    $url_id=$rs['url_id'];
	    $name=$rs['b_name'];
        $searchfor = "https://www.turnofspeed.in/column/".$url_id.".html";
	    
    	$file = ROOT_PATH_FRONT."sitemap.xml";
    	$file1 = "sitemap/sitemap_index.xml";
        header('Content-Type: text/plain');
        $contents1 = file_get_contents($file1);
        preg_match_all("'<loc>(.*?)</loc>'si", $contents1, $match);
        $site_count=count($match[0]);
    	
        $file = "sitemap/sitemap".$site_count.".xml";
        $contents = file_get_contents($file);
        $pattern = preg_quote($searchfor, '/');
    	$pattern = "/^.*$pattern.*\$/m";
    	
    	if(!preg_match_all($pattern, $contents, $matches)){
            preg_match_all("'<loc>(.*?)</loc>'si", $contents, $count_url);
            $url_count=count($count_url[0]);
            if($url_count=="1000" || $url_count=="0")
            {
                $site_count=$site_count+1;
                $file="sitemap/sitemap".$site_count.".xml";
                $pf = fopen ($file, "w");
                if (!$pf) {
                    echo "Cannot create $file!" . NL;
                    return;
                }
                fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
                "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:news=\"http://www.google.com/schemas/sitemap-news/0.9\"> \n".
                "   <url>\n".
                "       <loc>".$searchfor.".html</loc>\n".
                "       <news:news>\n".
                "           <news:publication>\n".
                "               <news:name>TURN OF SPEED</news:name>\n".
                "               <news:language>en</news:language>\n".
                "           </news:publication>\n".
                "           <news:publication_date>".date("c",strtotime($timestamp))."</news:publication_date>\n".
                "           <news:title>".$name."</news:title>\n".
                "       </news:news>\n".
                "   </url>\n".
                "</urlset>");
                fclose ($pf);
                
                $index_file = fopen($file1, "w") or die("Unable to open file!");
                    $contents1 = str_replace('</sitemapindex>', '', $contents1);
                    
                    $txt1 =$contents1."   <sitemap>\n".
                    "       <loc>https://www.turnofspeed.in/sitemap/sitemap".($site_count+1).".xml</loc>\n".
                    "   </sitemap>\n".
                    "</sitemapindex>";
                    fwrite($index_file, $txt1);
                    fclose($index_file);
    	    }
    		else{
    		    $pattern = preg_quote($searchfor, '/');
                $pattern = "/^.*$pattern.*\$/m";
        
                if(!preg_match_all($pattern, $contents, $matches)){
                    $prfile = fopen("sitemap/sitemap".$site_count.".xml", "w") or die("Unable to open file!");
                    $contents = str_replace('</urlset>', '', $contents);
                    
                    $txt =$contents."   <url>\n".
                    "       <loc>".$searchfor."</loc>\n".
                    "       <news:news>\n".
                    "           <news:publication>\n".
                    "               <news:name>TURN OF SPEED</news:name>\n".
                    "               <news:language>en</news:language>\n".
                    "           </news:publication>\n".
                    "           <news:publication_date>".date("c",strtotime($timestamp))."</news:publication_date>\n".
                    "           <news:title>".$name."</news:title>\n".
                    "       </news:news>\n".
                    "   </url>\n".
                    "</urlset>";
                    fwrite($prfile, $txt);
                    fclose($prfile);
                }
    		}
    	}
    	//die();
	}

?>