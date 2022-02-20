<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(!empty($_POST['d_id']))
{	
 	extract($_POST);

	try
	{	
		$f_flag=0;
		$c_count=0;

		$sqls="SELECT cover_photo,featured_photo FROM reviews WHERE id='$d_id';";
		$qs= $conn->query($sqls);
		$all_files=$qs->fetchAll(PDO::FETCH_ASSOC);

		if(!empty($all_files[0]['featured_photo']))
		{
			if(file_exists(ROOT_PATH.$all_files[0]['featured_photo']))
			{
				if(unlink(ROOT_PATH.$all_files[0]['featured_photo']))
				{
					$f_flag=1;
				}
			}
		}
		else
		{
			$f_flag=1;
		}

		$cover_photos=json_decode($all_files[0]['cover_photo']); 

		foreach ($cover_photos as $cp) 
		{
			if(file_exists(ROOT_PATH.$cp))
			{
				if(unlink(ROOT_PATH.$cp))
				{
					$c_count=$c_count+1;
				}
			}
		}

		if($f_flag==1 && count($cover_photos)==$c_count)
		{
		  	$sql="DELETE FROM reviews WHERE id='$d_id';";
			$q= $conn->prepare($sql);
			if($q->execute())
			{
				$_SESSION['s']="Review Deleted Successfully !!!";
			}
			else
			{
				$_SESSION['e']="Failed To Delete Review !!!";
			}
		}
		else
		{
			$_SESSION['e']="Failed To Delete Review !!!";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
