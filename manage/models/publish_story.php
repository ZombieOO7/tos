<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
require_once "../../plugins/sitemap/autoload.php";

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['id'])) 
{	
 	extract($_GET);

	$data=[
		":publish"=>$st,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp,
	];

	$columnsup="";
	$colsup=array_keys($data);
	$colsup=implode(", ",  $colsup);
	$set_data=explode(", ", $colsup);
	$u_data="";
	foreach ($set_data as $key => $value) 
	{
		$u_data=$u_data.str_replace(":", "",$value)."=".$value.",";
	}
	$up_data=rtrim($u_data,",");

	try
	{	
		$sql="UPDATE stories SET $up_data WHERE id='$id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($st=="1")
			{
				$sqlchk="SELECT * FROM stories WHERE id='$id';";
				$qchk=$conn->query($sqlchk);
				$chk_res=$qchk->fetchAll(PDO::FETCH_ASSOC);
				
				$file1 = "../../sitemap/sitemap_index.xml";
                header('Content-Type: text/plain');
                $contents1 = file_get_contents($file1);
                preg_match_all("'<loc>(.*?)</loc>'si", $contents1, $match);
                $site_count=count($match[0]);
        		
                $file = "../../sitemap/sitemap".$site_count.".xml";
                $searchfor = "https://www.turnofspeed.in/story/".$chk_res[0]['url'].".html";
                $contents = file_get_contents($file);
                $pattern = preg_quote($searchfor, '/');
				$pattern = "/^.*$pattern.*\$/m";
				
				if(!preg_match_all($pattern, $contents, $matches)){
                    preg_match_all("'<loc>(.*?)</loc>'si", $contents, $count_url);
                    $url_count=count($count_url[0]);
                    if($url_count=="1000" || $url_count=="0")
                    {
                        $site_count=$site_count+1;
                        $file="../../sitemap/sitemap".$site_count.".xml";
                        $pf = fopen ($file, "w");
                        if (!$pf) {
                            echo "Cannot create $file!" . NL;
                            return;
                        }
                        fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
                        "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:news=\"http://www.google.com/schemas/sitemap-news/0.9\"> \n".
                        "       <url>\n".
                        "           <loc>".$searchfor."</loc>\n".
                        "           <news:news>\n".
                        "               <news:publication>\n".
                        "                   <news:name>TURN OF SPEED</news:name>\n".
                        "                   <news:language>en</news:language>\n".
                        "               </news:publication>\n".
                        "               <news:publication_date>".date("c",strtotime($timestamp))."</news:publication_date>\n".
                        "               <news:title>".htmlspecialchars($chk_res[0]['name'])."</news:title>\n".
                        "           </news:news>\n".
                        "       </url>\n".
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
                            $prfile = fopen("../../sitemap/sitemap".$site_count.".xml", "w") or die("Unable to open file!");
                            $contents = str_replace('</urlset>', '', $contents);
                            
                            $txt =$contents."   <url>\n".
                            "       <loc>".$searchfor."</loc>\n".
                            "       <news:news>\n".
                            "           <news:publication>\n".
                            "               <news:name>TURN OF SPEED</news:name>\n".
                            "               <news:language>en</news:language>\n".
                            "           </news:publication>\n".
                            "           <news:publication_date>".date("c",strtotime($timestamp))."</news:publication_date>\n".
                            "           <news:title>".htmlspecialchars($chk_res[0]['name'])."</news:title>\n".
                            "       </news:news>\n".
                            "   </url>\n".
                            "</urlset>";
                            fwrite($prfile, $txt);
                            fclose($prfile);
                        }
    				}
    			}
    			
    			$client = new Google_Client();
                $client->setAuthConfig("../../plugins/sitemap/indexing_key.json");
                $client->addScope("https://www.googleapis.com/auth/indexing");
                $httpClient = $client->authorize();
                $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
                
                $content = "{
                  \"url\": \"$searchfor\",
                  \"type\": \"URL_UPDATED\"
                }";
                
                $response = $httpClient->post($endpoint, [ 'body' => $content ]);
                $status_code = $response->getStatusCode();
                
                $sqlup="UPDATE stories SET is_index='$status_code' WHERE id='$id';";
                $qup= $conn->prepare($sqlup);
                $qup->execute();
                
                $client = new Google_Client();
                $client->setAuthConfig("../../plugins/sitemap/indexing_key.json");
                $client->addScope("https://www.googleapis.com/auth/indexing");
                $httpClient = $client->authorize();
                $httpClient->get("http://www.google.com/ping?sitemap=https://www.turnofspeed.in/sitemap/sitemap_index.xml");
                
                $bing_data['siteUrl']='https://www.turnofspeed.in';
                $bing_data['url'][]=$searchfor;
                $burl = "https://ssl.bing.com/webmaster/api.svc/json/SubmitUrlBatch?apikey=0bf4911e83904f4196fd3798adc77b83";
                $headers = array(
                   "Content-Type: application/json",
                   "charset: utf-8",
                );
                
                $data=json_encode($bing_data);
                $curl = curl_init($burl);
                curl_setopt($curl, CURLOPT_URL, $burl);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                
                $resp = curl_exec($curl);
                curl_close($curl);
                
    			$_SESSION['s']="Story Published Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Story Un-published Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_stories.php');
		}
		else
		{
			$_SESSION['e']="Failed To Published / Un-published Story, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
