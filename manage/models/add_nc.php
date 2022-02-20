<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];

if(isset($_POST["submit"])) 
{	
 	extract($_POST);

 	 if(empty($news_name))
	 {
	 	$news_name=NULL;
	 }
	 else
	 {
	 	$news_name=ucwords($news_name);
	 }
 	
 	$data=[
 		":name"=>$news_name,
 		":created_by"=>$user_id
 	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);
	//print_r($cols);die();
	try
	{	
	  	$sql="INSERT INTO news_category ($insertCols) VALUES ($cols);";
		$q= $conn->prepare($sql);
		if($q->execute($data))
		{	
			$_SESSION['s']="News Category Added Successfully !!!";
			header("Location:".ROOT_URL."view_news_category.php");
		}
		else
		{
			$_SESSION['e']="Failed To Add News Category !!!";
			echo "<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
	    echo  $ex->getMessage();
	}
}

?>