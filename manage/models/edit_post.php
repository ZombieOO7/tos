<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{
	extract($_POST);

	if(!empty($post_name))
	{
		$name=$post_name;
	}
	else
	{
		$name=NULL;
	}

	if(!empty($post_subhead))
	{
		$subhead=$post_subhead;
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

	if(!empty($post_author))
	{
		$author=ucwords($post_author);
	}
	else
	{
		$author=NULL;
	}

	if(!empty($post_location))
	{
		$location=ucwords($post_location);
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

	if(!empty($post_date))
	{
		$date=date("Y-m-d",strtotime($post_date));
	}
	else
	{
		$date=NULL;
	}

	if(!empty($post_content))
	{
		$content=$post_content;
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
			
			$file_name='content_image_'.$p_id.'_'.$i.'.'.$type;
			$path=ROOT_PATH."uploads/posts/";
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

	if(empty($post_comment))
	{
		$post_comment="off";
	}

	if($post_comment=="on")
	{
		$comment="1";
	}
	else
	{
		$comment="0";
	}

	if(empty($is_featured))
	{
		$is_featured="off";
	}

	if($is_featured=="on")
	{
		$featured="1";
	}
	else
	{
		$featured="0";
	}

	if(empty($featured_title))
	{
		$featured_title="off";
	}

	if($featured_title=="on")
	{
		$featured_title="1";
	}
	else
	{
		$featured_title="0";
	}

	if(empty($name_align))
	{
		$name_align="off";
	}

	if($name_align=="on")
	{
		$align="1";
	}
	else
	{
		$align="0";
	}

	if(empty($name_color))
	{
		$name_color="off";
	}

	if($name_color=="on")
	{
		$color="1";
	}
	else
	{
		$color="0";
	}
	if($cover_story=="on")
	{
		$cover_story="1";
	}
	else
	{
		$cover_story="0";
	}

	$data=[
		":p_name"=>$name,
		":p_subhead"=>$subhead,
		":tags"=>$tags,
		":p_cat_id"=>$cat_id,
		":p_author"=>$author,
		":p_location"=>$location,
		":p_photo_credit"=>$photo_credit,
		":p_illustration"=>$illustration,
		":p_graphics"=>$graphics,
		":p_date"=>$date,
		":p_content"=>$content,
		":comment"=>$comment,
		":featured"=>$featured,
		":featured_title"=>$featured_title,
		":name_align"=>$align,
		":name_color"=>$color,
		":is_cover_story"=>$cover_story,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp
	];

	if(isset($_FILES['cover_file']['name'][0]) && !empty($_FILES['cover_file']['name'][0]))
 	{
 		$sqlp="SELECT cover_photo FROM reviews WHERE id='$p_id';";
		$qp=$conn->query($sqlp);
		$results=$qp->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($results[0]['cover_photo']))
		{
			$result=json_decode($results[0]['cover_photo'],true);
			foreach ($result as $res) {
				unlink(ROOT_PATH.$res);
			}
		}
        $file_name=[];
		foreach ($_FILES['cover_file']['name'] as $key=>$value) 
		{
			$pro_uploadpath="";
			$final_path="";
			$ext=pathinfo($value, PATHINFO_EXTENSION);

			$path=ROOT_PATH."uploads/posts/";
		 	if (!file_exists($path))
			{
				mkdir($path,0777,true);
			}

		 	$pro_uploadpath=$path.$p_id."_".($key+1).".".$ext;
		 	$final_path=str_replace(ROOT_PATH,"", $pro_uploadpath);

		 	$pro_filename=$_FILES['cover_file']['tmp_name'][$key];

            list($width, $height) = getimagesize($pro_filename);
            $new_width = 800;
            $percent=$new_width/$width;
            $new_height =$height*$percent;

            $image_p = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($pro_filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        	imagejpeg($image_p,$pro_uploadpath,70);

			if(file_exists($pro_uploadpath))
			{
				$file_name[]=$final_path;
			}
		}

		if(!empty($file_name))
		{
			$data[":cover_photo"]=json_encode($file_name);
		}
	}

	if(isset($_FILES['featured_file']['name']) &&  !empty($_FILES['featured_file']['name']))
	{
		$filename=$_FILES['featured_file']['name'];
		$extension=pathinfo($filename, PATHINFO_EXTENSION);
		$tmpname=$_FILES['featured_file']['tmp_name'];

		$path=ROOT_PATH."uploads/posts/";

		if (!file_exists($path))
		{
			mkdir($path,0777,true);  
		}

		$uploadpath=$path."f_".$p_id.".".$extension;
		$profile=str_replace(ROOT_PATH,"", $uploadpath);

		list($width, $height) = getimagesize($tmpname);
        $new_width = 2200;
        $percent=$new_width/$width;
        $new_height =$height*$percent;

        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($tmpname);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
		if(imagejpeg($image_p,$uploadpath,70))
		{
			$data[":featured_photo"]=$profile;
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
		$sql="UPDATE reviews SET $up_data WHERE id='$p_id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))	
		{
			$_SESSION['s']="Review Updated Successfully  !!!";
			header("LOCATION:".ROOT_URL."view_posts.php");
		}
		else
		{
			$_SESSION['e']="Failed To Update Review !!!";
			echo"<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}

}
?>