<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST['id']) && isset($_POST['otp']) )
{
	extract($_POST);
		
	$sql="SELECT id FROM subscribers WHERE id='$id' AND otp='$otp';";
	$query= $conn->query($sql);
	$results=$query->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($results[0]['id']))
	{
		print_r(json_encode(array("status"=>true)));
	}
	else
	{
		print_r(json_encode(array("status"=>false)));
	}
	
}

?>