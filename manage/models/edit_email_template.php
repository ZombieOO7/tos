<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);
 	/*print_r($_POST);die();*/

 	$data=[
 		":tmp_subject"=>$tmp_sub,
 		":tmp_content"=>$tmp_content,
 		":is_active"=>$is_active
 	];

$columns="";
$cols=array_keys($data);
$cols=implode(", ",  $cols);
$insertCols=str_replace(":", "", $cols);
//print_r($cols);die();
	try
	{	

	  	$sql="UPDATE email_templates SET tmp_subject=:tmp_subject, tmp_content=:tmp_content,is_active=:is_active WHERE id='$temp_id';";
		$q= $conn->prepare($sql);

		if($q->execute($data))
		{	
			$_SESSION['s']="Email Template Updated Successfully !!!";
			header('Location:'.ROOT_URL.'view_email_templates.php');
		}
		else
		{
			$_SESSION['e']="Failed To Update Email Template !!!";
			echo"<script>history.go(-1);</script>";
		}
    
	}
	catch (PDOException $ex) 
	{
	        echo  $ex->getMessage();
	}
}

?>