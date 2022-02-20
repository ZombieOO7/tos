<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");
$fname = date("YmdHis");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	$url_id=trim(str_replace(' ', '',preg_replace('/[^A-Za-z0-9-]/', ' ',str_replace(' ', '-',strtolower($name)))));

	$data=[
		":url"=>$url_id,
		":name"=>$name,
	 	":created_by"=>$user_id
 	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);
 	
 	$all_data2=[];

 	foreach ($_FILES['all_data'] as $key => $value) {
 		$i=0;
 		foreach ($value as $value2) {
 			$all_data2[$i]['data']=$all_data[$i];
 			$all_data2[$i][$key]=$value2['img'];

 			$i++;
 		}
 	}
 	
 	try
	{	
		$sql = "INSERT INTO stories ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))	
		{
			$sqls = "SELECT id FROM stories WHERE created_by='$user_id' ORDER BY id DESC LIMIT 1;";
			$qs= $conn->query($sqls);
			$story_ids=$qs->fetchAll();
			$storyid=$story_ids[0]['id'];

			if(isset($_FILES['cover_img']['name']) &&  !empty($_FILES['cover_img']['name']) )
			{
				$pro_filename=$_FILES['cover_img']['name'];
				$extension=pathinfo($pro_filename, PATHINFO_EXTENSION);
				$pro_tmpname=$_FILES['cover_img']['tmp_name'];
				$pro_filesize=$_FILES['cover_img']['size'];

				$path=ROOT_PATH."uploads/story/";

				if (!file_exists($path))
				{
					mkdir($path,0755,true);  
				}

				$pro_uploadpath=$path.$storyid."-cover.".$extension;
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
					$sqlup="UPDATE stories SET cover_img='$final_profile' WHERE id='$storyid';";
					$qup= $conn->prepare($sqlup);
					$qup->execute();
				}
			}

			if (!empty($all_data2)) {
				$i=1;
				foreach ($all_data2 as $key=>$value) 
				{
					if (!empty($value['name'])) 
					{
						$uploadpath="";
						$final_path="";
						$ext=[];
						$ext=explode(".", $value['name']);

						$path=ROOT_PATH."uploads/story/";
					 	if (!file_exists($path))
						{
							mkdir($path,0777,true);
						}

					 	$uploadpath=$path.$fname."-".($key+1).".".$ext[1];
					 	$final_path=str_replace(ROOT_PATH,"", $uploadpath);

					 	$filename=$value['tmp_name'];

			            list($width, $height) = getimagesize($filename);
			            $new_width = 1000;
			            $percent=$new_width/$width;
			            $new_height =$height*$percent;

			            $image_p = imagecreatetruecolor($new_width, $new_height);
			            $image = imagecreatefromjpeg($filename);
			            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

			        	imagejpeg($image_p,$uploadpath,100);

						if(file_exists($uploadpath))
						{
							$datai=[
								":story_id"=>$storyid,
								":image"=>$final_path,
								":animation"=>$value['data']['animation'],
								":title"=>$value['data']['title'],
								":description"=>$value['data']['description'],
								":link"=>$value['data']['link']
							];

							$colsi=$insertColsi="";
							$colsi=implode(", ",  array_keys($datai));
							$insertColsi=str_replace(":", "", $colsi);

							$sqlqi="INSERT INTO story_items ($insertColsi) VALUES ($colsi);";
							$qqi= $conn->prepare($sqlqi);
							$qqi->execute($datai);
							unset($datai);
						}
						$i++;
					}
				}
			}
		}

		$_SESSION['s']="Story Updated Successfully !!!";
		header('Location:'.ROOT_URL.'view_stories.php');
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
	
}
?>