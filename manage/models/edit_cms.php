<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	if(!empty($title))
	{
		$title=ucwords($title);
	}

	if(empty($address))
	{
		$address=NULL;
	}

	if(!empty($p_phone))
	{
		$p_phone=$p_phone;
	}
	else
	{
		$p_phone=NULL;
	}

	if(!empty($s_phone))
	{
		$s_phone=strtolower($s_phone);
	}
	else
	{
		$s_phone="";
	}

	if(!empty($p_email))
	{
		$p_email=strtolower($p_email);
	}
	else
	{
		$p_email=NULL;
	}

	if(!empty($s_email))
	{
		$s_email=strtolower($s_email);
	}
	else
	{
		$s_email="";
	}

	if(!empty($content))
	{
		$content=$content;
	}
	else
	{
		$content=NULL;
	}

 
	if($c_id==1)
	{
		$data=[
			":title"=>$title,
			":content"=>json_encode(array("address"=>$address,"p_phone"=>$p_phone,"s_phone"=>$s_phone,"p_email"=>$p_email,"s_email"=>$s_email)),
			":updated_by"=>$user_id,
			":updated_at"=>$timestamp
		];
	}
	else
	{
		$data=[
			":title"=>$title,
			":content"=>$content,
			":updated_by"=>$user_id,
			":updated_at"=>$timestamp
		];
	}

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

		try
		{	
			$sql="UPDATE cms SET $up_data WHERE id='$c_id' ;";
			$q= $conn->prepare($sql);
			if($q->execute($data))	
			{	
				$_SESSION['s']="Content Updated Successfully !!!";
				header('Location:'.ROOT_URL.'view_cms.php');
			}
			else
			{
				$_SESSION['e']="Failed To Update Content !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			echo  $ex->getMessage();
		}
}
?>