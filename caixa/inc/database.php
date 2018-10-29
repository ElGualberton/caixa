<?php
mysqli_report(MYSQLI_REPORT_STRICT);

function open_database() {
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    return $conn;
	} catch (Exception $e) {
		echo $e->getMessage();
		return null;
	}
}

function close_database($conn) {
	try {
		mysqli_close($conn);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */ 
function find( $table = null, $id = null, $campo = null ) {
	$database = open_database();
	$found = null;
	try {
	  if ($id) {
      $sql = "SELECT * FROM " . $table . " WHERE " . $campo . " = " . $id;
			$myfile = fopen("find-database.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,$sql);
			fclose($myfile);
	    $result = $database->query($sql);
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_assoc();
	    }
	  } else {
      $sql = "SELECT * FROM " . $table;
      //echo $sql;
	    $result = $database->query($sql);
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_all(MYSQLI_ASSOC);
        /* Metodo alternativo
        $found = array();
        while ($row = $result->fetch_assoc()) 
        {
          array_push($found, $row);
        } */
	    }
	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }
	close_database($database);
	return $found;
}

/**
 *  Pesquisa Registros por uma coluna (ou não) limitando a uma qtd em uma Tabela
 */ 
function find_limit( $table = null, $limite = null, $campo = null, $ordem = null ) {
	$database = open_database();
	$found = null;
	try {
	  if (is_int($limite)) {
      if (is_null($campo)){
        $sql = "SELECT * FROM " . $table . "LIMIT " . $limite;
        //echo $sql;
        $result = $database->query($sql);
        if ($result->num_rows > 0) {
          $found = $result->fetch_all(MYSQLI_ASSOC);
          /* Metodo alternativo
          $found = array();
          while ($row = $result->fetch_assoc()) 
          {
            array_push($found, $row);
          } */
        }
      } elseif(is_null($ordem)){
        $sql = "SELECT * FROM " . $table . " ORDER BY " . $campo . " LIMIT " . $limite;
        //echo $sql;
        $result = $database->query($sql);
        if ($result->num_rows > 0) {
          $found = $result->fetch_all(MYSQLI_ASSOC);
          /* Metodo alternativo
          $found = array();
          while ($row = $result->fetch_assoc()) 
          {
            array_push($found, $row);
          } */
        }
      } else {
        $sql = "SELECT * FROM " . $table  . " ORDER BY " . $campo . " " . $ordem . " LIMIT " . $limite;
        //echo $sql;
        $myfile = fopen("findKEY-database.txt","w") or die("Sem chance parceiro!");
        fwrite($myfile,$sql);
        fclose($myfile);
        $result = $database->query($sql);
        if ($result->num_rows > 0) {
          $found = $result->fetch_all(MYSQLI_ASSOC);
          /* Metodo alternativo
          $found = array();
          while ($row = $result->fetch_assoc()) 
          {
            array_push($found, $row);
          } */
        }
      }
	  } else {
      echo"<script language='javascript' type='text/javascript'>
      alert('Campo de limite de pesquisa não numérico, entre em contato com o Suporte!');
      window.location.href='index.php';
      </script>";
	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }
	close_database($database);
	return $found;
}

/**
 *  Pesquisa um Registro por 2 ID em uma Tabela
 */ 
function find2keys( $table = null, $id1 = null, $campo1 = null, $id2 = null, $campo2 = null ) {
	$database = open_database();
	$found = null;
	try {
	  if ($id1) {
      $sql = "SELECT * FROM " . $table . " WHERE " . $campo1 . " = " . $id1 . " and " . $campo2 . " = " . $id2;
			$myfile = fopen("find2keys-database.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,$sql);
			fclose($myfile);
	    $result = $database->query($sql);
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_assoc();
	    }
	  } else {
      $sql = "SELECT * FROM " . $table;
      //echo $sql;
	    $result = $database->query($sql);
	    if ($result->num_rows > 0) {
	      $found = $result->fetch_all(MYSQLI_ASSOC);
        /* Metodo alternativo
        $found = array();
        while ($row = $result->fetch_assoc()) 
        {
          array_push($found, $row);
        } */
	    }
	  }
	} catch (Exception $e) {
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
  }
	close_database($database);
	return $found;
}

/**
 *  Pesquisa Todos os Registros de uma Tabela
 */
function find_all( $table ) {
  return find($table);
}

/**
 *  Conta registros de uma tabela por uma info. de uma coluna
 */
function quantidade_coluna ($table = null, $id = null, $nomecampo = null){
	$database = open_database();
  $resultado = null;
  $found = null;
	try {
		if($id) {
			$sql = "SELECT COUNT($nomecampo) as qtd from $table where $nomecampo = $id";
      //DAFT PUNK detona!!!!!!
      $result = $database->query($sql);
      $resultado = $result->fetch_row();
      $found = $resultado[0];
      return $found;
		}
	} catch (Exception $e) {
	$_SESSION['message'] = $e->GetMessage();
	$_SESSION['type'] = 'danger';
	}
	close_database($database);
}

/**
 *  Retorna o ultimo registro de uma tabela 
 */
function maximo_coluna ($table = null, $id = null, $nomecampo1 = null, $nomecampo2 = null){
	$database = open_database();
  $resultado = null;
  $found = null;
	try {
		if($id) {
			$sql = "SELECT ifnull(MAX($nomecampo1),0) as qtd from $table where $nomecampo2 = $id";
      //NUMB com o Jay-Z ficou bem melhor!!!!!!!
      $myfile = fopen("maximo-database.txt","w") or die("Sem chance parceiro!");
      fwrite($myfile,$sql);
      fclose($myfile);
      $result = $database->query($sql);
      $resultado = $result->fetch_row();
      $found = $resultado[0];
      return $found;
		}
	} catch (Exception $e) {
	$_SESSION['message'] = $e->GetMessage();
	$_SESSION['type'] = 'danger';
	}
	close_database($database);
}

/**
 *  Log do Sistema  
 */
function log_salvum ($email = null, $operacao = null, $historico = null){
  $database = open_database();
  try {
    if($historico) {
      $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
      $sql = "INSERT INTO historico(log_email,log_datetime,log_operacao,log_dados) VALUES ('" . $email . "'," . $today->format('Y-m-d H:i:s') . ",'" . $operacao . "','" . addslashes(var_dump($historico)) . "');" ;
			$myfile = fopen("log.txt","w") or die("Sem chance parceiro!");
			fwrite($myfile,$sql);
			fclose($myfile);
      $database->query($sql);
    }
  } catch (Exception $e) {
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
  }
  close_database($database);
}

/**
*  Insere um registro no BD
*/
function save($table = null, $data = null) {
  $database = open_database();
  //mysql_set_charset('utf8');
  $columns = null;
  $values = null;
  //print_r($data);
  foreach ($data as $key => $value) {
    $columns .= trim($key, "'") . ",";
    $values .= "'$value',";
  }
  // remove a ultima virgula
  $columns = rtrim($columns, ',');
  $values = rtrim($values, ',');
  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
  $myfile = fopen("insert-database.txt","w") or die("Sem chance parceiro!");
  fwrite($myfile,$sql);
  fclose($myfile);
  try {
    $database->query($sql);
    $_SESSION['message'] = 'Registro cadastrado com sucesso.';
    $_SESSION['type'] = 'success';
  } catch (Exception $e) { 
    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
    $_SESSION['type'] = 'danger';
    echo"<script language='javascript' type='text/javascript'>
    alert('Erro na inclusão do registro, entre em contato com o Suporte!');
    window.location.href='index.php';
    </script>";
  } 
  close_database($database);
}

/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null, $nomechave = null) {
	$database = open_database();
	$items = null;
	foreach ($data as $key => $value) {
	  $items .= trim($key, "'") . "='$value',";
	}
	// remove a ultima virgula
	$items = rtrim($items, ',');
	$sql  = "UPDATE " . $table;
	$sql .= " SET $items";
  $sql .= " WHERE $nomechave =" . $id . ";";
  echo $sql;
  //$myfile = fopen("update.txt","w") or die("Sem chance parceiro!");
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
	close_database($database);
}


/**
 *  Atualiza um registro em uma tabela, por ID
 */
function update2key($table = null, $id1 = 0, $data = null, $nomechave1 = null, $id2 = null, $nomechave2 = null) {
	$database = open_database();
	$items = null;
	foreach ($data as $key => $value) {
		$items .= trim($key, "'") . "='$value',";
		/** 
		if($id1 == null and $key == $nomechave1){
			$id1 = $value;
		}
		if($id2 == null and $key == $nomechave2){
			$id2 = $value;
		}*/
	}
	// remove a ultima virgula
	$items = rtrim($items, ',');
	$sql  = "UPDATE " . $table;
	$sql .= " SET $items";
	$sql .= " WHERE $nomechave1 =" . $id1 . " AND ";
	$sql .= " $nomechave2 =" . $id2 . ";";
	echo $sql;
	$myfile = fopen("update2.txt","w") or die("Sem chance parceiro!");
	fwrite($myfile,$sql);
	fclose($myfile);
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
	close_database($database);
}


/**
 *  Remove uma linha de uma tabela pelo ID do registro
 */
function remove( $table = null, $id = null, $nomechave = null ) {
  $database = open_database();
  try {
    if ($id) {
      $sql = "DELETE FROM " . $table . " WHERE " . $nomechave . " = " . $id;
      //$myfile = fopen("remove-database.txt","w") or die("Sem chance parceiro!");
      //fwrite($myfile,$sql);
      //fclose($myfile);
      $result = $database->query($sql);
      if ($result = $database->query($sql)) {   	
        $_SESSION['message'] = "Registro Removido com Sucesso.";
        $_SESSION['type'] = 'success';
        echo"<script language='javascript' type='text/javascript'>
        alert('Registro excluído do Banco com Sucesso!');
        window.location.href='index.php';
        </script>";
          }
    }
  } catch (Exception $e) { 
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
    echo"<script language='javascript' type='text/javascript'>
    alert('Erro na exclusão do registro, entre em contato com o Suporte!');
    window.location.href='index.php';
    </script>";
  }
  close_database($database);
}


/**
 *  Remove uma linha de uma tabela pelo ID do registro
 */
function remove2keys( $table = null, $id1 = null, $nomechave1 = null , $id2 = null, $nomechave2 = null ) {
  $database = open_database();
  try {
    if ($id1) {
      $sql = "DELETE FROM " . $table . " WHERE " . $nomechave1 . " = " . $id1 . " and " . $nomechave2 . " = " . $id2;
      //$myfile = fopen("remove-database.txt","w") or die("Sem chance parceiro!");
      //fwrite($myfile,$sql);
      //fclose($myfile);
      $result = $database->query($sql);
      if ($result = $database->query($sql)) {   	
        $_SESSION['message'] = "Registro Removido com Sucesso.";
        $_SESSION['type'] = 'success';
        echo"<script language='javascript' type='text/javascript'>
        alert('Registro excluído do Banco com Sucesso!');
        window.location.href='index.php';
        </script>";
          }
    }
  } catch (Exception $e) { 
    $_SESSION['message'] = $e->GetMessage();
    $_SESSION['type'] = 'danger';
    echo"<script language='javascript' type='text/javascript'>
    alert('Erro na exclusão do registro, entre em contato com o Suporte!');
    window.location.href='index.php';
    </script>";
  }
  close_database($database);
}

?>