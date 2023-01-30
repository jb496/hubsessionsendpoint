<?php
	
	// $host       = 'localhost';
	// $db_name 	= 'dart_logs';
	// $username 	= 'sds';
	// $pw 		= 'Em-Vf+WtU5FnsYLu';


	// $db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8mb4', $username, $pw);


	$host       = 'localhost';
	$db_name 	= 'live';
	$username 	= 'postgres';
	$pw 		= 'sPfQ5#8CD#Q8';

	$db = new PDO('pgsql:host='.$host.';dbname='.$db_name, $username, $pw);

?>