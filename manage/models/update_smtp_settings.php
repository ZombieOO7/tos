<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$timestamp = date("Y-m-d H:i:s");

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);
 	
 		$smtp_pass=base64_encode($smtp_pass);
 		$smtp_pass=str_replace("=","₹", $smtp_pass);

 	$data=[
	 	":smtp_auth"=>$smtp_auth,
	 	":smtp_host"=>strtolower($smtp_host),
	 	":smtp_user"=>strtolower($smtp_user),
	 	":smtp_pass"=>$smtp_pass,
	 	":smtp_layer"=>$smtp_layer,
	 	":smtp_port"=>$smtp_port,
	 	":updated_by"=>$user_id,
	 	":updated_at"=>$timestamp
 	];

$columns="";
$cols=array_keys($data);
$cols=implode(", ",  $cols);
$insertCols=str_replace(":", "", $cols);
//print_r($cols);die();
	try
	{	
		if(!empty($ss_id))
		{
		  	$sql="UPDATE smtp_settings SET smtp_auth=:smtp_auth,
										 	smtp_host=:smtp_host,
										 	smtp_user=:smtp_user,
										 	smtp_pass=:smtp_pass,
										 	smtp_layer=:smtp_layer,
										 	smtp_port=:smtp_port,
										 	updated_by=:updated_by,
										 	updated_at=:updated_at WHERE id='$ss_id';";
			$q= $conn->prepare($sql);

			if($q->execute($data))
			{	
				$_SESSION['s']="SMTP Settings Updated Successfully !!!";
				header('Location:'.ROOT_URL.'view_smtp_settings.php');
			}
			else
			{
				$_SESSION['e']="Failed To Update SMTP Settings !!!";
				echo"<script>history.go(-1);</script>";
			}
    	}
    	else
    	{
    		$sql="INSERT INTO smtp_settings (insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);

			if($q->execute($data))
			{	
				$_SESSION['s']="SMTP Settings Added Successfully !!!";
				header('Location:'.ROOT_URL.'view_smtp_settings.php');
			}
			else
			{
				$_SESSION['e']="Failed To Add SMTP Settings !!!";
				echo"<script>history.go(-1);</script>";
			}
    	}
	}
	catch (PDOException $ex) 
	{
	        echo  $ex->getMessage();
	}
}

?>