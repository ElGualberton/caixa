<?php require_once '../config.php'; ?>
<?php require_once DBAPI; ?>
<?php $sistema = 'SALVUM - CAIXA v1.0.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>

<h1>Sistema de Caixa</h1>
<hr />

<?php if ($db) : ?>
	<div class="btn-group-horizontal btn-group-justified">
		<a href="tipo" class="btn btn-default">
			<i class="fa fa-wrench fa-5x"></i>
			<p>Tipos</p>
		</a>
		<a href="lancamentos" class="btn btn-default">
			<i class="fa fa-pencil fa-5x"></i>
			<p>Lançamentos</p>
		</a>
		<a href="diario" class="btn btn-default">
			<i class="fa fa-calendar fa-5x"></i>
			<p>Diario</p>
		</a>
	</div>
	<div class="btn-group-horizontal btn-group-justified">
		<a href="historico" class="btn btn-default">
			<i class="fa fa-history fa-5x"></i>
			<p>Historico</p>
		</a>
		<a href="previa" class="btn btn-default">
			<i class="fa fa-fast-forward fa-5x"></i>
			<p>Prévia</p>
		</a>
	</div>
<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>