<?php
$host ='localhost';
$usernamemys ='root';
$passwordmys ='';
$db ='twittydb';
$conn = new mysqli($host, $usernamemys, $passwordmys , $db);
	
	if($conn->connect_error)
	{
		die("failed".$conn->connect_error);
	}

?>