<?php
if ($_POST['r'] == 'formato-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {
	print('
		<h2 class="">Agregar Formato</h2>
		<form method="POST" class="">
			<div class="">
				<input type="text" name="formato" placeholder="formato" required>
			</div>
			<div class="">
				<input  class="" type="submit" value="Agregar">
				<input type="hidden" name="r" value="formato-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');
} else if ($_POST['r'] == 'formato-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$formato_controller = new FormatosController();

	$new_formato = array(
		'id_formato' => 0,
		'formato' => $_POST['formato']
	);

	$formato = $formato_controller->set($new_formato);

	$template = '
		<div class="">
			<p class="">Formato <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("formatos")
			}
		</script>
	';

	printf($template, $_POST['formato']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}