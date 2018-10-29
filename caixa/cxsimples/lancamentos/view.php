<?php 
	require_once('functions.php');
	//require_once('delete.php');
	//echo $_GET['id'];
	//echo $_GET['dt']; 
	view($_GET['id'], $_GET['dt']);
?>
<?php $sistema = 'SALVUM - LCTO_CXS_C v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<div class="row">
	<div class="col-xs-12 text-center">
		<h1>Sistema de Caixa</h1>
	</div>
</div>
<h2>Lançamento <?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?> de <?php echo date_format(date_create($cxsimples_lancamentos['cxs_lcto_dt']), 'd/m/Y'); ?> </h2>
<hr>

<dl class="dl-horizontal">
	<dt><?php echo ($cxsimples_tipo['cxs_tipo_entrada'] == 'E' ? 'Entrada' : 'Saida' );?>:</dt>
	<dd> <?php echo $cxsimples_tipo['cxs_tipo_descricao'];?> </dd>
	<dt>Descrição:</dt>
	<dd> <?php echo $cxsimples_lancamentos['cxs_lcto_descricao'];?></dd>
	<dt>Previsto:</dt>
	<dd><?php echo date_format(date_create($cxsimples_lancamentos['cxs_lcto_dt_prevista']), 'd/m/Y'); ?></dd>
	<dt>Valor:</dt>
	<dd><?php echo number_format($cxsimples_lancamentos['cxs_lcto_valor'],2,',','.'); ?></dd>
	<dt>Valor Liquido:</dt>
	<dd><?php echo number_format($cxsimples_lancamentos['cxs_lcto_valor_liq'],2,',','.'); ?></dd>
	<dt>Consolidado:</dt>
	<dd><?php echo ($cxsimples_lancamentos['cxs_lcto_dt_consolidado'] == '0000-00-00' ? '00/00/0000' : date_format(date_create($cxsimples_lancamentos['cxs_lcto_dt_consolidado']), 'd/m/Y'));?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<a href="../index.php" class="btn btn-default">
			<i class="fa fa-chevron-left"></i>
			Tela Inicial
		</a>
		<a href="edit.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id'];?>&dt=<?php echo $cxsimples_lancamentos['cxs_lcto_dt'];?>" 
			class="<?php echo ($cxsimples_lancamentos['cxs_lcto_dt_consolidado'] == '0000-00-00' ? 'btn btn-primary' :'btn btn-primary disabled');?>">
			<i class="fa fa-pencil"></i>
			Editar
		</a>
		<a href="deletar.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id'];?>&dt=<?php echo $cxsimples_lancamentos['cxs_lcto_dt'];?>"
			class="<?php echo ($cxsimples_lancamentos['cxs_lcto_dt_consolidado'] == '0000-00-00' ? 'btn btn-danger' :'btn btn-danger disabled');?>"> 
			<i class="fa fa-trash-o"></i> 
			Excluir
		</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
