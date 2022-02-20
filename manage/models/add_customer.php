<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	if(isset($cust_name) && !empty($cust_name))
	{
		$cust_name=ucwords($cust_name);
	}

	if(!isset($cust_phone) && empty($cust_phone))
	{
		$cust_phone=NULL;
	}

	if(isset($cust_email) && !empty($cust_email))
	{
		$cust_email=strtolower($cust_email);
	}
	else
	{
		$cust_email=NULL;
	}

	if(isset($cust_pass) && !empty($cust_pass))
	{
		$password=md5($cust_pass);
	}
	else
	{
		$password=NULL;
	}


	$data=[
		":cust_name"=>$cust_name,
		":cust_phone"=>$cust_phone,
		":cust_email"=>$cust_email,
		":cust_pass"=>$password,
		":created_by"=>$created_by
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

		try
		{	
			$sql = "INSERT INTO customers ($insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);

			if($q->execute($data))	
			{	
				$sqls = "SELECT id FROM customers WHERE cust_email='$cust_email'";
				$qs= $conn->query($sqls);
				$cust_id=$qs->fetchAll(PDO::FETCH_ASSOC);
				$c_id=$cust_id[0]['id'];

				if(!empty($c_id))
				{
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

						$pro_uploadpath=$path.$c_id.".".$extension[1];
						$final_profile=str_replace(ROOT_PATH,"", $pro_uploadpath);

						copy($pro_tmpname,$pro_uploadpath);
						$sqlup = "UPDATE customers SET pic_path='$final_profile' WHERE id='$c_id';";
						$qup= $conn->prepare($sqlup);
						$qup->execute();
						
					}
				}

				$_SESSION['s']="Customer Added Successfully !!!";
				header('Location:'.ROOT_URL.'view_customers.php');
			}
			else
			{
				$_SESSION['e']="Failed To Add Customer !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			$_SESSION['i']="Email Id Already Exists !!!";
			echo"<script>history.go(-1);</script>";
			/*echo  $ex->getMessage();*/
		}
}
?>