<?php
/** Nome do Cliente **/
define('cli_nome','Teste');

/** o nome do banco de dados **/
//define('DB_NAME', 'salvum');
define('DB_NAME', 'cliente104');

/** Usuario do banco de dados **/
define('DB_USER','salvum104');
//define('DB_USER','root');

/** Senha do banco de dados **/
define('DB_PASSWORD','arcoiris');
//define('DB_PASSWORD','');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', 'http://35.238.214.110/caixa/caixa/');
//	define('BASEURL', '/cliente-salvum/');

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . 'inc/database.php');

/** caminhos dos templates de header e footer **/
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
//define('USUARIO_INVALIDO', BASEURL . 'errologin.php');

global $sistema;
$sistema = 'inicio';

global $celwhats;
$celwhats = '5511999999999';

global $email_user;
$email_user = 'usuario@email';

global $empresa;
$empresa = 'Salvum Date';

/** Funcoes Comuns do Sistema **/
define('FUNCOES', ABSPATH . 'inc/funcoes.php');
?>
