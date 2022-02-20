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

/*$user_id = $_SESSION["user_id"];*/

if(isset($_POST["s_name"]) && isset($_POST["s_email"])) 
{	
	$otp=mt_rand(100000,999999);
 	extract($_POST);
 	
 	if(filter_var($s_email, FILTER_VALIDATE_EMAIL)) {

    	if(empty($s_name))
    	{
    	 	$s_name=NULL;
    	}
    	else
    	{
    	 	$s_name=ucwords($s_name);
    	}
    
    	if(empty($s_email))
    	{
    	 	$s_email=NULL;
    	}
    	else
    	{
    		$s_email=strtolower($s_email);
    	}
    	 
     	
     	$data=[
     		":otp"=>$otp,
    		":s_name"=>$s_name,
    		":s_email"=>$s_email
     	];
    
    	$columns="";
    	$cols=array_keys($data);
    	$cols=implode(", ",  $cols);
    	$insertCols=str_replace(":", "", $cols);
    	//print_r($cols);die();
    	try
    	{	
    
    		$sqlss="SELECT id FROM subscribers WHERE s_email='$s_email';";
    		$qss= $conn->query($sqlss);
    		$exists=$qss->fetchAll(PDO::FETCH_ASSOC);
    		if(empty($exists[0]['id']))
    		{
    		  	$sql="INSERT INTO subscribers ($insertCols) VALUES ($cols);";
    			$q= $conn->prepare($sql);
    			if($q->execute($data))
    			{	
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
    					$mail->addAddress($s_email,$s_name);
    					$mail->addReplyTo($org[0]['org_pemail'], $org[0]['org_name']);
    
    					$mail->isHTML(true);   
    					$mail->Subject =$org[0]['org_name'].'- News-Letter Subscribtion Verification';
    					$mail->Body = 'Dear '.$s_name.',<br><br>Thank you for your registration.<br><br>Kindly verify your email using below OTP :'.$otp;
    					if($mail->send())
    					{
    						$sqls="SELECT id FROM subscribers WHERE s_email='$s_email';";
    						$qs= $conn->query($sqls);
    						$ids=$qs->fetchAll(PDO::FETCH_ASSOC);
    
    						print_r(json_encode(array("status"=>true,"s_id"=>$ids[0]['id'],"msg"=>"Registered Successfully, please verify using OTP Sent to your registered email !!!")));
    					}
    					else
    					{
    						print_r(json_encode(array("status"=>false,"msg"=>"Registered Successfully, Failed To Send OTP Email, Please Contact Admin !!!")));
    					}
    				}
    			}
    			else
    			{
    				$_SESSION['e']="Failed To Subscribe News-Letter !!!";
    				echo "<script>history.go(-1);</script>";
    			}
    		}
    		else
    		{
    			print_r(json_encode(array("status"=>false,"msg"=>"Email Id Already Exists, Please Try Another !!!")));
    		}
    
    	}
    	catch (PDOException $ex) 
    	{
    	    echo  $ex->getMessage();
    	}
 	}
}

?>