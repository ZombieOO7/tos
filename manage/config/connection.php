<?php
    try 
    {
    	$conn = new PDO('mysql:host='.$host.';dbname='.$rootdb.'', $rootuser, $rootpass);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
   	    // echo "Connected successfully"; 
        // exit;
    }
    catch(PDOException $e) 
    {
    	echo "Connection failed: " . $e->getMessage();
        // exit;

    }
?>