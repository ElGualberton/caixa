<?php
require_once('../../config.php');
require_once(DBAPI);
//require_once(FUNCOES);

$cxsimples_lancamentoss = null;
$cxsimples_lancamentos = null;

$cxsimples_tipos = null;
$cxsimples_tipo = null;

$cxsimples_diarios = null;
$cxsimples_diario = null;


/**
 *  Listagem de cxsimples_lancamentoss
 */
function index() {
	global $cxsimples_diarios;
	$cxsimples_diarios = find_all('cxsimples_diario');
}

/**
 *  Listagem de cxsimples_diario 30 dias
 */
function indexdia30() {
	global $cxsimples_diarios;
	$cxsimples_diarios = find_limit('cxsimples_diario', 30, 'cxs_diario_dt', 'DESC');
}

/**
 *  Listagem de cxsimples_tipo
 */
function lista_tipo() {
	global $cxsimples_tipos;
	$cxsimples_tipos = find_all('cxsimples_tipo');
}

/**
 *  Cadastro de cxsimples_lancamentoss
 */
function add() {
	global $email_user;
	if (!empty($_POST['cxsimples_lancamentos'])) {
		$cxsimples_lancamentos = $_POST['cxsimples_lancamentos'];
		num_id_dia($now->format(Y-m-d));
		$cxsimples_lancamentos['cxs_lcto_id'] = ($dia_id + 1);
		/** echo $cxsimples_lancamentos['cxs_lcto_descricao'];
		*echo $cxsimples_lancamentos['cxs_lcto_entrada'];
		*echo $cxsimples_lancamentos['cxs_lcto_dias'];
		*echo $cxsimples_lancamentos['cxs_lcto_indice']; */
		save('cxsimples_lancamentos', $cxsimples_lancamentos);
		log_salvum($email_user, 'I', $cxsimples_lancamentos);
		header('location: ../index.php');
	}
}

function num_id_dia($id = null) {
	global $dia_id;
	$dia_id = quantidade_coluna('cxsimples_lancamentos', $id, 'cxs_lcto_dt');
//$myfile = fopen("contar1-functions.txt","w") or die("Sem chance parceiro!");
//fwrite($myfile,$quantidade_lancamento['0']);
//fclose($myfile);
}

/**
 *  Listagem de cxsimples_lancamentos
 */
function index_dia($dtdia = null) {
	global $cxsimples_lancamentoss;
	//$cxsimples_lancamentoss = find_all('cxsimples_lancamentos');
	$database = open_database();
	$found = null;
	try {
    	$sql = "SELECT 
		date_format(a.cxs_lcto_dt,'%d/%m') as cxs_lcto_ddmm, 
		b.cxs_tipo_entrada as cxs_tipo_entrada, 
		a.cxs_lcto_valor_liq as cxs_lcto_valor_liq,
		b.cxs_tipo_descricao as cxs_tipo_descricao,
		a.cxs_lcto_descricao as cxs_lcto_descricao,
		a.cxs_lcto_dt as cxs_lcto_dt,
		a.cxs_lcto_id as cxs_lcto_id
		from cxsimples_lancamentos as a, cxsimples_tipo as b 
		where 
		a.cxs_tipo_id = b.cxs_tipo_id AND
		a.cxs_lcto_dt_consolidado = '" . $dtdia ."' 
		ORDER BY a.cxs_lcto_dt";
		$myfile = fopen("indexdia-function.txt","w") or die("Sem chance parceiro!");
		fwrite($myfile,$sql);
		fclose($myfile);
	   	$result = $database->query($sql);
	   	if ($result->num_rows > 0) {
			$cxsimples_lancamentoss = $result->fetch_all(MYSQLI_ASSOC);
	   	}
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  	}
	close_database($database);
	//var_dump($cxsimples_lancamentoss);
	return $cxsimples_lancamentoss;
}

/**
 *  Listagem de cxsimples_lancamentos consolidados
 */
function index_consolidado() {
	global $cxsimples_lancamentoss;
	//$cxsimples_lancamentoss = find_all('cxsimples_lancamentos');
	$database = open_database();
	$found = null;
	try {
    	$sql = "SELECT 
		date_format(a.cxs_lcto_dt,'%d/%m') as cxs_lcto_ddmm, 
		b.cxs_tipo_entrada as cxs_tipo_entrada, 
		a.cxs_lcto_valor_liq as cxs_lcto_valor_liq,
		b.cxs_tipo_descricao as cxs_tipo_descricao,
		a.cxs_lcto_descricao as cxs_lcto_descricao,
		a.cxs_lcto_dt as cxs_lcto_dt,
		a.cxs_lcto_id as cxs_lcto_id
		from cxsimples_lancamentos as a, cxsimples_tipo as b 
		where 
		a.cxs_tipo_id = b.cxs_tipo_id AND
		a.cxs_lcto_dt_consolidado <> '0000-00-00' 
		ORDER BY a.cxs_lcto_dt";
		$myfile = fopen("indexdia-function.txt","w") or die("Sem chance parceiro!");
		fwrite($myfile,$sql);
		fclose($myfile);
	   	$result = $database->query($sql);
	   	if ($result->num_rows > 0) {
			$cxsimples_lancamentoss = $result->fetch_all(MYSQLI_ASSOC);
	   	}
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  	}
	close_database($database);
	//var_dump($cxsimples_lancamentoss);
	return $cxsimples_lancamentoss;
}

/**
 *	Atualizacao/Edicao de cxsimples_lancamentos
 */
function edit() {
	global $email_user;
	//$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$myfile = fopen("edit-functions.txt","w") or die("Sem chance parceiro!");
		fwrite($myfile,$_GET['id']);
		fclose($myfile);
		if (isset($_POST['cxsimples_lancamentos'])) {
			$cxsimples_lancamentos = $_POST['cxsimples_lancamentos'];
			$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,$_SESSION['email']);
			fclose($myfile);
			//$cxsimples_lancamentos['modified'] = $now->format("Y-m-d");
			update('cxsimples_lancamentos', $id, $cxsimples_lancamentos,'cxs_lcto_id');
			log_salvum($email_user, 'A', $cxsimples_lancamentos);
			header('location: index.php');
		} else {
			$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,"pau no if");
			fclose($myfile);
			global $cxsimples_lancamentos;
			$cxsimples_lancamentos = find('cxsimples_lancamentos', $id, 'cxs_lcto_id');
		} 
	} else {
	header('location: index.php');
	}
}

/**
 *  Visualização de um cxsimples_lancamentos
 */
function view($id = null) {
  global $cxsimples_lancamentos;
  $cxsimples_lancamentos = find('cxsimples_lancamentos', $id, 'cxs_lcto_id');
}


/**
 *  Exclusão de um cxsimples_lancamentos
 */
function delete($id = null) {
  global $cxsimples_lancamentos;
  global $email_user;
  $myfile = fopen("delete-functions.txt","w") or die("Sem chance parceiro!");
  fwrite($myfile,$id);
  fclose($myfile);
  $cxsimples_lancamentos = remove('cxsimples_lancamentos', $id, 'cxs_lcto_id');
  $myfile = fopen("delete-functions2.txt","w") or die("Sem chance parceiro!");
  fwrite($myfile,'voltei!');
  fclose($myfile);
  log_salvum($email_user, 'D', $cxsimples_lancamentos);
  header('location: index.php');
}


?>