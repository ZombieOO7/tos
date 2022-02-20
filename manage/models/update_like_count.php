<?php 
header("Access-Control-Allow-Origin: *");
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

/*$user_id = $_SESSION["user_id"];*/
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST['n_id']) || isset($_POST['r_id']) || isset($_POST['f_id']) || isset($_POST['a_id']) || isset($_POST['ev_id']))
{	
 	extract($_POST);

 	if (!empty($_COOKIE["cust_hash"])) {
		$cust_hash=$_COOKIE["cust_hash"];
	}
	else{
		function uniquecode()
		{
			$uni_code="";
			$permitted_chars='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$uni_code=substr(str_shuffle($permitted_chars), 0,10);
			return $uni_code;
		}

		$cust_hash= uniquecode();
		
		setcookie('cust_hash',$cust_hash,time()+31536000,'/','',false,true);
	}

 	if (empty($r_id)) {
 		$r_id=NULL;
 	}

 	if (empty($n_id)) {
 		$n_id=NULL;
 	}

 	if (empty($f_id)) {
 		$f_id=NULL;
 	}

 	if (empty($a_id)) {
 		$a_id=NULL;
 	}

 	if (empty($ev_id)) {
 		$ev_id=NULL;
 	}

	$data=[
		":cust_hash"=>$cust_hash,
		":news_id"=>$n_id,
		":review_id"=>$r_id,
		":feature_id"=>$f_id,
		":article_id"=>$a_id,
		":ev_id"=>$ev_id
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

	try
	{	
		$sql="INSERT INTO like_section ($insertCols) VALUES ($cols);";
		$q=$conn->prepare($sql);
		if ($q->execute($data)) {
			if (!empty($n_id)) {
				$sqlup="UPDATE news SET likes=(likes+1) WHERE id='$n_id';";
				$sqlup=$conn->prepare($sqlup);
				$sqlup->execute();	
			}

			if (!empty($r_id)) {
				$sqlup="UPDATE reviews SET likes=(likes+1) WHERE id='$r_id';";
				$sqlup=$conn->prepare($sqlup);
				$sqlup->execute();	
			}

			if (!empty($f_id)) {
				$sqlup="UPDATE features SET likes=(likes+1) WHERE id='$f_id';";
				$sqlup=$conn->prepare($sqlup);
				$sqlup->execute();	
			}

			if (!empty($a_id)) {
				$sqlup="UPDATE articles SET likes=(likes+1) WHERE id='$a_id';";
				$sqlup=$conn->prepare($sqlup);
				$sqlup->execute();	
			}

			if (!empty($ev_id)) {
				$sqlup="UPDATE evs SET likes=(likes+1) WHERE id='$ev_id';";
				$sqlup=$conn->prepare($sqlup);
				$sqlup->execute();	
			}

			echo "1";
		}
		else{
			echo "2";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
else{
	echo "3";
}
