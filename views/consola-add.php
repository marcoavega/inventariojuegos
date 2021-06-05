<?php
if ($_POST['r'] == 'consola-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {
	print('
		<h2 class="">Agregar Consola</h2>
		<form method="POST" class="">
			<div class="">
				<input type="text" name="consola" placeholder="consola" required>
			</div>
			<div class="">
				<input  class="" type="submit" value="Agregar">
				<input type="hidden" name="r" value="consola-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');
} else if ($_POST['r'] == 'consola-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$consola_controller = new ConsolasController();

	$new_consola = array(
		'id_consola' => 0,
		'consola' => $_POST['consola']
	);

	$consola = $consola_controller->set($new_consola);

	$template = '
		<div class="">
			<p class="">Consola <b>%s</b> salvada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("consolas")
			}
		</script>
	';

	printf($template, $_POST['consola']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
