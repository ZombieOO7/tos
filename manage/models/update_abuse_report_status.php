<?php 
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$user_id = $_SESSION["user_id"];
$timestamp = date("Y-m-d H:i:s");

if(isset($_GET['ar_id'])) 
{	
 	extract($_GET);

	$data=[
		":status"=>$st,
		":updated_by"=>$user_id,
		":updated_at"=>$timestamp
	];

	try
	{	
		$sql="UPDATE comments SET status=:status,
								  updated_by=:updated_by,
								  updated_at=:updated_at WHERE id='$ar_id';";
		$q=$conn->prepare($sql);
		if($q->execute($data))
		{
			if($st=="1")
			{
				$_SESSION['s']="Report Checked Successfully !!!";
			}
			else
			{
				$_SESSION['s']="Report Unchecked Successfully !!!";
			}
			header('Location:'.ROOT_URL.'view_abuse_reports.php');
		}
		else
		{
			$_SESSION['e']="Failed To Check / Uncheck Report, Please Try Again !!!";
			echo"<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
