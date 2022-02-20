<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST['r_id']))
{
	extract($_POST);
		
	$sql="SELECT id,name FROM news_category WHERE id='$r_id';";
	$query= $conn->query($sql);
	$results=$query->fetchAll(PDO::FETCH_ASSOC);
	print_r(json_encode($results));
}

?>