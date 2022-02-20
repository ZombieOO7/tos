<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST['submit']))
{
	extract($_POST);
	print_r($_POST);

	$data=[
		":verify"=>"1",
		":otp"=>NULL
	];
		
	$sql="UPDATE subscribers SET verify=:verify,otp=:otp WHERE id='$s_id' AND otp=$s_otp;";
	$query= $conn->prepare($sql);
	$query->execute($data);

	if($query->rowCount())
	{
		$_SESSION['s']="Email Verified Successfully !!!";
		header("LOCATION:".ROOT_URL_FRONT."index.php");
	}
	else
	{
		$_SESSION['e']="Wrong OTP Entered !!!";
		echo "<script>history.go(-1);</script>";
	}
	
}

?>