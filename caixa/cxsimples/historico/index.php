<?php
    require_once('functions.php');
    index();
?>
<?php $sistema = 'SALVUM - HISTORICO_CXS_L v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<header>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h2>Listagem dos Movimentos Diarios</h2>
		</div>
		<div class="col-sm-6 text-right h2">
			<a class="btn btn-default" 
				href="detalhado.php">
				<i class="fa fa-list"></i>
				 Detalhado
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
				<th class="text-center" width="25%">Data</th>
				<th class="text-center" width="50%">Vl.Caixa</th>
				<th width="25%">Opção</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($cxsimples_diarios) : ?>
				<?php foreach ($cxsimples_diarios as $cxsimples_diario) : ?>

					<tr class="<?php echo ($cxsimples_diario['cxs_diario_final'] > 0) ?
							'text-primary' 
						: 
							'text-danger'; 
						?>"
					>
						<td class="text-center"><?php
							$data_edit = null; 
							$data_edit = explode('-', $cxsimples_diario['cxs_diario_dt']); 
							echo $data_edit[2] . '/' . $data_edit[1] . '/' . $data_edit[0];
							?>
						</td>
						<td class="text-center">
							<strong>
								<?php echo number_format($cxsimples_diario['cxs_diario_final'],2,',','.');?>
							</strong>
						</td>
						<td class="actions text-left">
							<div class="btn-group-vertical">
								<a href="listadia.php?dt=<?php echo $cxsimples_diario['cxs_diario_dt']; ?>" 
									class="btn btn-sm btn-success"> 
									<i class="fa fa-eye"></i> Ver
								</a>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<?php include(FOOTER_TEMPLATE); ?>