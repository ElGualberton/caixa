<?php 
  require_once('functions.php'); 
  edit();
?>
<?php $sistema = 'SALVUM - TIPO_CXS_A v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<div class="row">
		<div class="col-xs-12 text-center">
			<h1>Sistema de Caixa</h1>
		</div>
</div>
<h2>Atualizar Tipo <?php echo $cxsimples_lancamentos['cxs_lcto_id']; ?> de Movimentação</h2>

<form accept-charset="utf-8" action="edit.php?id=<?php echo $cxsimples_lancamentos['cxs_lcto_id'];?>" method="post">
	<hr />
	<div class="row">
		<div class="form-group col-md-12">
			<label for="name">Descrição</label>
			<input type="text" 
				   class="form-control" 
				   name="cxsimples_lancamentos['cxs_lcto_descricao']" 
				   value="<?php echo $cxsimples_lancamentos['cxs_lcto_descricao']; ?>"
				   require>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="campo2">Movimentação</label>
			<div class="container-fluid form-radio">
				<div class="radio" require>
					<label>
						<input 
						type="radio"
						name="cxsimples_lancamentos['cxs_lcto_entrada']"
						<?php echo ($cxsimples_lancamentos['cxs_lcto_entrada'] == 0) ? "checked" : null; ?>>
							Entrada
					</label>
				</div>
				<div class="radio">
					<label>
						<input 
						type="radio" 
						name="cxsimples_lancamentos['cxs_lcto_entrada']"
						<?php echo ($cxsimples_lancamentos['cxs_lcto_entrada'] == 1) ? "checked" : null; ?>>
							Saída
					</label>
				</div>
			</div>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Dias</label>
			<input type="number" 
				class="form-control" 
				name="cxsimples_lancamentos['cxs_lcto_dias']"
				min="0" max="999"
				value="<?php echo $cxsimples_lancamentos['cxs_lcto_dias']; ?>">
		</div>
		<div class="form-group col-md-4">
			<label for="name">Indice</label>
			<input type="number" 
				class="form-control" 
				name="cxsimples_lancamentos['cxs_lcto_indice']"
				value="<?php echo $cxsimples_lancamentos['cxs_lcto_indice']; ?>">
		</div>		
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="index.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
</form>

<?php include(FOOTER_TEMPLATE); ?>