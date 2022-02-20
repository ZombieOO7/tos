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
	  	$sql="DELETE FROM videos WHERE id='$d_id';";
		$q= $conn->prepare($sql);
		if($q->execute())
		{
			$_SESSION['s']="Video Deleted Successfully !!!";
		}
		else
		{
			$_SESSION['e']="Failed To Delete Video !!!";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}