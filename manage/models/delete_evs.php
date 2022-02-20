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
		$f_flag=0;

		$sqls="SELECT cover_photo,featured_photo FROM evs WHERE id='$d_id';";
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

		if(!empty($all_files[0]['featured_photo']))
		{
			if(file_exists(ROOT_PATH.$all_files[0]['featured_photo']))
			{
				if(unlink(ROOT_PATH.$all_files[0]['featured_photo']))
				{
					$f_flag=1;
				}
			}
			else
			{
				$f_flag=1;
			}
		}
		else
		{
			$f_flag=1;
		}

		if($c_flag==1 && $f_flag==1)
		{
		  	$sql="DELETE FROM evs WHERE id='$d_id';";
			$q= $conn->prepare($sql);
			$q->execute();
			if($q->rowCount())
			{
				$_SESSION['s']="Ev Deleted Successfully !!!";
			}
			else
			{
				$_SESSION['e']="Failed To Delete Ev !!!";
			}
		}
		else
		{
			$_SESSION['e']="Failed To Delete Ev !!!";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
