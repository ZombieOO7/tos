<?php
session_start();
include_once '../config/master.inc.php';
include ROOT_PATH.'config/connection.php';

if(isset($_POST)){

		extract($_POST);
		
			$sql="SELECT c.com_state FROM customers c WHERE c.id='$co_id';";
			$query= $conn->query($sql);
			$results=$query->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($results));
	}

?>