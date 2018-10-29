<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $sistema;?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
	<style>
		section {
			column-count: 2;
		}
		body 
		{
			padding-top: 50px;
			padding-bottom: 20px;
		}
	</style>
	<!-- <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" 
					class="navbar-toggle collapsed" 
					data-toggle="collapse" 
					data-target="#navbar" 
					aria-expanded="false" 
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo BASEURL; ?>inicio.php" class="navbar-brand">
					<i class="fa fa-cloud fa-1x"></i> 
					Inicio 
				</a>
				<a href="<?php echo BASEURL; ?>logout.php" class="navbar-brand">
					<i class="fa fa-sign-out fa-1x"></i> 
					Sair 
				</a>
				<a class="navbar-brand" href="<?php echo 'https://api.whatsapp.com/send?phone=' . $celwhats . '&text='. $empresa . $sistema ?>">
					<i class="fa fa-ambulance fa-1x"></i> 
					Ajuda
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">          
				<li class="dropdown">
					<a href="#" 
					   class="dropdown-toggle" 
					   data-toggle="dropdown" 
					   role="button" 
					   aria-haspopup="true" 
					   aria-expanded="false">
						Outros <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo BASEURL; ?>usuarios">Usuários</a></li>
						<li><a href="<?php echo BASEURL; ?>cxsimples">Tutoriais</a></li>
					</ul>
				</li>
			</ul>
			</div><!--/.navbar-collapse -->
		</div>
	</nav>
	<?php if(empty($_SESSION['email'])){
		header('location: ' . BASEURL . 'errologin.php');
	} 	  else {
		global $email_user;
		$email_user = $_SESSION['email'];
	}; ?>
	<p style="font-size:70%;"><?php echo $email_user?></p>
	<?php header("Content-type: text/html; charset=utf-8"); ?>
	<main class="container">