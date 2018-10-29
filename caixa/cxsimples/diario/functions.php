<?php
require_once('../../config.php');
require_once(DBAPI);
//require_once(FUNCOES);

$cxsimples_tipos = null;
$cxsimples_tipo = null;
$cxsimples_lancamentoss = null;
$cxsimples_lancamentos = null;
$cxsimples_diarios = null;
$cxsimples_diario = null;

/**
 *  Listagem de cxsimples_tipos
 */
function index() {
	global $cxsimples_tipos;
	$cxsimples_tipos = find_all('cxsimples_tipo');
}

/**
 *  Listagem de cxsimples_tipos
 */
function index_dia($dt) {
	global $cxsimples_lancamentoss;
	//$cxsimples_lancamentoss = find_all('cxsimples_lancamentos');
	$database = open_database();
	$found = null;
	$dtdia = null;
	//var_dump($dt);
	if($dt instanceof DateTime){
		$dtdia = "'" . $dt->format('Y-m-d') . "'";
	} else {
		$dtdia = "'" . $dt . "'";
	}
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
		a.cxs_lcto_dt_prevista <= $dtdia AND
		a.cxs_lcto_dt_consolidado = 0
		ORDER BY a.cxs_lcto_dt_prevista";
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
 *  Cadastro de cxsimples_tipos
 */
function add() {
	global $email_user;
  if (!empty($_POST['cxsimples_tipo'])) {
    $cxsimples_tipo = $_POST['cxsimples_tipo'];
    /** echo $cxsimples_tipo['cxs_tipo_descricao'];
    *echo $cxsimples_tipo['cxs_tipo_entrada'];
    *echo $cxsimples_tipo['cxs_tipo_dias'];
    *echo $cxsimples_tipo['cxs_tipo_indice']; */
	save('cxsimples_tipo', $cxsimples_tipo);
	log_salvum($email_user, 'I', $cxsimples_tipo);
    header('location: index.php');
  }
}

/**
 *	Atualizacao/Edicao de cxsimples_tipo
 */
function edit() {
	//global $email_user;
	//$email_user = $_SESSION['email'];
	//$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$myfile = fopen("edit-functions.txt","w") or die("Sem chance parceiro!");
		fwrite($myfile,$_GET['id']);
		fclose($myfile);
		if (isset($_POST['cxsimples_tipo'])) {
			$cxsimples_tipo = $_POST['cxsimples_tipo'];
			$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,$_SESSION['email']);
			fclose($myfile);
			//$cxsimples_tipo['modified'] = $now->format("Y-m-d H:i:s");
			update('cxsimples_tipo', $id, $cxsimples_tipo,'cxs_tipo_id');
			log_salvum($email_user, 'A', $cxsimples_tipo);
			header('location: index.php');
		} else {
			$myfile = fopen("edit2-functions.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,"pau no if");
			fclose($myfile);
			global $cxsimples_tipo;
			$cxsimples_tipo = find('cxsimples_tipo', $id, 'cxs_tipo_id');
		} 
	} else {
	header('location: index.php');
	}
}

/**
 *  Visualização de um cxsimples_lancamento
 */
function view($dt = null) {
	global $cxsimples_diario;
	//$myfile = fopen("view-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$dt . $id);
	//fclose($myfile);
	$cxsimples_diario = find('cxsimples_diario',"'" . $dt . "'" , 'cxs_diario_dt');
	//var_dump($cxsimples_lancamentos);
	//var_dump($cxsimples_tipo);
}

/**
 *  Visualização de um cxsimples_lancamento
 */
function viewdia($dt = null) {
	global $cxsimples_diario;
	//$myfile = fopen("view-functions.txt","w") or die("Sem chance parceiro!");
	//fwrite($myfile,$dt . $id);
	//fclose($myfile);
	$cxsimples_diario = find('cxsimples_diario', "'" . $dt  . "'", 'cxs_diario_dt');
	//var_dump($cxsimples_lancamentos);
	//var_dump($cxsimples_tipo);
}
  
/**
 *  Exclusão de um cxsimples_lancamento, precisa de 2 chaves
 */
