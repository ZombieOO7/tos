<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
include_once ROOT_PATH.'functions/mac_ip_mapping.php';
$cmi=json_encode(array($mac=>$ip));
$timestamp = date("Y-m-d H:i:s");

extract($_POST);

$sql1="SELECT * FROM users WHERE username='$username'";
$query1=$conn->query($sql1);
$results1=$query1->fetchAll(PDO::FETCH_ASSOC);

	if(!empty($results1))
	{
		$password=md5($password);

		if($captcha==$Ucaptcha)
		{
			if(isset($remember) && !empty($remember))
			{	
				$sqlcheck="SELECT * FROM users WHERE username='$username' AND password ='$password';";
				$qcheck = $conn->query($sqlcheck);
				$results=$qcheck->fetchAll(PDO::FETCH_ASSOC);
				$login_count=count($results);

				if(!empty($results))
				{
					if($login_count==1)
					{
					    $data=[
                    		":user_id"=>$results[0]['id'],
                    		":ip_address"=>$_SERVER['REMOTE_ADDR']
                    	];
                    
                    	$columns="";
                    	$cols=array_keys($data);
                    	$cols=implode(", ",  $cols);
                    	$insertCols=str_replace(":", "", $cols);
                    
                        $sql = "INSERT INTO login_history ($insertCols) VALUES ($cols);";
            			$q= $conn->prepare($sql);
            			$q->execute($data);
            			
						$_SESSION["user_id"] =$results[0]['id'];
						$_SESSION["user_role"] =$results[0]['role_id'];
						$_SESSION["username"] =$results[0]['fname'].' '.$results[0]['lname'];
						$_SESSION["user_name"] = $results[0]['username'];
						$_SESSION["pic_path"] =$results[0]['pic_path'];

						header('Location:'.ROOT_URL.'home.php');
					}
					else
					{	
						session_destroy();
						session_start();
						$_SESSION['i']="Two Logins At Same Window, Logout One & Pleases Try Again!!!";
						header('Location:'.ROOT_URL.'index.php');
						die();
					}
				}
				else
				{
					$_SESSION['e']="Wrong password entered !!!";
					header('Location:'.ROOT_URL.'index.php');
					die();
				}

			}
		}
		else
		{
			$_SESSION['e']="Wrong Captcha Entered !!!";
			header('Location:'.ROOT_URL.'index.php');
			die();
		}
	}
	else
	{
		$_SESSION['e']="Username Not Exist !!!";
		header('Location:'.ROOT_URL.'index.php');
		die();
	}



?>