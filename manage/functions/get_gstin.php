<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST)){

		extract($_POST);
		$sqlc="SELECT gst_code FROM states WHERE id='$s_id';";
		$queryc= $conn->query($sqlc);
		$cont=$queryc->fetchAll(PDO::FETCH_ASSOC);
		$selected_con=$cont[0]['gst_code'];

		print_r(json_encode($selected_con));
	}

?>