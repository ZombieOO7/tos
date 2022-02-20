<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);

 	 if(empty($post_name))
	 {
	 	$post_name=NULL;
	 }
	 else
	 {
	 	$post_name=ucwords($post_name);
	 }
 	
 	$data=[
 		":name"=>$post_name,
 		":created_by"=>$user_id
 	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);
	//print_r($cols);die();
	try
	{	
	  	$sql="INSERT INTO post_spec_category ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))
		{	
			$_SESSION['s']="Review Category Added Successfully !!!";
			header("Location:".ROOT_URL."view_post_category.php");
		}
		else
		{
			$_SESSION['e']="Failed To Add Review Category !!!";
			echo "<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}

?>