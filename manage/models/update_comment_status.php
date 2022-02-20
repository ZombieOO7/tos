<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['cm_id'])) 
{	
 	extract($_GET);

	$data=[
		":is_approved"=>$st,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp
	];

	try
	{	
		$sql="UPDATE comments SET is_approved=:is_approved,
								  updated_by=:updated_by,
								  updated_at=:updated_at WHERE id='$cm_id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($st=="1")
			{
				$_SESSION['s']="Comment Approved Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Comment Disapproved Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_comments.php');
		}
		else
		{
			$_SESSION['e']="Failed To Approve / Disapprove Comment, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
