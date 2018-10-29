<?php
	require_once('functions.php');
	$hoje = null;
	$hoje = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	index_dia($hoje);
?>
<?php $sistema = 'SALVUM - DIARIO_CXS_L v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h2>Movimentos do Dia</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" 
				href="../lancamentos/index.php">
				<i class="fa fa-plus"></i>
				 Novo Lançamento
			</a>
	    	<a class="btn btn-default" 
				href="index.php">
				<i class="fa fa-refresh"></i>
				 Atualizar
			</a>
	    </div>
	</div>
</header>
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
								<a href="../lancamentos/view.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?>&dt=<?php echo $cxsimples_lancamentos['cxs_lcto_dt']; ?>" 
									class="btn btn-sm btn-success"> 
									<i class="fa fa-eye"></i> Ver
								</a>
								<a href="../lancamentos/edit.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?>&dt=<?php echo $cxsimples_lancamentos['cxs_lcto_dt']; ?>" 
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
				$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
				$hoje = "'" . $now->format('Y-m-d') . "'";
				$db = open_database();
				$sql = "SELECT (
					(-1 * 
						(
							select 
								ifnull(sum(a.cxs_lcto_valor_liq), 0.00) 
								from cxsimples_lancamentos as a, cxsimples_tipo as b 
							where 
								a.cxs_lcto_dt_prevista <= $hoje and
								a.cxs_lcto_dt_consolidado = 0 and 
								a.cxs_tipo_id = b.cxs_tipo_id and 
								b.cxs_tipo_entrada = 'S'
						)
					) 
					+ 
					(
						select 
							sum(a.cxs_lcto_valor_liq) 
							from cxsimples_lancamentos as a, cxsimples_tipo as b 
						where 
							a.cxs_lcto_dt_prevista <= $hoje and
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
				<td><b>TOTAL CONSOLIDADO</b></td>
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
	<form accept-charset="uft-8" action="confirma.php" method="post">
		<div class="row">
			<div class="form-group col-md-12">
				<label for="name">Data para Fechamento: </label>
				<input type="date" 
				class="form-control"
				id="diario_dt" 
				name="diario_dt"
				require>
			</div>
		</div>
		<div id="actions" class="row">
			<div class="col-sm-6 text-right h2">
				<button type="submit" class="btn btn-primary">Continua</button>
				<a href="../index.php" class="btn btn-default">Voltar</a>
			</div>
		</div>
	</form>
</div>
<?php include(FOOTER_TEMPLATE); ?>