<?php 
	require_once('functions.php');
	//require_once('delete.php'); 
	view($_GET['dt']);
?>
<?php $sistema = 'SALVUM - DIARIO_CXS_PDN v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php 
	$tmpdata = null;
	$dt_edit = null;
	$dt_edit_ant = null;
	//var_dump($cxsimples_diario);
    $tmpdata = explode('-', $cxsimples_diario['cxs_diario_dt']);
    $dt_edit = $tmpdata[2] . '/' . $tmpdata[1] . '/' . $tmpdata[0];
	$tmpdata = null;
	$tmpdata = explode('-', $cxsimples_diario['cxs_diario_dt_anterior']);
    $dt_edit_ant = $tmpdata[2] . '/' . $tmpdata[1] . '/' . $tmpdata[0];
?>  
<div class="row">
	<div class="col-xs-12 text-center">
		<h1>Sistema de Caixa</h1>
	</div>
</div>
<hr>
<div class="panel-group">
	<div class="panel panel-danger">
		<div class="panel-heading">ATENÇÃO!!!</div>
		<div class="panel-body">A data selecionada para o fechamento já está englobada na data abaixo listada.</div>
	</div>
</div>
<hr>
<h2>Resumo do Dia <?php echo $dt_edit; ?></h2>
<hr>

<dl class="dl-horizontal">
	<dt>Saldo Anterior: </dt>
	<dd><?php echo number_format($cxsimples_diario['cxs_diario_inicial'],2,',','.'); ?></dd>
	<dt>Dia Anterior: </dt>
	<dd><?php echo $dt_edit_ant; ?></dd>
	<dt>Saldo Final: </dt>
	<dd><?php echo number_format($cxsimples_diario['cxs_diario_final'],2,',','.'); ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<a href="index.php" class="btn btn-default">
			<i class="fa fa-chevron-left"></i>
			Voltar
		</a>
	</div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
