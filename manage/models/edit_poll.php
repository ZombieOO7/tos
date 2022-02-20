<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);
	print_r($_POST);

	if(isset($poll_question) && !empty($poll_question))
	{
		$question=$poll_question;
	}

	if(isset($from_date) && !empty($from_date))
	{
		$from_date=date("Y-m-d",strtotime($from_date));
	}
	else
	{
		$from_date=NULL;
	}

	if(isset($to_date) && !empty($to_date))
	{
		$to_date=date("Y-m-d",strtotime($to_date));
	}
	else
	{
		$to_date=NULL;
	}


	if(isset($poll_ans1) && !empty($poll_ans1))
	{
		$poll_ans1=$poll_ans1;
	}
	else
	{
		$poll_ans1=NULL;
	}

	if(isset($poll_ans2) && !empty($poll_ans2))
	{
		$poll_ans2=$poll_ans2;
	}
	else
	{
		$poll_ans2=NULL;
	}

	if(isset($poll_ans3) && !empty($poll_ans3))
	{
		$poll_ans3=$poll_ans3;
	}
	else
	{
		$poll_ans3=NULL;
	}

	if(isset($poll_ans4) && !empty($poll_ans4))
	{
		$poll_ans4=$poll_ans4;
	}
	else
	{
		$poll_ans4=NULL;
	}

	$data=[
		":question"=>$question,
		":from_date"=>$from_date,
		":to_date"=>$to_date,
		":updated_at"=>$timestamp
	];

	$u_data="";
	$up_data="";
	$set_data=explode(", ",implode(", ", array_keys($data)));
	foreach ($set_data as $key => $value) 
	{
		$u_data=$u_data.str_replace(":", "",$value)."=".$value.",";
	}
	$up_data=rtrim($u_data,",");

	try
	{	
		$sql="UPDATE polls SET $up_data WHERE id='$p_id';";
		$q= $conn->prepare($sql);
		if($q->execute($data))	
		{	
			if(!empty($p_id))
			{
				if(!empty($opt1))
				{
				    $data1=[
                		":options"=>$poll_ans1
                	];
					$sqlpo1="UPDATE poll_options SET options=:options WHERE id='$opt1' AND poll_id='$p_id';";
					$qpo1=$conn->prepare($sqlpo1);
					$qpo1->execute($data1);
				}

				if(!empty($opt2))
				{
				    $data2=[
                		":options"=>$poll_ans2
                	];
					$sqlpo2="UPDATE poll_options SET options=:options WHERE id='$opt2' AND poll_id='$p_id';";
					$qpo2=$conn->prepare($sqlpo2);
					$qpo2->execute($data2);
				}

				if(empty($opt3) && !empty($poll_ans3))
				{
				    $data3=[
				        ":poll_id"=>$p_id,
                		":options"=>$poll_ans3
                	];
                	$columns3="";
                	$cols3=array_keys($data3);
                	$cols3=implode(", ",  $cols3);
                	$insertCols3=str_replace(":", "", $cols3);
                	
					$sqlpo3="INSERT INTO poll_options($insertCols3) VALUES ($cols3);";
					$qpo3=$conn->prepare($sqlpo3);
					$qpo3->execute($data3);
				}
				else
				{
				    $data3=[
                		":options"=>$poll_ans3
                	];
					$sqlpo3="UPDATE poll_options SET options=:options WHERE id='$opt3' AND poll_id='$p_id';";
					$qpo3=$conn->prepare($sqlpo3);
					$qpo3->execute($data3);
				}

				if(empty($opt4) && !empty($poll_ans4))
				{
				    $data4=[
                		":poll_id"=>$p_id,
                		":options"=>$poll_ans4
                	];
                	$columns4="";
                	$cols4=array_keys($data4);
                	$cols4=implode(", ",  $cols3);
                	$insertCols4=str_replace(":", "", $cols4);
                	
					$sqlpo4="INSERT INTO poll_options ($insertCols4) VALUES ($cols4);";
					$qpo4=$conn->prepare($sqlpo4);
					$qpo4->execute($data4);
				}
				else
				{
				    $data4=[
                		":options"=>$poll_ans4
                	];
					$sqlpo4="UPDATE poll_options SET options=:options WHERE id='$opt4' AND poll_id='$p_id';";
					$qpo4=$conn->prepare($sqlpo4);
					$qpo4->execute($data4);
				}

			}

			$_SESSION['s']="Poll Edited Successfully !!!";
			header('Location:'.ROOT_URL.'view_polls.php');
		}
		else
		{
			$_SESSION['e']="Failed To Edit Poll !!!";
			echo"<script>history.go(-1);</script>";
		}
	}
	catch (PDOException $ex) 
	{
		echo  $ex->getMessage();
	}
}
?>