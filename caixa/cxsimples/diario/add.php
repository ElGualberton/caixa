<?php 
	require_once('functions.php');
	session_start();
	//require_once('delete.php'); 
	//echo $_GET['diario_dt'];
	//var_dump($_GET);
	fechadia($_SESSION['diario_dt']);
	unset($_SESSION['diario_dt']);
?>