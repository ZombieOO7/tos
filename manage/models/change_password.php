<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);

	$oldpass=md5($oldpass);

	$data=[":password"=>md5($newpass)];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	//print_r($cols);die();
	try
	{	
	  	$sql="UPDATE users SET password=:password WHERE id='$user_id' AND password='$oldpass';";
		$q= $conn->prepare($sql);

		if($q->execute($data))
		{	
			session_destroy();
			session_start();
			$_SESSION['s']="Password Changed Successfully, Please Login With New Password !!!";
			header('Location:'.ROOT_URL.'index.php');
		}
		else
		{
			$_SESSION['e']="Failed To Change Password !!!";
			echo"<script>history.go(-1);</script>";
		}
    
	}
	catch (PDOException $ex) 
	{
	        echo  $ex->getMessage();
	}
}
