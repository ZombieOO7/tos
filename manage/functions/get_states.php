<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST)){

		extract($_POST);
		$sqlc="SELECT countries_name from countries WHERE countries_id='$c_id';";
		$queryc= $conn->query($sqlc);
		$cont=$queryc->fetchAll(PDO::FETCH_ASSOC);
		$selected_con=$cont[0]['countries_name'];

		$sqls="SELECT * from states WHERE country_name='$selected_con' order by state_name;";
		$querys= $conn->query($sqls);
		$states=$querys->fetchAll(PDO::FETCH_ASSOC);
		
		print_r(json_encode($states));
	}

?>