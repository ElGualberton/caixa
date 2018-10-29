
<?php 
/** 
  function passou($id = null){
    $myfile = fopen("delete-code.txt","w") or die("Sem chance parceiro!");
    fwrite($myfile,$id);
    fclose($myfile);
    if (isset($_GET['id'])){
      $myfile = fopen("delete-code2.txt","w") or die("Sem chance parceiro!");
      fwrite($myfile,$id);
      fclose($myfile);
    }
  }
*/
	require_once('functions.php'); 
	if (isset($_GET['id']) and isset($_GET['dt'])){
		$myfile = fopen("delete-code2.txt","w") or die("Sem chance parceiro!");
		fwrite($myfile,$_GET['id']);
		fclose($myfile);
		delete($_GET['id'],$_GET['dt']);
	} else {
		die("ERRO: ID não definido.");
	}
?>