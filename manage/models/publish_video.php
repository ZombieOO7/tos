<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['id'])) 
{	
 	extract($_GET);

	$data=[
		":publish"=>$st,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp
	];

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
		$sql="UPDATE videos SET $up_data WHERE id='$id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($st=="1")
			{
				$_SESSION['s']="Video Published Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Video Un-published Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_videos.php');
		}
		else
		{
			$_SESSION['e']="Failed To Published / Un-published Video, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
