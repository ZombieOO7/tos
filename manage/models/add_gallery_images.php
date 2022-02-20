<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

 	if(!empty($_FILES['gallery_file']['name']))
 	{
	 	try
		{	
			$file_names=[];

			foreach ($_FILES['gallery_file']['name'] as $key=>$value) 
			{
				$uploadpath="";
				$final_path="";
				$ext=[];
				$ext=explode(".", $_FILES['gallery_file']['name'][$key]);

				$path=ROOT_PATH."uploads/gallery/";
			 	if (!file_exists($path))
				{
					mkdir($path,0777,true);
				}

			 	$uploadpath=$path.($key+1).".".$ext[1];
			 	$final_path=str_replace(ROOT_PATH,"", $uploadpath);

			 	$filename=$_FILES['gallery_file']['tmp_name'][$key];

	            list($width, $height) = getimagesize($filename);
	            $new_width = 800;
	            $percent=$new_width/$width;
	            $new_height =$height*$percent;

	            $image_p = imagecreatetruecolor($new_width, $new_height);
	            $image = imagecreatefromjpeg($filename);
	            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	        	imagejpeg($image_p,$uploadpath,70);

				if(file_exists($uploadpath))
				{
					$file_names[]=$final_path;
				}
			}

			foreach($file_names as $fname)
			{
				$sqli="INSERT INTO gallery (img_path,created_by) VALUES ('$fname','$user_id');";
				$qi= $conn->prepare($sqli);
				$qi->execute();
			}

			$_SESSION['s']="Images Updated Successfully !!!";
			header('Location:'.ROOT_URL.'view_gallery.php');
		}
		catch (PDOException $ex) 
		{
		    echo  $ex->getMessage();
		}
	}
	else
	{
		$_SESSION['i']="Please Select Files To Upload !!!";
		echo"<script>history.go(-1);</script>";
	}	
}
?>