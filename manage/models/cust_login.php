<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
include_once ROOT_PATH.'functions/mac_ip_mapping.php';
$cmi=json_encode(array($mac=>$ip));
$timestamp = date("Y-m-d H:i:s");

extract($_POST);

$sql1="SELECT * FROM customers WHERE cust_email='$cust_email'";
$query1=$conn->query($sql1);
$results1=$query1->fetchAll(PDO::FETCH_ASSOC);

	if(!empty($results1))
	{
		$cust_pass=md5($cust_pass);

		$sqlcheck="SELECT * FROM customers WHERE cust_email='$cust_email' AND cust_pass='$cust_pass';";
		$qcheck = $conn->query($sqlcheck);
		$results=$qcheck->fetchAll(PDO::FETCH_ASSOC);
		$login_count=count($results);
		
		if(!empty($results))
		{
			if($login_count==1)
			{	
				$_SESSION["user_id"] =$results[0]['id'];
				$_SESSION["username"] =$results[0]['cust_name'];
				$_SESSION["user_email"] = $results[0]['cust_email'];
				$_SESSION["pic_path"] =$results[0]['pic_path'];
				$_SESSION['s']="Successfully Logged In";
				print_r(json_encode(array("status"=>true)));
			}
			else
			{	
				session_destroy();
				session_start();
				$_SESSION['i']="Two Logins At Same Window, Logout One & Pleases Try Again !!!";
				print_r(json_encode(array("status"=>false)));
			}
		}
		else
		{
			$_SESSION['e']="Wrong Password Entered !!!";
			print_r(json_encode(array("status"=>false)));
		}
	}
	else
	{
		$_SESSION['e']="Username Not Exist, Please Register !!!";
		print_r(json_encode(array("status"=>false)));
	}
?>