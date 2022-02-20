<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$timestamp = date("Y-m-d H:i:s");
print_r($_POST);die();
if(isset($_POST["submit"])) 
{
	extract($_POST);

	if(!empty($i_name))
	{
		$i_name=ucwords($i_name);
	}
	else
	{
		$i_name=NULL;
	}

	if(empty($i_phone))
	{
		$i_phone=NULL;
	}

	if(!empty($i_email))
	{
		$i_email=strtolower($i_email);
	}
	else
	{
		$i_email=NULL;
	}

	if(!empty($i_subject))
	{
		$i_subject=ucwords($i_subject);
	}
	else
	{
		$i_subject=NULL;
	}

	if(!empty($i_description))
	{
		$i_description=ucwords($i_description);
	}
	else
	{
		$i_description=NULL;
	}


	$data=[
		":i_name"=>$i_name,
		":i_phone"=>$i_phone,
		":i_email"=>$i_email,
		":i_subject"=>$i_subject,
		":i_description"=>$i_description,
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

	try
	{	
		$sql = "INSERT INTO inquiries ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))	
		{
			print_r(json_encode(array('status' =>true)));
		}
		else
		{
			print_r(json_encode(array('status' =>false)));
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}

}
?>