<?php
session_start(); 
include_once '../config/master.inc.php';
session_destroy();
header('Location:'.ROOT_URL_FRONT.'index.php');

?>