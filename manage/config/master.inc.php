<?php
// ini_set('memory_limit','1G');
define( 'ROOT_PATH', $_SERVER['DOCUMENT_ROOT']."/tos/manage/" );
define( 'ROOT_URL', "http://localhost/tos/manage/");
define( 'ROOT_PATH_FRONT', $_SERVER['DOCUMENT_ROOT']."/" );
define( 'ROOT_URL_FRONT', "http://localhost/tos/");
date_default_timezone_set('Asia/Kolkata');
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
$host="localhost";
$rootdb="turnofsp_tos";
// $rootuser="turnofsp_tos";
// $rootpass="(HXYE*oZRR!E";
$rootuser="root";
$rootpass="";
?>