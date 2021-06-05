<?php
if ($_POST['r'] == 'categoria-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {
	print('
		<h2 class="">Agregar Categoria</h2>
		<form method="POST" class="">
			<div class="">
				<input type="text" name="categoria" placeholder="categoria" required>
			</div>
			<div class="">
				<input  class="" type="submit" value="Agregar">
				<input type="hidden" name="r" value="categoria-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');
} else if ($_POST['r'] == 'categoria-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$categoria_controller = new CategoriasController();

	$new_categoria = array(
		'id_categoria' => 0,
		'categoria' => $_POST['categoria']
	);

	$categoria = $categoria_controller->set($new_categoria);

	$template = '
		<div class="">
			<p class="">Categoria <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("categorias")
			}
		</script>
	';

	printf($template, $_POST['categoria']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}