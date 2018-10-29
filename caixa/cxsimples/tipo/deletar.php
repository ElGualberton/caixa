<?php 
	require_once('functions.php');
	//require_once('delete.php'); 
	view($_GET['id']);
?>
<?php $sistema = 'SALVUM - TIPO_CXS_D v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
</div>

<div class="panel-group">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h1>Deseja Excluir o Tipo <?php echo $cxsimples_tipo['cxs_tipo_id']; ?>?</h1>
		</div>
		<div class="panel-body">Essa Operação irá excluir do banco de dados o Tipo <?php echo $cxsimples_tipo['cxs_tipo_id']; ?> de movimentação de Caixa.</div>
	</div>
</div>

<hr>

<dl class="dl-horizontal">
	<dt>Descrição: </dt>
	<dd><?php echo $cxsimples_tipo['cxs_tipo_descricao']; ?></dd>
	<dt>Movimentação: </dt>
	<dd><?php 
		if($cxsimples_tipo['cxs_tipo_entrada'] == "E")
			{echo 'Entrada';}
		else  
			{echo 'Saida';}?>
	</dd>
	<dt>Dias: </dt>
	<dd><?php echo $cxsimples_tipo['cxs_tipo_dias']; ?></dd>
	<dt>Indice: </dt>
	<dd><?php echo number_format($cxsimples_tipo['cxs_tipo_indice'],8,',','.'); ?></dd>
</dl>

<div class="btn-group-vertical">
	<div class="col-md-12">
		<a href="index.php" class="btn btn-default">
			<i class="fa fa-chevron-left"></i>
			Não quero Excluir
		</a>
		<a id="question" 
			class="btn btn-info" 
			href="https://api.whatsapp.com/send?phone=5511952189891&text=Estou%20com%20duvidas%20nesse%20Item%20MODALCXS_TIPO_REM">
			<i class="fa fa-ambulance fa-1x"></i>
			Preciso de Ajuda!
		</a>
        <a href="delete.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>"
			class="btn btn-danger" 
            type="button">
			<i class="fa fa-trash-o"></i>
			Sim, eu quero excluir.
		</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
