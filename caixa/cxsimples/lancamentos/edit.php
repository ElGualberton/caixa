<?php 
  require_once('functions.php');
  require_once DBAPI;
  //view($_GET['id'], $_GET['dt']);
  lista_tipo();
  edit();
?>
<?php $sistema = 'SALVUM - LCTO_CXS_ALT v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<?php 
	unset($_SESSION['cxs_lcto_dt']);
	unset($_SESSION['cxs_lcto_id']);
	$_SESSION['cxs_lcto_dt'] = $cxsimples_lancamentos['cxs_lcto_dt'];
	$_SESSION['cxs_lcto_id'] = $cxsimples_lancamentos['cxs_lcto_id'];
?>
<h2>Alteração de Lançamento</h2>
<form accept-charset="utf-8" action="altera.php" method="post">
  <!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-12">
			<label for="name">Data</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt" 
			name="cxsimples_lancamentos['cxs_lcto_dt']"
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_dt'];?>"
			readonly>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Código Lançamento</label>
			<input type="number" 
			class="form-control"
			id="lcto_valor" 
			name="cxsimples_lancamentos['cxs_lcto_id']"
			step=1
			min=1 
			max=9999999
			readonly
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_id'];?>">
		</div>
		<div class="form-group col-md-4">
			<label for="name">Valor</label>
			<input type="number" 
			class="form-control"
			id="lcto_valor" 
			name="cxsimples_lancamentos['cxs_lcto_valor']"
			step=0.01
			min=0.01 
			max=9999999
			readonly
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_valor'];?>">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="campo2">Tipo Movimentação</label>
			<select 
				class="form-control" 
				id="sel1" 
				name="cxsimples_lancamentos['cxs_tipo_id']" requirid>
				<option></option>
				<?php if ($cxsimples_tipos) : ?>
					<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
						<option
							value=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>
							<?php echo ($cxsimples_tipo['cxs_tipo_id'] == $cxsimples_lancamentos['cxs_tipo_id']) ? " selected" : " disabled" ?>
							> <!-- " disabled" -->
							<?php echo $cxsimples_tipo['cxs_tipo_descricao'];?>
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
			step= 0.01 
			name="cxsimples_lancamentos['cxs_lcto_descricao']"
			requerid
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_descricao'];?>"
			>
		</div>		
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="name">Valor Líquido</label>
			<input type="number" 
			class="form-control"
			id="valLiq" 
			name="cxsimples_lancamentos['cxs_lcto_valor_liq']"
			step=0.01
			min=0.01 
			max=9999999
			requerid
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_valor_liq']; ?>"
			>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Data Prevista</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt_prevista"
			name="cxsimples_lancamentos['cxs_lcto_dt_prevista']"
			requerid
			value="<?php echo $cxsimples_lancamentos['cxs_lcto_dt_prevista'];?>"
			>
		</div>		
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
		<button type="submit" class="btn btn-primary">Salvar</button>
		<a href="index.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
</form>

<script>
	<?php echo "var dias = [''";?>
	<?php if ($cxsimples_tipos) : ?>
		<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
			<?php echo ",'" . $cxsimples_tipo['cxs_tipo_dias'] . "'";?>
		<?php endforeach; ?>
	<?php else : ?>
		<?php echo ",''";?>
	<?php endif; ?>
	<?php echo "];";?>

	<?php echo "var indice = [''";?>
	<?php if ($cxsimples_tipos) : ?>
		<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
			<?php echo "," . ($cxsimples_tipo['cxs_tipo_indice'] == 0 ? 1 : $cxsimples_tipo['cxs_tipo_indice']);?>
		<?php endforeach; ?>
	<?php else : ?>
		<?php echo ",''";?>
	<?php endif; ?>
	<?php echo "];";?>

	document.getElementById("sel1").addEventListener('change', function () {
		document.getElementById("valLiq").value = indice[this.selectedIndex];
		document.getElementById("lcto_dt_prevista").value = <?php echo (date_add($now,date_interval_create_from_date_string("<script>dias[this.selectedIndex]</script>")));?>;
	});
</script>
<?php include(FOOTER_TEMPLATE); ?>