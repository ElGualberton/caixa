<?php
require_once('../../config.php');
require_once(DBAPI);
//require_once(FUNCOES);

$cxsimples_tipos = null;
$cxsimples_tipo = null;

/**
 *  Listagem de cxsimples_tipos
 */
function index() {
	global $cxsimples_tipos;
	$cxsimples_tipos = find_all('cxsimples_tipo');
}

/**
 *  Cadastro de cxsimples_tipos
 */
function add() {
	//global $email_user;
	//$email_user = $_SESSION['email'];
	if (!empty($_POST['cxsimples_tipo'])) {
	$cxsimples_tipo = $_POST['cxsimples_tipo'];
		save('cxsimples_tipo', $cxsimples_tipo);
		log_salvum($_SESSION['email'], 'I', $cxsimples_tipo);
	header('location: index.php');
	}
}

/**
 *	Atualizacao/Edicao de cxsimples_tipo
 */
function edit() {
	global $email_user;
	$email_user = $_SESSION['email'];
	//$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		//$myfile = fopen("edit-functions.txt","w") or die("Sem chance parceiro!");
		//fwrite($myfile,$_GET['id']);
		//fclose($myfile);
		if (isset($_POST['cxsimples_tipo'])) {
			$cxsimples_tipo = $_POST['cxsimples_tipo'];
			//$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,$_SESSION['email']);
			//fclose($myfile);
			update('cxsimples_tipo', $id, $cxsimples_tipo,'cxs_tipo_id');
			log_salvum($email_user, 'A', $cxsimples_tipo);
			header('location: index.php');
		} else {
			//$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,"pau no if");
			//fclose($myfile);
			global $cxsimples_tipo;
			$cxsimples_tipo = find('cxsimples_tipo', $id, 'cxs_tipo_id');
		} 
	} else {
	header('location: index.php');
	}
}

/**
 *  Visualização de um cxsimples_tipo
 */
function view($id = null) {
	global $cxsimples_tipo;
	$cxsimples_tipo = find('cxsimples_tipo', $id, 'cxs_tipo_id');
}

function contar($id = null) {
	global $quantidade_lancamento;
	$quantidade_lancamento = quantidade_coluna('cxsimples_lancamentos', $id, 'cxs_tipo_id');
	//$myfile = fopen("contar1-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$quantidade_lancamento['0']);
	//fclose($myfile);
}

/**
 *  Exclusão de um cxsimples_tipo
 */
function delete($id = null) {
	global $cxsimples_tipo;
	global $email_user;
	$email_user = $_SESSION['email'];
	//$myfile = fopen("delete-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$id);
	//fclose($myfile);
	$cxsimples_tipo = remove('cxsimples_tipo', $id, 'cxs_tipo_id');
	//$myfile = fopen("delete-functions2.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,'voltei!');
	//fclose($myfile);
	log_salvum($email_user, 'D', $cxsimples_tipo);
	header('location: index.php');
}

?>