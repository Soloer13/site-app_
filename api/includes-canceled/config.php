<?php 
	$host 			='localhost';
	$db_user 		='root';
	$db_password 	='';
	$db_name 		='masirah_site';

	$db = new PDO('mysql:host='.$host.'db_name='.$db_name, $db_user, $db_password);

	//set some db attributes
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //idk what is does!
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); //idk what it does!
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //idk what it does!

	define('APP_NAME', 'PHP REST API Tutorial');
	

 ?>