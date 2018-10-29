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
		<div class="panel-heading">Deseja Excluir o Tipo <?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?>?</div>
		<div class="panel-body">Essa Operação irá excluir do banco de dados o Tipo <?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?> de movimentação de Caixa.</div>
	</div>
</div>

<hr>

<dl class="dl-horizontal">
	<dt>Descrição: </dt>
	<dd><?php echo $cxsimples_lancamentos['cxs_lcto_descricao']; ?></dd>
	<dt>Movimentação: </dt>
	<dd><?php 
		if($cxsimples_lancamentos['cxs_lcto_entrada'] == 0)
			{echo 'Entrada';}
		else  
			{echo 'Saida';}?>
	</dd>
	<dt>Dias: </dt>
	<dd><?php echo $cxsimples_lancamentos['cxs_lcto_dias']; ?></dd>
	<dt>Indice: </dt>
	<dd><?php echo number_format($cxsimples_lancamentos['cxs_lcto_indice'],8,',','.'); ?></dd>
</dl>

<div>
	<div class="col-md-12">
        <a href="delete.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?>"
			class="btn btn-danger" 
            type="button">
			Sim, eu quero excluir.
		</a>
		<a href="index.php" class="btn btn-default">
			<i class="fa fa-chevron-left"></i>
			Não quero Excluir
		</a>
		<a id="question" 
			class="btn btn-info" 
			href="https://api.whatsapp.com/send?phone=5511952189891&text=Estou%20com%20duvidas%20nesse%20Item%20MODALcxs_lcto_REM">
			Preciso de Ajuda!
		</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
