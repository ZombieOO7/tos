<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$timestamp = date("Y-m-d H:i:s");
$updated_by=$_SESSION['user_id'];

if(!empty($_POST["u_id"]))
{
	extract($_POST);
	
	try
	{
		$sql= "UPDATE users SET status=:status WHERE id=:id";
		$statement= $conn->prepare($sql);
		$statement->bindValue(':status','1');
		$statement->bindValue(':id', $u_id);
		$statement->execute();
		if($statement->rowCount())
		{
			$_SESSION['s']="User Deleted Successfully !!!";
		}
		else
		{
			$_SESSION['e']="Failed To Delete User !!!";
		}
		
	}
	catch (PDOException $ex)
	{ 
	    echo  $ex->getMessage(); 
	}
}
else
{
	$_SESSION['i']="Can Not Delete User !!!";
	echo "<script>history.go(-1);</script>";
}
