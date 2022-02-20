<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	try
	{
		$sql= "UPDATE gallery SET status=:status WHERE id=:id";
		$statement= $conn->prepare($sql);
		$statement->bindValue(':status','1');
		$statement->bindValue(':id', $img_id);
		$statement->execute();

		if($statement->rowCount())
		{
			$_SESSION['s']="Image Deleted Successfully !!!";
		}
		else
		{
			$_SESSION['e']="Failed To Delete Image !!!";
		}
		header("LOCATION: ".ROOT_URL."view_gallery.php");
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}
