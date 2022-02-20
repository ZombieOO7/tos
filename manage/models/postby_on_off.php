<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['s']))
{	
 	extract($_GET);
	$data=[":post_by"=>$s];

	try
	{	
		$sql="UPDATE organization SET post_by=:post_by;";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($s=="1")
			{
				$_SESSION['s']="Post By Enabled Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Post By Disabled Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_organization.php');
		}
		else
		{
			$_SESSION['e']="Failed To Enabled / Disabled Post By, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
