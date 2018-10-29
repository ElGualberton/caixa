<?php
require_once('../../config.php');
require_once(DBAPI);
//require_once(FUNCOES);

$cxsimples_lancamentoss = null;
$cxsimples_lancamentos = null;

$cxsimples_tipos = null;
$cxsimples_tipo = null;

/**
 *  Listagem de cxsimples_lancamentoss
 */
function index() {
	global $cxsimples_lancamentoss;
	$cxsimples_lancamentoss = find_all('cxsimples_lancamentos');
}

/**
 *  Listagem de cxsimples_lancamentos
 */
function index_dia() {
	global $cxsimples_lancamentoss;
	//$cxsimples_lancamentoss = find_all('cxsimples_lancamentos');
	$database = open_database();
	$found = null;
	$hoje = null;
	$hoje = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	$dtdia = null;
	$dtdia = "'" . $hoje->format('Y-m-d') . "'";
	try {
    	$sql = "SELECT 
		date_format(a.cxs_lcto_dt_prevista,'%d/%m') as cxs_lcto_ddmm, 
		b.cxs_tipo_entrada as cxs_tipo_entrada, 
		a.cxs_lcto_valor_liq as cxs_lcto_valor_liq,
		b.cxs_tipo_descricao as cxs_tipo_descricao,
		a.cxs_lcto_descricao as cxs_lcto_descricao,
		a.cxs_lcto_dt as cxs_lcto_dt,
		a.cxs_lcto_id as cxs_lcto_id
		from cxsimples_lancamentos as a, cxsimples_tipo as b 
		where 
		a.cxs_tipo_id = b.cxs_tipo_id AND
		a.cxs_lcto_dt = $dtdia 
		ORDER BY a.cxs_lcto_id";
		$myfile = fopen("find-database.txt","w") or die("Sem chance parceiro!");
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
		$hoje = null;
		$hoje = date_create('now', new DateTimeZone('America/Sao_Paulo'));
		$dtdia = null;
		$dtdia = "'" . $hoje->format('Y-m-d') . "'";
		$cxsimples_lancamentos['cxs_lcto_id'] = (num_id_dia($dtdia) + 1);
		/** echo $cxsimples_lancamentos['cxs_lcto_descricao'];
		*echo $cxsimples_lancamentos['cxs_lcto_entrada'];
		*echo $cxsimples_lancamentos['cxs_lcto_dias'];
		*echo $cxsimples_lancamentos['cxs_lcto_indice']; */
		//$myfile = fopen("add-functions.txt","w") or die("Sem chance parceiro!");
		//fwrite($myfile,var_dump($cxsimples_lancamentos));
		//fclose($myfile);
		save('cxsimples_lancamentos', $cxsimples_lancamentos);
		log_salvum($_SESSION['email'], 'I', $cxsimples_lancamentos);
		header('location: ../index.php');
	} else {
		//view_tipo();
		//global $cxsimples_tipo;
		//$cxsimples_tipo = find('cxsimples_tipo', $_POST['cxs_tipo_id'] , 'cxs_tipo_id');
		$database = open_database();
		$resultado = null;
		$found = null;
		try {
			if($_POST['cxs_tipo_id']) {
				$id = $_POST['cxs_tipo_id'];
				$sql = "SELECT * from cxsimples_tipo where cxs_tipo_id = $id";
		//Pink Floyd é ótimo !
			$result = $database->query($sql);
			global $cxsimples_tipo;
			$cxsimples_tipo = $result->fetch_row();
			//echo var_dump($cxsimples_tipo);
			$found = $resultado[0];
			return $found;
			}
		} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
		}
		close_database($database);
		//echo var_dump($found);
		/**if($cxsimples_tipo[3] > 0){
			$_SESSION['lcto_dt_prevista'] = date('Y-m-d', strtotime($now .  + $cxsimples_tipo['dias'] . 'days'));
			echo $_SESSION['lcto_dt_prevista'];
			echo $_SESSION['email'];
			$_SESSION['teste'] = $cxsimples_tipo['dias'];
		}
		if($cxsimples_tipo[4] > 0){
			$_SESSION['lcto_valor_liq'] = $_POST['lcto_valor'] * $cxsimples_tipo['indice'];
		}**/
	}
}

function num_id_dia($id = null) {
	global $dia_id;
	$dia_id = maximo_coluna('cxsimples_lancamentos',$id , 'cxs_lcto_id', 'cxs_lcto_dt');
	return $dia_id;
	//$myfile = fopen("num_id-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$dia_id['0']);
	//fclose($myfile);
}

/**
 *	Atualizacao/Edicao de cxsimples_lancamentos
 */
function edit() {
	global $email_user;
	//$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	if (isset($_GET['id']) and  isset($_GET['dt'])) {
		$id = $_GET['id'];
		$dt = $_GET['dt'];
		if (isset($_POST['cxsimples_lancamentos'])) {
			$cxsimples_lancamentos = $_POST['cxsimples_lancamentos'];
			$myfile = fopen("editx-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,var_dump($cxsimples_lancamentos));
			fclose($myfile);
			//$cxsimples_lancamentos['modified'] = $now->format("Y-m-d");
			update2key('cxsimples_lancamentos', $id, $cxsimples_lancamentos,'cxs_lcto_id', "'" . $dt . "'", 'cxs_lcto_dt');
			log_salvum($email_user, 'A', $cxsimples_lancamentos);
			header('location: index.php');
		} else {
			$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,"pau no if");
			fclose($myfile);
			global $cxsimples_lancamentos;
			$cxsimples_lancamentos = find2keys('cxsimples_lancamentos', $id, 'cxs_lcto_id', "'" . $dt . "'", 'cxs_lcto_dt' );
		} 
	} else {
	header('location: index.php');
	}
}

/**
 *  Visualização de um cxsimples_lancamento
 */
function view($id = null, $dt = null) {
	global $cxsimples_lancamentos;
	global $cxsimples_tipo;
	//$myfile = fopen("view-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$dt . $id);
	//fclose($myfile);
	$cxsimples_lancamentos = find2keys('cxsimples_lancamentos', $id, 'cxs_lcto_id', "'" . $dt . "'", 'cxs_lcto_dt' );
	$cxsimples_tipo = find('cxsimples_tipo', $cxsimples_lancamentos['cxs_tipo_id'], 'cxs_tipo_id');
	//var_dump($cxsimples_lancamentos);
	//var_dump($cxsimples_tipo);
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