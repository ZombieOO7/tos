<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST['submit']))
{	
 	extract($_POST);
	try
	{	
		$data=[
			":n_subject"=>$n_subject,
			":n_content"=>$n_content,
			":updated_by"=>$user_id,
			":updated_at"=>$timestamp
		];

		$columnsup="";
		$colsup=array_keys($data);
		$colsup=implode(", ",  $colsup);
		$set_data=explode(", ", $colsup);
		$u_data="";
		foreach ($set_data as $key => $value) 
		{
			$u_data=$u_data.str_replace(":", "",$value)."=".$value.",";
		}
		$up_data=rtrim($u_data,",");

	  	$sql="UPDATE newsletters SET $up_data WHERE id='$nl_id';";
		$q= $conn->prepare($sql);
		
		if($q->execute($data))
		{
			$_SESSION['s']="News-Letter Updated Successfully !!!";
			header('Location:'.ROOT_URL.'view_one_newsletter.php?id='.$nl_id);
		}
		else
		{
			$_SESSION['e']="Failed To Update News-Letter !!!";
			echo"<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}

?>
