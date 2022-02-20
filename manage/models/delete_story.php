<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(!empty($_POST['s_id']))
{	
 	extract($_POST);

	try
	{	
		$c_flag=0;

		$sqls="SELECT cover_img FROM stories WHERE id='$s_id';";
		$qs= $conn->query($sqls);
		$all_files=$qs->fetchAll(PDO::FETCH_ASSOC);

		if(!empty($all_files[0]['cover_img']))
		{
			if(file_exists(ROOT_PATH.$all_files[0]['cover_img']))
			{
				if(unlink(ROOT_PATH.$all_files[0]['cover_img']))
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
		  	$sql="DELETE FROM stories WHERE id='$s_id';";
			$q= $conn->prepare($sql);
			if($q->execute())
			{
				$sqls = "SELECT * FROM story_items WHERE story_id='$s_id';";
				$qs= $conn->query($sqls);
				$story_ids=$qs->fetchAll();

				foreach ($story_ids as $st) {
					$sql_delete="DELETE FROM story_items WHERE id='".$st['id']."';";
					$sql_delete= $conn->prepare($sql_delete);
					$sql_delete->execute();

					unlink(ROOT_PATH.$st['image']);
				}
				
				$_SESSION['s']="News Deleted Successfully !!!";
			}
			else
			{
				$_SESSION['e']="Failed To Delete News !!!";
			}
		}
		else
		{
			$_SESSION['e']="Failed To Delete News !!!";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
