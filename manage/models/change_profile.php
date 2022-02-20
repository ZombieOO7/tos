<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);

 	if(isset($_FILES))
 	{
		$filename=$_FILES['profile']['name'];
		$extension=explode(".", $filename);
		$tmpname=$_FILES['profile']['tmp_name'];
		$filesize=$_FILES['profile']['size'];
		$path=ROOT_PATH."uploads/".$_SESSION['org_id']."/users/";

		if (!file_exists($path))
		{
			mkdir($path,0777,true);  
		}
		$uploadpath=$path.$_SESSION['user_id'].".".$extension[1];
		$final_profile=str_replace(ROOT_PATH,"", $uploadpath);

		copy($tmpname,$uploadpath);
				 		 	
 	}

	$data=[ ":pic_path"=>$final_profile];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	//print_r($cols);die();

	try
	{	

	  	$sql="UPDATE users SET pic_path=:pic_path WHERE id='$user_id';";
		$q= $conn->prepare($sql);

		if($q->execute($data))
		{	
			session_destroy();
			session_start();
			$_SESSION['s']="Profile Changed Successfully !!!";
			header('Location:'.ROOT_URL.'index.php');
		}
		else
		{
			$_SESSION['e']="Failed To Change Profile !!!";
			echo"<script>history.go(-1);</script>";
		}
    
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
