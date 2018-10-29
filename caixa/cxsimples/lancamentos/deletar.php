<?php 
	require_once('functions.php');
	//require_once('delete.php'); 
	view($_GET['id'], $_GET['dt']);
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
		<div class="panel-heading">Deseja Excluir o Lançamento <?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?> de <?php echo date_format(date_create($cxsimples_lancamentos['cxs_lcto_dt']), 'd/m/Y');?> ?</div>
		<div class="panel-body">Essa Operação irá excluir do banco de dados o Lançamento da movimentação do Caixa.</div>
	</div>
</div>

<hr>
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

<div>
	<div class="col-md-12">
        <a href="delete.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id'];?>&dt=$cxsimples_lancamentos['cxs_lcto_dt'];?>"
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