function delete($id = null, $dt = null) {
  global $cxsimples_lancamentos;
  global $email_user;
  //$myfile = fopen("delete-functions.txt","w") or die("Sem chance parceiro!");
  //fwrite($myfile,$id . $dt);
  //fclose($myfile);
  $cxsimples_lancamentos = remove2keys('cxsimples_lancamentos', $id, 'cxs_tipo_id',"'" . $dt . "'", 'cxs_tipo_dt');
  //$myfile = fopen("delete-functions2.txt","w") or die("Sem chance parceiro!");
  //fwrite($myfile,'voltei!');
  //fclose($myfile);
  log_salvum($email_user, 'D', $cxsimples_lancamentos);
  header('location: index.php');
}

/**
 *  Fechamento do Caixa e consolidar lançamentos
 */
function fechadia($dt = null){
	$database = open_database();
	if ($dt) {
		try {
			$sql = "SELECT 
			ifnull(cxs_diario_final, 0.00) as vl_old, 
			ifnull(cxs_diario_dt, '0000-00-00') as dt_old
			from cxsimples_diario WHERE
			cxs_diario_dt = (SELECT MAX(cxs_diario_dt) from cxsimples_diario)";
			//$myfile = fopen("fechadia1-function.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,$sql);
			//fclose($myfile);
			$result = $database->query($sql);
			$dia_anterior = null;
			if ($result->num_rows > 0) {
				$dia_anterior = $result->fetch_row();
			} else {
				$dia_anterior[0] = 0.00;
				$dia_anterior[1] = '0000-00-00';
			}
			//$myfile = fopen("fechadia1a-function.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,var_dump($dia_anterior));
			//fclose($myfile);
			$sql = "UPDATE cxsimples_lancamentos SET
					cxs_lcto_dt_consolidado = '" . $dt . "' 
					WHERE cxs_lcto_dt_prevista <= '" . $dt . "' 
					AND cxs_lcto_dt_consolidado = '0000-00-00'";
			//$myfile = fopen("fechadia2-function.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,$sql);
			//fclose($myfile);
			try {
				$database->query($sql);
				$_SESSION['message'] = 'Registro atualizado com sucesso.';
				$_SESSION['type'] = 'success';
				echo"<script language='javascript' type='text/javascript'>
				alert('Registro alterado no Banco com Sucesso!');
				window.location.href='index.php';
				</script>";
			} catch (Exception $e) { 
				$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
				$_SESSION['type'] = 'danger';
				echo"<script language='javascript' type='text/javascript'>
				alert('Erro na alteração do registro, entre em contato com o Suporte!');
				window.location.href='index.php';
				</script>";
			} 
			$sql = "INSERT INTO cxsimples_diario(
				cxs_diario_dt, 
				cxs_diario_inicial, 
				cxs_diario_final, 
				cxs_diario_dt_anterior
			) VALUES (
				'" . $dt . "', 
				(" . $dia_anterior[0] ."), 
				(
					(" . $dia_anterior[0] ." + 
						( -1 * 
							(select 
								ifnull(sum(a.cxs_lcto_valor_liq),0.00) 
								from 
									cxsimples_lancamentos as a, 
									cxsimples_tipo as b 
								where 
								a.cxs_lcto_dt_consolidado = '" . $dt . "' and 
								a.cxs_tipo_id = b.cxs_tipo_id and 
								b.cxs_tipo_entrada = 'S'
							)
						) +
						(select 
							ifnull(sum(a.cxs_lcto_valor_liq),0.00) 
							from 
								cxsimples_lancamentos as a, 
								cxsimples_tipo as b 
							where 
								a.cxs_lcto_dt_consolidado = '" . $dt . "' and 
								a.cxs_tipo_id = b.cxs_tipo_id and 
								b.cxs_tipo_entrada = 'E'
						)
					)
				), 
				'" . $dia_anterior[1] . "'
			)";						
			//$myfile = fopen("fechadia3-function.txt","w") or die("Sem chance parceiro!");
			//fwrite($myfile,$sql);
			//fclose($myfile);
			try {
				$database->query($sql);
				$_SESSION['message'] = 'Registro atualizado com sucesso.';
				$_SESSION['type'] = 'success';
				echo"<script language='javascript' type='text/javascript'>
				alert('Fechamento realizado com Sucesso! ;)');
				window.location.href='index.php';
				</script>";
			} catch (Exception $e) { 
				$_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
				$_SESSION['type'] = 'danger';
				echo"<script language='javascript' type='text/javascript'>
				alert('Erro na alteração do registro, entre em contato com o Suporte!');
				window.location.href='index.php';
				</script>";
			} 
		} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
		}
	}  
	close_database($database);
	//viewdia($dt);	
}
?>