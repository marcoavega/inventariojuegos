<?php
if ($_POST['r'] == 'ubicacion-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {
	print('
		<h2 class="">Agregar Ubicacion</h2>
		<form method="POST" class="">
			<div class="">
				<input type="text" name="ubicacion" placeholder="ubicacion" required>
			</div>
			<div class="">
				<input  class="" type="submit" value="Agregar">
				<input type="hidden" name="r" value="ubicacion-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');
} else if ($_POST['r'] == 'ubicacion-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$ubicacion_controller = new UbicacionesController();

	$new_ubicacion = array(
		'id_ubicacion' => 0,
		'ubicacion' => $_POST['ubicacion']
	);

	$ubicacion = $ubicacion_controller->set($new_ubicacion);

	$template = '
		<div class="">
			<p class="">ubicacion <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("ubicaciones")
			}
		</script>
	';

	printf($template, $_POST['ubicacion']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}