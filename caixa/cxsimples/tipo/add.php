<?php 
  require_once('functions.php'); 
  add();
?>
<?php $sistema = 'SALVUM - TIPO_CXS_I v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Tipo de Movimentação</h2>
<form accept-charset="utf-8" action="add.php" method="post">
  <!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-12">
			<label for="name">Descrição</label>
			<input type="text" 
			class="form-control" 
			name="cxsimples_tipo['cxs_tipo_descricao']"
			require>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="campo2">Movimentação</label>
			<select class="form-control" id="sel1" name="cxsimples_tipo['cxs_tipo_entrada']" requirie>
       			<option value="E">Entrada</option>
       			<option value="S">Saida</option>
    		</select>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Dias</label>
			<input type="number" 
			class="form-control" 
			name="cxsimples_tipo['cxs_tipo_dias']"
			min="0" max="999">
		</div>
		<div class="form-group col-md-4">
			<label for="name">Indice</label>
			<input type="number" 
			class="form-control" 
			step = 0.00000001
			name="cxsimples_tipo['cxs_tipo_indice']"
			min="0" max="999">
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