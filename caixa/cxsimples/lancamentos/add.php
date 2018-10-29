<?php 
  require_once('functions.php');
  require_once DBAPI;
  add();
  lista_tipo();
?>
<?php $sistema = 'SALVUM - LCTO_CXS_I2 v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php global $now; ?>
<?php $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));?>

<h2>Confirmação Novo Lançamento</h2>
<form accept-charset="utf-8" action="add.php" method="post">
  <!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-12">
			<label for="name">Data</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt" 
			name="cxsimples_lancamentos['cxs_lcto_dt']"
			value=<?php echo $now->format('Y-m-d');?>
			readonly>
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
			value=<?php echo $_POST['lcto_valor'];?>>
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
							<?php echo ($cxsimples_tipo['cxs_tipo_id'] == $_POST['cxs_tipo_id']) ? " selected" : " disabled" ?>
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
			value="<?php echo $_POST['lcto_descricao'];?>"
			>
		</div>		
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<?php
				$resultado = null;
				$retorno = null; 
				$id = $_POST['cxs_tipo_id'];
				$vl = $_POST['lcto_valor'];
				$db = open_database();
				$sql = "SELECT ($vl * cxs_tipo_indice) as resultado from cxsimples_tipo where cxs_tipo_id = $id;";
				//echo $sql;	
				$resultado = $db->query($sql);
				//echo var_dump($resultado);
				$retorno = $resultado->fetch_row();
				//echo $retorno[0];
				if($retorno[0] == 0){
					$retorno[0] = $_POST['lcto_valor'];
				}
			?>
			<label for="name">Valor Líquido</label>
			<input type="number" 
			class="form-control"
			id="valLiq" 
			name="cxsimples_lancamentos['cxs_lcto_valor_liq']"
			step=0.01
			min=0.01 
			max=9999999
			requerid
			value=<?php echo number_format($retorno[0], 2,'.',' '); ?>
			>
		</div>
		
		<div class="form-group col-md-4">
			<?php
				$resultado = null;
				$retorno = null; 
				$id = $_POST['cxs_tipo_id'];
				$dt = $now->format('Y-m-d');
				$db = open_database();
				$sql = 
				"SELECT DATE_ADD('$dt', INTERVAL (SELECT cxs_tipo_dias from cxsimples_tipo where cxs_tipo_id = $id) DAY) as resultado;";
				//echo $sql;	
				$resultado = $db->query($sql);
				//echo var_dump($resultado);
				$retorno = $resultado->fetch_row();
				//echo $retorno[0];
			?>
			<label for="name">Data Prevista</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt_prevista"
			name="cxsimples_lancamentos['cxs_lcto_dt_prevista']"
			requerid
			value=<?php echo $retorno[0];?>
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