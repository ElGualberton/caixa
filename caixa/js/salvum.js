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