<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/super_connection.php';

if(isset($_POST["submit"])) 
{	

	extract($_POST);
	$role_id="2";

	$data=[
		":role_id"=>$role_id,
		":fname"=>ucwords($fname),
		":lname"=>ucwords($lname),
		":password"=>md5($user_pass),
		":emailid"=>strtolower($user_email)
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

	try
	{	

		$sqlcopy="INSERT INTO super_employees($insertCols) VALUES ($cols);";
		$querycopy= $conn->prepare($sqlcopy);
		if($querycopy->execute($data))
		{
			$_SESSION['s']="Employee Added Successfully !!!";
			header('Location:'.ROOT_URL.'superadmin/view_super_employees.php');
		}
		else
		{
			$_SESSION['e']="Failed To Add Employee !!!";
			echo "<script>history.go(-1);</script>";
		}

	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
?>