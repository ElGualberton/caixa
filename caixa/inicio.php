<?php require_once 'config.php'; ?>
<?php require_once DBAPI; ?>
<?php $sistema = 'SALVUM - EI v1.0.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php $db = open_database(); ?>

<h1>Sistema em Nuvem - Salvum</h1>
<hr />

<?php if ($db) : ?>

<div class="row">
	<div class="col-xs-6 col-sm-3 col-md-2">
		<a href="cxsimples" class="btn btn-default">
			<div class="row">
				<div class="col-xs-12 text-center">
					<i class="fa fa-money fa-5x"></i>
				</div>
				<div class="col-xs-12 text-center">
					<p>Caixa</p>
				</div>
			</div>
		</a>
	</div>
</div>

<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>