<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['s']))
{	
 	extract($_GET);
	$data=[":slider_logo"=>$s];

	try
	{	
		$sql="UPDATE organization SET slider_logo=:slider_logo;";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($s=="1")
			{
				$_SESSION['s']="Logo Slide Enabled Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Logo Slide Disabled Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_organization.php');
		}
		else
		{
			$_SESSION['e']="Failed To Enabled / Disabled Logo Slider, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
