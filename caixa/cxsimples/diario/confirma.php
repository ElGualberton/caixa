<?php
    require_once('functions.php');
    //var_dump($_POST['diario_dt']);
    index_dia($_POST['diario_dt']);

    $db = open_database();
    $sql = "SELECT IFNULL(MAX(cxs_diario_dt), '0000-00-00') as maxdia FROM cxsimples_diario WHERE cxs_diario_dt >= '" . $_POST['diario_dt'] . "'";
    //echo $sql;	
    $resultado = $db->query($sql);
	$retorno = $resultado->fetch_row();
	//var_dump($resultado);
	if ($retorno[0] !=  '0000-00-00') {
		//var_dump($retorno);
        header('location:podenao.php?dt='.$retorno[0]);
    }
?>
<?php $sistema = 'SALVUM - DIARIO_CXS_CFM v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
            <?php $datatela = explode('-',$_POST['diario_dt']);?>
			<h2>Movimentos do Dia <?php echo $datatela[2] . '/' . $datatela[1] . '/' . $datatela[0]?></h2>
		</div>
	</div>
</header>
<hr>
<div class="panel-group">
	<div class="panel panel-danger">
		<div class="panel-heading">ATENÇÃO!!!</div>
		<div class="panel-body">O processo a seguir irá consolidar todos os lançamentos abaixo com a data selecionada, 
        caso tenha algum lançamento que não foi consolidado mude a data de previsão dele para uma data posterior.</div>
	</div>
</div>
<hr>
<div = 'container'>
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th width="10%">Dia</th>
				<th width="50%">Descrição</th>
				<th width="30%" class="text-right">Valor</th>
				<th width="10%">Opçs</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$resultado = null;
				$anterior = null; 
				$db = open_database();
				$sql = 
				"SELECT 
					date_format(cxs_diario_dt,'%d/%m/%Y') as data_caixa, 
					cxs_diario_final  
				FROM cxsimples_diario 
				WHERE 
					cxs_diario_dt = (SELECT MAX(cxs_diario_dt) from cxsimples_diario)";
				//echo $sql;	
				$resultado = $db->query($sql);
				//echo var_dump($resultado);
				$anterior = $resultado->fetch_assoc();
				//echo var_dump($anterior);
				//echo $retorno[0];
			?>
			<tr>
				<td></td>
				<td><b>SALDO ANTERIOR <?php echo $anterior['data_caixa'];?></b></td>
				<td class="text-right"><b><?php echo number_format($anterior['cxs_diario_final'], 2,',',' '); ?></b></td>
				<td></td>
			</tr>
			<!-- Sugestão da minha amiga Jackeline pintei a linha toda, e ficou ótimo! -->
			<?php if ($cxsimples_lancamentoss) : ?>
				<?php foreach ($cxsimples_lancamentoss as $cxsimples_lancamentos) : ?>
					<tr class="<?php echo ($cxsimples_lancamentos['cxs_tipo_entrada'] == 'E') ?
						'text-primary' 
					: 
						'text-danger'; 
					?>"
					>
						<td><?php echo $cxsimples_lancamentos['cxs_lcto_ddmm']; ?></td>
						<td>
							<?php echo 
							$cxsimples_lancamentos['cxs_tipo_descricao'] . ' ' . 
							$cxsimples_lancamentos['cxs_lcto_descricao'];?>
						</td>
						<td class="text-right">
							<b>
							<?php echo ($cxsimples_lancamentos['cxs_tipo_entrada'] == 'S') ? '-' : null;?>
							<?php echo number_format($cxsimples_lancamentos['cxs_lcto_valor_liq'],2,',','.');?>
							</b>
						</td>
						<td class="actions text-left">
							<div class="btn-group-vertical">
								<a href="edit.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?>&dt=<?php echo $cxsimples_lancamentos['cxs_lcto_dt']; ?>" 
									class="btn btn-sm btn-primary">
									<i class="fa fa-pencil"></i>
									Edit
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="4">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
			<?php
				$resultado = null;
				$retorno = null; 
				$diafech = "'" . $_POST['diario_dt'] . "'";
				$db = open_database();
				$sql = "SELECT (
					(-1 * 
						(
                        select 
                            ifnull(sum(a.cxs_lcto_valor_liq),0.00) 
                            from cxsimples_lancamentos as a, cxsimples_tipo as b 
                        where 
                            a.cxs_lcto_dt_prevista <= $diafech and
                            a.cxs_lcto_dt_consolidado = 0 and 
                            a.cxs_tipo_id = b.cxs_tipo_id and 
                            b.cxs_tipo_entrada = 'S'
						)
					) 
					+ 
					(
                    select 
                        ifnull(sum(a.cxs_lcto_valor_liq),0.00) 
                        from cxsimples_lancamentos as a, cxsimples_tipo as b 
                    where 
                        a.cxs_lcto_dt_prevista <= $diafech and
                        a.cxs_lcto_dt_consolidado = 0 and 
                        a.cxs_tipo_id = b.cxs_tipo_id and 
                        b.cxs_tipo_entrada = 'E'
					)
				) as diario;";
				//echo $sql;	
				$resultado = $db->query($sql);
				//echo var_dump($resultado);
				$retorno = $resultado->fetch_row();
				//echo $retorno[0];
			?>
			<tr>
				<td></td>
				<td><b>TOTAL DO DIA <?php echo $datatela[2] . '/' . $datatela[1] . '/' . $datatela[0]?></b></td>
				<td class="text-right"><b><?php echo number_format($retorno[0], 2,',','.'); ?></b></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><b>Saldo</b></td>
				<td class="text-right"><b>
						<?php echo number_format(($retorno[0] + $anterior['cxs_diario_final']), 2,',','.');?>
				</b></td> 
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
<div = 'container'>
	<form accept-charset="uft-8" action="add.php" method="post">
		<div id="actions" class="row">
			<div name="diario_dt" id="diario_dt" value="<?php echo $_POST['diario_dt'];?>" ></div>
			<?php $_SESSION['diario_dt'] = $_POST['diario_dt'];?>
			<div class="col-sm-6 text-right h2">
				<button type="submit" class="btn btn-primary">
                    Fechar o Dia <?php echo $datatela[2] . '/' . $datatela[1] . '/' . $datatela[0]?>
                </button>
				<a href="index.php" class="btn btn-default">Voltar</a>
			</div>
		</div>
	</form>
</div>
<?php include(FOOTER_TEMPLATE);?>