<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$timestamp=date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	

 extract($_POST);
 //print_r($_POST);

 	if(isset($_FILES['org_logo']['name']) && !empty($_FILES['org_logo']['name']))
 	{

 		$fileName=$_FILES['org_logo']['name'];
 		$extension=explode(".", $fileName);
 		$file_tmp=$_FILES['org_logo']['tmp_name'];
 		$fileSize=$_FILES['org_logo']['size'];
 		$path=ROOT_PATH."uploads/";
 		$firstPath=$path."logo".".".$extension[1];
 		$final_path=str_replace(ROOT_PATH,"", $firstPath);

		if (!file_exists($path))
		{
			mkdir($path,0777,true);  
		}

 		if(copy($file_tmp,$firstPath))
 		{
			$sqllogo = "UPDATE organization SET org_logo='$final_path';";
			$qlogo= $conn->prepare($sqllogo);
			$qlogo->execute();
 		}
 	}

 		if(empty($org_semail)){
 			$org_semail=NULL;
 		}

 		if(empty($org_sphone)){
 			$org_sphone=NULL;
 		}

 		if(empty($org_cin)){
 			$org_cin=NULL;
 		}

 		if(empty($org_llpin)){
 			$org_llpin=NULL;
 		}

 		if(empty($org_url))
 		{
 			$org_url= NULL;
 		}
 		else
 		{
 			$org_url=str_replace("www.", "", str_replace("http://", "", str_replace("https://", "", $org_url)));
 		}

 		$data=[
 			":org_name"=>ucwords($org_name),
 			":org_cpname"=>ucwords($org_cpname),
 			":org_pemail"=>$org_pemail,
 			":org_semail"=>$org_semail,
 			":org_pphone"=>$org_pphone,
 			":org_sphone"=>$org_sphone,
 			":org_country"=>$org_country,
 			":org_state"=>$org_state,
 			":org_address"=>ucwords($org_address),
 			":org_pin"=>$org_pin,
 			":org_gstno"=>strtoupper($gstcode.$org_gstno),
 			":org_cin"=>strtoupper($org_cin),
 			":org_llpin"=>strtoupper($org_llpin),
 			":org_url"=>$org_url
 		];

 		$columns="";
 		$cols=array_keys($data);
 		$cols=implode(", ",  $cols);
 		try
 		{	
 			$sql = "UPDATE organization SET org_name=:org_name,
 			org_cpname=:org_cpname,
 			org_pemail=:org_pemail,
 			org_semail=:org_semail,
 			org_pphone=:org_pphone,
 			org_sphone=:org_sphone,
 			org_country=:org_country,
 			org_state=:org_state,
 			org_address=:org_address,
 			org_pin=:org_pin,
 			org_gstno=:org_gstno,
 			org_cin=:org_cin,
 			org_llpin=:org_llpin,
 			org_url=:org_url;";
 			$q= $conn->prepare($sql);

 			if($q->execute($data))
 			{	
 				$_SESSION['s']="Organization Details Updated Successfully !!!";
 				header('Location:'.ROOT_URL.'view_organization.php');
 			}
 			else
 			{
 				$_SESSION['e']="Failed To Update Organization Details !!!";
 				echo"<script>history.go(-1);</script>";
 			}
 			
 		}
 		catch (PDOException $ex) 
 		{
 			echo  $ex->getMessage();
 		}

}

?>