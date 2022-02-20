<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"])) 
{	
	extract($_POST);

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
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

		try
		{	
			$sql = "INSERT INTO polls ($insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);
			if($q->execute($data))	
			{	
				$sqlp="SELECT MAX(id) as id FROM polls;";
				$qp=$conn->query($sqlp);
				$poll_ids=$qp->fetchAll(PDO::FETCH_ASSOC);
				$poll_id=$poll_ids[0]['id'];

				if(!empty($poll_id))
				{
					$options=array($poll_ans1,$poll_ans2,$poll_ans3,$poll_ans4);

					for($i=0;$i<count($options);$i++)
					{
						if(!empty($options[$i]))
						{
						    $data2=[
                        		":poll_id"=>$poll_id,
                        		":options"=>$options[$i]
                        	];
                        	$columns2="";
                        	$cols2=array_keys($data2);
                        	$cols2=implode(", ",  $cols2);
                        	$insertCols2=str_replace(":", "", $cols2);
                        	
							$sqlpo="INSERT INTO poll_options ($insertCols2) VALUES ($cols2);";
							$qpo=$conn->prepare($sqlpo);
							$qpo->execute($data2);
							unset($data2);
						}
					}
				}

				$_SESSION['s']="Poll Created Successfully !!!";
				header('Location:'.ROOT_URL.'view_polls.php');
			}
			else
			{
				$_SESSION['e']="Failed To Create Poll !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			echo  $ex->getMessage();
		}
}
?>