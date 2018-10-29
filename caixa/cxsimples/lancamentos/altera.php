<?php
session_start();
require_once('../../config.php');
require_once(DBAPI);
require_once('functions.php');
global $cxsimples_lancamentos;
$cxsimples_lancamentos = $_POST['cxsimples_lancamentos'];
//$teste = array_keys($cxsimples_lancamentos);
//var_dump($teste);
$id = $_SESSION['cxs_lcto_id'];
$dt = $_SESSION['cxs_lcto_dt'];
//echo $id;
//echo $dt;
unset($_SESSION['cxs_lcto_dt']);
unset($_SESSION['cxs_lcto_id']);
if (is_array($cxsimples_lancamentos)) {
	//print_r($cxsimples_lancamentos);
	update2key('cxsimples_lancamentos', $id , $cxsimples_lancamentos,'cxs_lcto_id', "'" . $dt . "'", 'cxs_lcto_dt');
	log_salvum($email_user, 'A', $cxsimples_lancamentos);
	//echo 'Mensagem na BOTTTAAAAAAA';
	header("location: view.php?id=".$id."&dt=".$dt);
} else {
	echo"<script language='javascript' type='text/javascript'>
	alert('Erro na Alteração , entre em contato com o Suporte!');
	window.location.href='index.php';
	</script>";
	header("location: ../index.php");
}

?>