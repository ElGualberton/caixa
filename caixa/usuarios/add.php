<?php 
  require_once('functions.php'); 
  add();
?>
<?php $sistema = 'SALVUM - USUARIOS_I v1.0.17' ?>
<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Usuário</h2>
<form accept-charset="utf-8" action="add.php" method="post">
  <!-- area de campos do form -->
	<hr />
	<div class="row">
		<div class="form-group col-md-12">
			<label for="name">E-mail</label>
			<input type="email" 
			class="form-control" 
			name="usuarios['email']"
			require>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label for="name">Nível</label>
			<select 
				class="form-control" 
				id="usuarios['nivel']" 
				name="usuarios['nivel']" 
				requirie>
       			<option value="0" <?php echo ($_SESSION['nivel'] < '0') ? "disabled" : null; ?>>0</option>
       			<option value="1" <?php echo ($_SESSION['nivel'] < '1') ? "disabled" : null; ?>>1</option>
       			<option value="2" <?php echo ($_SESSION['nivel'] < '2') ? "disabled" : null; ?>>2</option>
       			<option value="3" <?php echo ($_SESSION['nivel'] < '3') ? "disabled" : null; ?>>3</option>
       			<option value="4" <?php echo ($_SESSION['nivel'] < '4') ? "disabled" : null; ?>>4</option>
       			<option value="5" <?php echo ($_SESSION['nivel'] < '5') ? "disabled" : null; ?>>5</option>
       			<option value="6" <?php echo ($_SESSION['nivel'] < '6') ? "disabled" : null; ?>>6</option>
       			<option value="7" <?php echo ($_SESSION['nivel'] < '7') ? "disabled" : null; ?>>7</option>
       			<option value="8" <?php echo ($_SESSION['nivel'] < '8') ? "disabled" : null; ?>>8</option>
       			<option value="9" <?php echo ($_SESSION['nivel'] < '9') ? "disabled" : null; ?>>9</option>
    		</select>
		</div>
		<div class="form-group col-md-12">
			<label for="name">Senha</label>
			<input type="password" 
			class="form-control" 
			name="usuarios['senha']"
			require>
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