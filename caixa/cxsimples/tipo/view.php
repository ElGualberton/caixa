<?php 
	require_once('functions.php');
	//require_once('delete.php'); 
	contar($_GET['id']);
	view($_GET['id']);
?>
<?php $sistema = 'SALVUM - TIPO_CXS_C v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<div class="row">
	<div class="col-xs-12 text-center">
		<h1>Sistema de Caixa</h1>
	</div>
</div>
<h2>Tipo de Movimentação <?php echo $cxsimples_tipo['cxs_tipo_id']; ?></h2>
<hr>

<dl class="dl-horizontal">
	<dt>Descrição: </dt>
	<dd><?php echo $cxsimples_tipo['cxs_tipo_descricao']; ?></dd>
	<dt>Movimentação: </dt>
	<dd><?php 
		if($cxsimples_tipo['cxs_tipo_entrada'] == 'E')
			{echo 'Entrada';}
		else  
			{echo 'Saida';}?>
	</dd>
	<dt>Dias: </dt>
	<dd><?php echo $cxsimples_tipo['cxs_tipo_dias']; ?></dd>
	<dt>Indice: </dt>
	<dd><?php echo number_format($cxsimples_tipo['cxs_tipo_indice'],8,',','.'); ?></dd>
	<dt>Quantidade de Lançamentos: <dt>
	<dd><?php echo $quantidade_lancamento['0']; ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<a href="index.php" class="btn btn-default">
			<i class="fa fa-chevron-left"></i>
			Voltar
		</a>
		<a href="edit.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>" 
			class="btn btn-primary">
			<i class="fa fa-pencil"></i>
			Editar
		</a>
		<a href="deletar.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>"
			class= "<?php echo intval($quantidade_lancamento['0']) > 0 ? 'btn btn-danger disabled' : 'btn btn-danger'; ?>">
			<i class="fa fa-trash-o"></i> 
			Excluir
		</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
