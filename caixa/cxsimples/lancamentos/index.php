<?php 
  require_once('functions.php');
  lista_tipo(); 
?>
<?php $sistema = 'SALVUM - LCTO_CXS_I1 v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php global $now; ?>
<?php $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));?>

<header>
	<div class="row">
		<div class="col-sm-6 text-right h2">
	    	<a class="btn btn-primary" 
				href="lista.php">
				<i class="fa fa-exchange"></i>
				 Lançamentos do Dia
			</a>
	    </div>
	</div>
</header>
<h2>Novo Lançamento</h2>
<form accept-charset="utf-8" action="add.php" method="post">
  <!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-4">
			<label for="name">Valor</label>
			<input type="number" 
			class="form-control"
			id="lcto_valor" 
			name="lcto_valor"
			step=0.01
			min=0.01 
			max=9999999
			requerid>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="campo2">Tipo Movimentação</label>
			<select 
				class="form-control" 
				id="sel1" 
				name="cxs_tipo_id" required>
				<option value=''></option>
				<?php if ($cxsimples_tipos) : ?>
					<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
						<option
							value=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>>
							<?php 
								echo 
								$cxsimples_tipo['cxs_tipo_entrada'] 
								. ' ' . 
								$cxsimples_tipo['cxs_tipo_descricao'];
							?>
						</option>
					<?php endforeach; ?>
				<?php else : ?>
					<option value=0>Não há tipos cadastrados</option>
				<?php endif; ?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Descrição</label>
			<input type="text" 
			class="form-control"
			name="lcto_descricao"
			requerid>
		</div>		
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
		<button type="submit" class="btn btn-primary">Continua</button>
		<a href="../index.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
</form>
<?php include(FOOTER_TEMPLATE); ?>