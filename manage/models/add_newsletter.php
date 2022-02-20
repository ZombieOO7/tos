<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);

	if(empty($n_subject))
	{
	 	$n_subject=NULL;
	}
	else
	{
	 	$n_subject=ucwords($n_subject);
	}

	if(empty($n_content))
	{
	 	$n_content=NULL;
	}
	 
 	
 	$data=[
		":n_subject"=>$n_subject,
		":n_content"=>$n_content,
		":created_by"=>$user_id
 	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);
	//print_r($cols);die();
	try
	{	
	  	$sql="INSERT INTO newsletters ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))
		{	
			$_SESSION['s']="News-Letter Added Successfully !!!";
			header("Location:".ROOT_URL."view_newsletters.php");
		}
		else
		{
			$_SESSION['e']="Failed To Add News-Letter !!!";
			echo "<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}

?>