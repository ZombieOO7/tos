<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ROOT_PATH.'php-mailer/Exception.php';
require ROOT_PATH.'php-mailer/PHPMailer.php';
require ROOT_PATH.'php-mailer/SMTP.php';

$sql="SELECT org_name,org_pemail FROM organization;";
$query = $conn->query($sql);
$org=$query->fetchAll(PDO::FETCH_ASSOC);

$sqlm="SELECT * FROM smtp_settings;";
$qm= $conn->query($sqlm);
$smtp_settings=$qm->fetchAll(PDO::FETCH_ASSOC);

$hash_key=substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 15);

$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["cust_email"])) 
{	
	extract($_POST);
	if(filter_var($cust_email, FILTER_VALIDATE_EMAIL)) {
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
    		":hash_key"=>$hash_key,
    		":cust_name"=>$cust_name,
    		":cust_phone"=>$cust_phone,
    		":cust_email"=>$cust_email,
    		":cust_pass"=>$password,
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

				$mail = new PHPMailer(true);
				//$mail->SMTPDebug = 0
				if(!empty($smtp_settings))
				{ 
					foreach ($smtp_settings as $settigs) 
					{
						if($settigs['smtp_auth']=='1')
						{
							$mail->isSMTP();
							$mail->SMTPAuth = true;
						} 

						if(isset($settigs['smtp_host']) && !empty($settigs['smtp_host']))
						{                       
							$mail->Host = $settigs['smtp_host'];
						} 

						if(isset($settigs['smtp_user']) && !empty($settigs['smtp_user']))
						{ 					
							$mail->Username =$settigs['smtp_user']; 
						} 

						if(isset($settigs['smtp_pass']) && !empty($settigs['smtp_pass']))
						{ 
							$mail->Password = str_replace("₹","=", base64_decode($settigs['smtp_pass']));
						} 

						if(isset($settigs['smtp_layer']) && !empty($settigs['smtp_layer']))
						{
							$mail->SMTPSecure =$settigs['smtp_layer'];
						} 

						if(isset($settigs['smtp_port']) && !empty($settigs['smtp_port']))
						{
							$mail->Port =$settigs['smtp_port'];
						} 
					}

					//Recipients 
					$mail->setFrom($org[0]['org_pemail'], $org[0]['org_name']);
					$mail->addAddress(strtolower($cust_email),ucwords($cust_name));
					$mail->addReplyTo($org[0]['org_pemail'], $org[0]['org_name']);

					$mail->isHTML(true);   
					$mail->Subject = 'Registration & Verification -'.$org[0]['org_name'];
					$mail->Body = 'Dear '.$cust_name.',<br><br>Thank you for your registration.<br><br>Kindly verify your email and activate your account within 24 hours by clicking below link : <br>'.ROOT_URL_FRONT.'cust_verification.php?hash='.$hash_key.'&email='.$cust_email.'&redirect='.$redirect;
					if($mail->send())
					{
						$_SESSION['s']="Registered Successfully !!!";
						print_r(json_encode(array("status"=>true)));
					}
					else
					{
						$_SESSION['s']="Registered Successfully, Failed To Send Verification Email, Please Contact Admin !!!";
						print_r(json_encode(array("status"=>false)));
					}
				}
			}
			else
			{
				$_SESSION['e']="Failed To Registered, Please Try Again !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			$_SESSION['i']="Email Id Already Exists, Use Another Email Id !!!";
			echo"<script>history.go(-1);</script>";
			/*echo  $ex->getMessage();*/
		}
	}
}
?>