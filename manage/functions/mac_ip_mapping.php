<?php 
$d = explode('Physical Address. . . . . . . . .',shell_exec("ipconfig/all"));
$d1 = explode(':',$d[1]);
$macAddress = explode(' ',$d1[1]);
$mac=trim($macAddress[1]);
$ip=$_SERVER['REMOTE_ADDR'];
?>