<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{
	extract($_POST);

	if(!empty($news_name))
	{
		$name=$news_name;
	}
	else
	{
		$name=NULL;
	}

	if(!empty($news_subhead))
	{
		$subhead=$news_subhead;
	}
	else
	{
		$subhead=NULL;
	}

	if(!empty($tags))
	{
		$tags=ucwords($tags);
	}
	else
	{
		$tags=NULL;
	}

	if(!empty($cat_id))
	{
		$cat_id=$cat_id;
	}
	else
	{
		$cat_id=NULL;
	}

	if(!empty($news_author))
	{
		$author=ucwords($news_author);
	}
	else
	{
		$author=NULL;
	}

	if(!empty($news_location))
	{
		$location=ucwords($news_location);
	}
	else
	{
		$location=NULL;
	}

	if(!empty($photo_credit))
	{
		$photo_credit=ucwords($photo_credit);
	}
	else
	{
		$photo_credit=NULL;
	}

	if(!empty($illustration))
	{
		$illustration=ucwords($illustration);
	}
	else
	{
		$illustration=NULL;
	}

	if(!empty($graphics))
	{
		$graphics=ucwords($graphics);
	}
	else
	{
		$graphics=NULL;
	}

	if(!empty($news_date))
	{
		$date=date("Y-m-d",strtotime($news_date));
	}
	else
	{
		$date=NULL;
	}

	if(!empty($news_content))
	{
		$content=$news_content;	
		$doc = new DOMDocument();
        $doc->loadHTML($content);
        $images = $doc->getElementsByTagName('img');
        $image_content=[];
        foreach ($images as $image) {
             $image_content[] = $image->getAttribute('src');
        }
		$i=1;
		if(!empty($image_content)){
		foreach($image_content as $ic){
			$data=$ic;
			if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
				$data = substr($data, strpos($data, ',') + 1);
				$type = strtolower($type[1]);
				$data = base64_decode($data);
			}
			
			$file_name='content_image_'.$n_id.'_'.$i.'.'.$type;
			$path=ROOT_PATH."uploads/news/";
			$uploadpath=$path.$file_name;
			$c_image_path=str_replace(ROOT_PATH,"", $uploadpath);
			$im = imagecreatefromstring($data);
			$width = imagesx($im);
			$height = imagesy($im);
			$newwidth = 1200;
			$percent=$newwidth/$width;
			$newheight = $height*$percent;
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			imagejpeg($thumb,$uploadpath,75);
			$include_image="REPLACE_URL".$c_image_path;
			
			$content=str_replace(addslashes($ic),$include_image,$content);
			$i++;
		}
		}
	}
	else
	{
		$content=NULL;
	}

	if(empty($news_comment))
	{
		$news_comment="off";
	}

	if($news_comment=="on")
	{
		$comment="1";
	}
	else
	{
		$comment="0";
	}

	$data=[
		":n_cat_id"=>$cat_id,
		":n_name"=>$name,
		":n_subhead"=>$subhead,
		":tags"=>$tags,
		":n_author"=>$author,
		":n_location"=>$location,
		":n_photo_credit"=>$photo_credit,
		":n_illustration"=>$illustration,
		":n_graphics"=>$graphics,
		":n_date"=>$date,
		":n_content"=>$content,
		":comment"=>$comment,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp
	];

	if(isset($_FILES['cover_file']['name']) &&  !empty($_FILES['cover_file']['name']) )
	{
		$pro_filename=$_FILES['cover_file']['name'];
		$extension=pathinfo($pro_filename, PATHINFO_EXTENSION);
		$pro_tmpname=$_FILES['cover_file']['tmp_name'];

		$path=ROOT_PATH."uploads/news/";

		if (!file_exists($path))
		{
			mkdir($path,0777,true);
		}

		$pro_uploadpath=$path.$n_id.".".$extension;
		$final_profile=str_replace(ROOT_PATH,"", $pro_uploadpath);

		list($width, $height) = getimagesize($pro_tmpname);
        $new_width = 800;
        $percent=$new_width/$width;
        $new_height =$height*$percent;

        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($pro_tmpname);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

		if(imagejpeg($image_p,$pro_uploadpath,70))
		{
			$data[":cover_photo"]=$final_profile;
		}
	}

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
		$sql="UPDATE news SET $up_data WHERE id='$n_id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))	
		{
			$_SESSION['s']="News Updated Successfully  !!!";
			header("LOCATION:".ROOT_URL."view_news.php");
		}
		else
		{
			$_SESSION['e']="Failed To Update News !!!";
			echo"<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}

}
?>