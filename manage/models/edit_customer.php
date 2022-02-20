<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

 extract($_POST);

 	 if(empty($cust_name))
	 {
	 	$cust_name=NULL;
	 }
	 else
	 {
	 	$cust_name=ucwords($cust_name);
	 }

	 if(empty($cust_phone))
	 {
	 	$cust_phone=NULL;
	 }

	 if(empty($cust_email))
	 {
	 	$cust_email=NULL;
	 }
	 else
	 {
	 	$cust_email=strtolower($cust_email);
	 }

	 if(empty($cust_pass))
	 {
	 	$cust_pass=NULL;
	 }
	 else
	 {
	 	$cust_pass=md5($cust_pass);
	 }

	if(isset($_FILES['cust_profile']['name']) &&  !empty($_FILES['cust_profile']['name']) )
	{
		$pro_filename=$_FILES['cust_profile']['name'];
		$extension=explode(".", $pro_filename);
		$pro_tmpname=$_FILES['cust_profile']['tmp_name'];
		$pro_filesize=$_FILES['cust_profile']['size'];

		$path=ROOT_PATH."uploads/customers/";

		if (!file_exists($path))
		{
			mkdir($path,0777,true);  
		}

		$pro_uploadpath=$path.$cust_id.".".$extension[1];
		$final_profile=str_replace(ROOT_PATH,"",$pro_uploadpath);
		
		copy($pro_tmpname,$pro_uploadpath);
	}
	else
	{
		$final_profile=NULL;
	}
 	
 	if(is_null($final_profile))
 	{
	 	$data=[
		 	":cust_name"=>$cust_name,
		 	":cust_phone"=>$cust_phone,
		 	":cust_email"=>$cust_email,
		 	":cust_pass"=>$cust_pass,
		 	":updated_at"=>$timestamp,
		 	":updated_by"=>$user_id
	 	];
	}
	else
	{
		$data=[
		 	":cust_name"=>$cust_name,
		 	":cust_phone"=>$cust_phone,
		 	":cust_email"=>$cust_email,
		 	":cust_pass"=>$cust_pass,
		 	":pic_path"=>$final_profile,
		 	":updated_at"=>$timestamp,
		 	":updated_by"=>$user_id
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
	  	$sql="UPDATE customers SET $up_data WHERE id='$cust_id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{	
			$_SESSION['s']="Customer Details Updated Successfully !!!";
			header("Location:".ROOT_URL."view_one_customer.php?id=".$cust_id);
		}
		else
		{
			$_SESSION['e']="Failed To Update Customer Details !!!";
			echo "<script>history.go(-1);</script>";
		}
    
	}
	catch (PDOException $ex) 
	{
	        echo  $ex->getMessage();
	}


?> 