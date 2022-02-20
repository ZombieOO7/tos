<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];

$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

	if(isset($u_name) && !empty($u_name))
	{
		$name=explode(" ",$u_name);
	}

	$data=[
		":role_id"=>$u_role,
		":fname"=>ucwords($name[0]),
		":lname"=>ucwords($name[1]),
		":username"=>strtolower($u_email),
		":phone"=>$u_phone,
		":password"=>md5($u_pass),
		":created_by"=>$created_by
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

		try
		{	
			$sql = "INSERT INTO users ($insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);

			if($q->execute($data))	
			{	
				$sqls = "SELECT id FROM users WHERE username='$u_email'";
				$qs= $conn->query($sqls);
				$user_id=$qs->fetchAll(PDO::FETCH_ASSOC);
				$u_id=$user_id[0]['id'];

				if(!empty($u_id))
				{
					if(isset($_FILES['u_profile']['name']) &&  !empty($_FILES['u_profile']['name']) )
					{
						$pro_filename=$_FILES['u_profile']['name'];
						$extension=explode(".", $pro_filename);
						$pro_tmpname=$_FILES['u_profile']['tmp_name'];
						$pro_filesize=$_FILES['u_profile']['size'];

						$path=ROOT_PATH."uploads/users/";

						if (!file_exists($path))
						{
							mkdir($path,0777,true);  
						}

						$pro_uploadpath=$path.$u_id.".".$extension[1];
						$final_profile=str_replace(ROOT_PATH,"", $pro_uploadpath);

						copy($pro_tmpname,$pro_uploadpath);
						$sqlup = "UPDATE users SET pic_path='$final_profile' WHERE id='$u_id';";
						$qup= $conn->prepare($sqlup);
						$qup->execute();
					}
				}

				$_SESSION['s']="User Added Successfully !!!";
				header('Location:'.ROOT_URL.'view_users.php');
			}
			else
			{
				$_SESSION['e']="Failed To Add User !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			echo  $ex->getMessage();
		}
}
?>