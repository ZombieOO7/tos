<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{
	extract($_POST);

	if(!empty($video_code))
	{
		$code=$video_code;
	}
	else
	{
		$code=NULL;
	}

	if(!empty($video_date))
	{
		$date=date("Y-m-d",strtotime($video_date));
	}
	else
	{
		$date=NULL;
	}

	if(!empty($video_title))
	{
		$title=ucwords($video_title);
	}
	else
	{
		$title=NULL;
	}

	if(!empty($tags))
	{
		$tags=ucwords($tags);
	}
	else
	{
		$tags=NULL;
	}

	if(!empty($video_author))
	{
		$author=ucwords($video_author);
	}
	else
	{
		$author=NULL;
	}

	if(!empty($video_location))
	{
		$location=ucwords($video_location);
	}
	else
	{
		$location=NULL;
	}

	if(!empty($video_desc))
	{
		$description=$video_desc;
	}
	else
	{
		$description=NULL;
	}

	if(empty($video_comment))
	{
		$video_comment="off";
	}

	if($video_comment=="on")
	{
		$comment="1";
	}
	else
	{
		$comment="0";
	}

	$data=[
		":v_code"=>$code,
		":v_date"=>$date,
		":v_title"=>$title,
		":tags"=>$tags,
		":v_author"=>$author,
		":v_location"=>$location,
		":v_description"=>$description,
		":comment"=>$comment,
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

	try
	{	
		$sql = "UPDATE videos SET $up_data WHERE id='$v_id';";
		$q= $conn->prepare($sql);
		if($q->execute($data))	
		{
			$_SESSION['s']="Video Updated Successfully !!!";
			header('Location:'.ROOT_URL.'view_videos.php');
		}
		else
		{
			$_SESSION['e']="Failed To Update Video !!!";
			echo"<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}

}
?>