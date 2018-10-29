<?php
    require_once('functions.php');
    index();
?>
<?php $sistema = 'SALVUM - TIPO_CXS_L v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php //Exatamente ás 00:50 do dia 27/10/2017 eu terminei a primeira manutanção da Salvum, 
	 //essa manutenção de tipo, isso ao Som de Living la vida loca 
	 //versão Patu Fu Musica de Brinquedo, ouça, vale a pena!  ?>

<header>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h2>Tipos de Movimento</h2>
		</div>
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" 
				href="add.php">
				<i class="fa fa-plus"></i>
				 Novo Tipo
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
				<th width="10%">ID</th>
				<th width="50%">Descrição</th>
				<th width="15%">E/S</th>
				<th width="25%">Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($cxsimples_tipos) : ?>
				<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
					<tr>
						<td><?php echo $cxsimples_tipo['cxs_tipo_id']; ?></td>
						<td><?php echo $cxsimples_tipo['cxs_tipo_descricao'];
								if($cxsimples_tipo['cxs_tipo_dias'] > 0){
									echo '<b> Dias: </b>';
									echo $cxsimples_tipo['cxs_tipo_dias'];
								}
								if($cxsimples_tipo['cxs_tipo_indice'] <> 0){
									echo '<b> Indice: </b>';
									echo number_format($cxsimples_tipo['cxs_tipo_indice'],2,',','.');
								} 
							?>
						</td>
						<td class="text-left"><?php echo $cxsimples_tipo['cxs_tipo_entrada'];?></td>
						<td class="actions text-left">
							<div class="btn-group-vertical">
								<a href="view.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>" 
									class="btn btn-sm btn-success"> 
									<i class="fa fa-eye"></i> Ver
								</a>
								<a href="edit.php?id=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>" 
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
					<td colspan="6">Nenhum registro encontrado.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<?php include(FOOTER_TEMPLATE); ?>