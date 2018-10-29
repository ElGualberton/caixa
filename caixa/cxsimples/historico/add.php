<?php 
  require_once('functions.php');
  lista_tipo(); 
  add();
?>
<?php $sistema = 'SALVUM - LCTO_CXS_I v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>
<?php $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));?>

<h2>Novo Lançamento</h2>
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
			require>
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
			requerid>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="campo2">Tipo Movimentação</label>
			<select 
				class="form-control" 
				id="sel1" 
				name="cxsimples_lancamentos['cxs_tipo_id']" requirie>
				<option></option>
				<?php if ($cxsimples_tipos) : ?>
					<?php foreach ($cxsimples_tipos as $cxsimples_tipo) : ?>
						<option
							dias=<?php echo $cxsimples_tipo['cxs_tipo_dias'];?>
							indice=<?php echo $cxsimples_tipo['cxs_tipo_indice'];?> 
							value=<?php echo $cxsimples_tipo['cxs_tipo_id']; ?>>
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
			requerid>
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
			requerid>
		</div>
		<div class="form-group col-md-4">
			<label for="name">Data Prevista</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt_prevista"
			name="cxsimples_lancamentos['cxs_lcto_dt_prevista']"
			requerid>
		</div>		
		<div class="form-group col-md-4">
			<label for="name">Data Consolidado</label>
			<input type="date" 
			class="form-control"
			id="lcto_dt_consolidado"
			name="cxsimples_lancamentos['cxs_lcto_dt_consolidado']">
		</div>		
	</div>
	<div id="actions" class="row">
		<div class="col-md-12">
		<button type="submit" class="btn btn-primary">Salvar</button>
		<a href="../index.php" class="btn btn-default">Cancelar</a>
		</div>
	</div>
</form>

<script type="text/javascript">
	function id(el) {
	return document.getElementById( el );
	}
	function total( un, qnt ) {
	return parseFloat(un.replace(',', '.'), 10) * parseFloat(qnt.replace(',', '.'), 10);
	}
	window.onload = function() {
		id('sel1').addEventListener('click', function() {
			tratarTipo();
		});
		id('sel1').addEventListener('change', function(){
			tratarTipo();
		});
	}
	
	String.prototype.formatMoney = function() {
	var v = this;
	if(v.indexOf('.') === -1) {
		v = v.replace(/([\d]+)/, "$1,00");
	}
	v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
	v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");
	v = v.replace(/([\d]+)([\d]{3}),([\d]{2})$/, "$1.$2,$3");
	return v;
	};
	function tratarTipo(){
		var e = document.getElementById("sel1");
		var diasV = e.options[e.selectedIndex].dias;
		var indiceV = e.options[e.selectedIndex].indice;
		var valor = document.getElementById("lcto_valor");
		var valorLcto = valor.value;
		if(parseFloat(indiceV) > 0){
			id('valLiq').value = String(parseFloat(valorLcto) * (parseFloat(indiceV)).formatMoney();
		}	  
		var result = total( this.value , id('qnt').value );
		id('total').value = String(result.toFixed(2)).formatMoney();
		if(parceInt(diasV) > 0){
			id('lcto_dt_prevista').value = id('lcto_dt').value;
			id('lcto_dt_consolidado').value = id('lcto_dt').value; 
		} else {
			id('lcto_dt_prevista').value = id('lcto_dt').value;
			id('lcto_dt_consolidado').value = id('lcto_dt').value; 
		}
	};
</script>



<?php include(FOOTER_TEMPLATE); ?>