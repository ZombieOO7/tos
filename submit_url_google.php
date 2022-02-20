<?php
    include_once 'manage/config/master.inc.php';
    include 'manage/config/connection.php';
    require_once "plugins/sitemap/autoload.php";
	date_default_timezone_set('Asia/Kolkata');
	$timestamp = date("Y-m-d H:i:s");
	
	$pre='url_id';
	$table='news';
    $sqlchk="SELECT id,$pre FROM $table WHERE is_index IS NULL OR is_index='429' ORDER BY id DESC LIMIT 150;";
	$qchk=$conn->query($sqlchk);
	$chk_res=$qchk->fetchAll(PDO::FETCH_ASSOC);
	
    $bing_data=[];
    $bing_data['siteUrl']='https://www.turnofspeed.in';
	
	foreach($chk_res as $rs){
	    $url_id=$rs[$pre];
        $url = "https://www.turnofspeed.in/news/".$url_id.".html";
        //die();
        
	    $bing_data['urlList'][]=$url;
        
        $client = new Google_Client();
        $client->setAuthConfig("plugins/sitemap/indexing_key.json");
        $client->addScope("https://www.googleapis.com/auth/indexing");
        $httpClient = $client->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
        
        $content = "{
          \"url\": \"$url\",
          \"type\": \"URL_UPDATED\"
        }";
        
        $response = $httpClient->post($endpoint, [ 'body' => $content ]);
        $status_code = $response->getStatusCode();
        echo $status_code."<br>";
        
        $sqlup="UPDATE $table SET is_index='$status_code' WHERE id='".$rs['id']."';";
        $qup= $conn->prepare($sqlup);
        $qup->execute();
        
        /*$client = new Google_Client();
        $client->setAuthConfig("plugins/sitemap/indexing_key.json");
        $client->addScope("https://www.googleapis.com/auth/indexing");
        $httpClient = $client->authorize();
        $httpClient->get("http://www.google.com/ping?sitemap=https://www.turnofspeed.in/sitemap/sitemap_index.xml");
        die();*/
	}
	
	if(!empty($bing_data['urlList'])){
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
	}
?>