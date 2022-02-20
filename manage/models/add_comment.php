<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	if(empty($cust_id))
	{
		$cust_id=NULL;
	}

	if(empty($post_id))
	{
		$post_id=NULL;
	}

	if(empty($blog_id))
	{
		$blog_id=NULL;
	}

	if(empty($news_id))
	{
		$news_id=NULL;
	}

	if(empty($video_id))
	{
		$video_id=NULL;
	}

	if(empty($ev_id))
	{
		$ev_id=NULL;
	}

	if(empty($comment))
	{
		$comment=NULL;
	}


	$data=[
		":cust_id"=>$cust_id,
		":post_id"=>$post_id,
		":blog_id"=>$blog_id,
		":news_id"=>$news_id,
		":video_id"=>$video_id,
		":ev_id"=>$ev_id,
		":comment"=>$comment,
		":created_by"=>$created_by
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

		try
		{	
			$sql = "INSERT INTO comments ($insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);

			if($q->execute($data))	
			{	
				$_SESSION['s']="Comment Added Successfully !!!";
				header('Location:'.ROOT_URL.'view_comments.php');
			}
			else
			{
				$_SESSION['e']="Failed To Add Comment !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			echo  $ex->getMessage();
		}
}
?>