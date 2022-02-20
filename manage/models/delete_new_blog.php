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
		$c_flag=0;

		$sqls="SELECT cover_photo FROM articles WHERE id='$d_id';";
		$qs= $conn->query($sqls);
		$all_files=$qs->fetchAll(PDO::FETCH_ASSOC);

		if(!empty($all_files[0]['cover_photo']))
		{
			if(file_exists(ROOT_PATH.$all_files[0]['cover_photo']))
			{
				if(unlink(ROOT_PATH.$all_files[0]['cover_photo']))
				{
					$c_flag=1;
				}
			}
			else
			{
				$c_flag=1;
			}
		}
		else
		{
			$c_flag=1;
		}

		if($c_flag==1)
		{
		  	$sql="DELETE FROM articles WHERE id='$d_id';";
			$q= $conn->prepare($sql);
			if($q->execute())
			{
				$_SESSION['s']="Blog Deleted Successfully !!!";
			}
			else
			{
				$_SESSION['e']="Failed To Delete Blog !!!";
			}
		}
		else
		{
			$_SESSION['e']="Failed To Delete Blog !!!";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
