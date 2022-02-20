<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{
	extract($_POST);

	if(!empty($blog_name))
	{
		$name=$blog_name;
		$url_id=trim(str_replace(' ', '',preg_replace('/[^A-Za-z0-9-]/', ' ',str_replace(' ', '-',strtolower($blog_name)))));
	}
	else
	{
		$name=NULL;
	}

	if(!empty($blog_subhead))
	{
		$subhead=$blog_subhead;
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

	if(!empty($blog_author))
	{
		$author=ucwords($blog_author);
	}
	else
	{
		$author=NULL;
	}

	if(!empty($blog_location))
	{
		$location=ucwords($blog_location);
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

	if(!empty($blog_date))
	{
		$date=date("Y-m-d",strtotime($blog_date));
	}
	else
	{
		$date=NULL;
	}

	if(!empty($blog_content))
	{
		$content=$blog_content;
	}
	else
	{
		$content=NULL;
	}

	if(empty($blog_comment))
	{
		$blog_comment="off";
	}

	if($blog_comment=="on")
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

	$data=[
		":url_id"=>$url_id,
		":b_name"=>$name,
		":b_subhead"=>$subhead,
		":tags"=>$tags,
		":b_author"=>$author,
		":b_location"=>$location,
		":b_photo_credit"=>$photo_credit,
		":b_illustration"=>$illustration,
		":b_graphics"=>$graphics,
		":b_date"=>$date,
		":b_content"=>$content,
		":comment"=>$comment,
		":featured"=>$featured,
		":featured_title"=>$featured_title,
		":name_align"=>$align,
		":name_color"=>$color,
		":created_by"=>$user_id
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

	try
	{	
		$sql = "INSERT INTO features ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))	
		{
			$sqls = "SELECT id,b_content FROM features WHERE created_by='$user_id' ORDER BY id DESC LIMIT 1;";
			$qs= $conn->query($sqls);
			$blog_ids=$qs->fetchAll();
			$blogid=$blog_ids[0]['id'];

			if(isset($_FILES['cover_file']['name']) &&  !empty($_FILES['cover_file']['name']) )
			{
				$pro_filename=$_FILES['cover_file']['name'];
				$extension=pathinfo($pro_filename, PATHINFO_EXTENSION);
				$pro_tmpname=$_FILES['cover_file']['tmp_name'];
				$pro_filesize=$_FILES['cover_file']['size'];

				$path=ROOT_PATH."uploads/blog/";

				if (!file_exists($path))
				{
					mkdir($path,0777,true);  
				}

				$pro_uploadpath=$path.$blogid.".".$extension;
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
					$sqlup="UPDATE features SET cover_photo='$final_profile' WHERE id='$blogid';";
					$qup= $conn->prepare($sqlup);
					$qup->execute();

				}
			}

			if(isset($_FILES['featured_file']['name']) &&  !empty($_FILES['featured_file']['name']) && $is_featured=="on")
			{
				$filename=$_FILES['featured_file']['name'];
				$extension=pathinfo($filename, PATHINFO_EXTENSION);
				$tmpname=$_FILES['featured_file']['tmp_name'];
				$filesize=$_FILES['featured_file']['size'];

				$path=ROOT_PATH."uploads/blog/";

				if (!file_exists($path))
				{
					mkdir($path,0777,true);  
				}

				$uploadpath=$path."f_".$blogid.".".$extension;
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
					$sqlupf="UPDATE features SET featured_photo='$profile' WHERE id='$blogid';";
					$qupf= $conn->prepare($sqlupf);
					$qupf->execute();
				}
			}
			
			$content=$blog_ids[0]['b_content'];
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

				$file_name='content_image_'.$blogid.'_'.$i.'.'.$type;
				$path=ROOT_PATH."uploads/blog/";
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
			$update_content="UPDATE features SET b_content='$content' WHERE id='$blogid';";
			$update_content=$conn->prepare($update_content);
			$update_content->execute();
			}

			$_SESSION['s']="Feature Added Successfully !!!";
			header('Location:'.ROOT_URL.'view_blog.php');
			
		}
		else
		{
			$_SESSION['e']="Failed To Add Feature !!!";
			echo "<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}

}
?>