<?php 
header("Access-Control-Allow-Origin: *");
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

/*$user_id = $_SESSION["user_id"];*/
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST['poll']) && isset($_POST['opt_id']))
{	
 	extract($_POST);

	$data=[
		":poll_id"=>$poll,
		":option_id"=>$opt_id
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

	try
	{	
		$sql="INSERT INTO poll_response ($insertCols) VALUES ($cols);";
		$q=$conn->prepare($sql);
		$q->execute($data);
		
		$sql="SELECT count(*) as total,option_id FROM poll_response WHERE poll_id='$poll' GROUP BY option_id ;";
		$query_db = $conn->query($sql);
		$results=$query_db->fetchAll(PDO::FETCH_ASSOC);	
		$sum=array_sum(array_column($results, 'total'));

		$final_data='';
		$i=0;
		$ch='A';
		foreach ($results as $result) {
			$final_data=$final_data.'<p style="margin-bottom:5px;font-family: sans-serif;"><b>'.$ch.'. </b><span style="display:inline-block;color:#fff;background-color:#b71c0c;width:'.round(($result['total']/$sum)*100,2)."%".';height: 13px"></span> <b>'.round(($result['total']/$sum)*100,2).'%</b></p>';
		    $ch++;
		}

		print_r($final_data);
		
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
