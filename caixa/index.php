<?php session_start(); ?>
<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SALVUM - EI v1.0.0.17</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://storage.googleapis.com/salvum-css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://storage.googleapis.com/salvum-css/style.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<!-- Ouvindo LINIKER, elx canta muito!!!! -->
<body>


<main class="container">
<?php $db = open_database(); ?>

<img src="https://storage.googleapis.com/salvum-imagens/logo-transparente.gif" 
	class="img-responsive text-center" 
	width=50% height=50%>
<h1>Sistema <?php echo $empresa;?></h1>
<hr />

<?php if ($db) : ?>
	<form action="logar.php" method="post">
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
			<input type="text" class="form-control" name="usuario_email" placeholder="Email" required>
		</div>
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			<input type="password" class="form-control" name="usuario_senha" placeholder="Senha" required>
		</div>
		<br>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Entrar</button>
				<a href="index.php" class="btn btn-default">Cancelar</a>
				<a class='btn btn-info' href="https://api.whatsapp.com/send?phone=5511952189891&text=Estou%20na%20tela%20de%20Login"> Precisa de ajuda? </a>
			</div>
		</div>
	</form>
<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>