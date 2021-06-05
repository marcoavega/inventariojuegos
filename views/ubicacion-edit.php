<?php
$ubicacion_controller = new UbicacionesController();

if ($_POST['r'] == 'ubicacion-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$ubicacion = $ubicacion_controller->get($_POST['id_ubicacion']);

	if (empty($ubicacion)) {
		$template = '
			<div class="">
				<p class="">No existe el id_ubicacion <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("ubicaciones")
				}
			</script>
		';

		printf($template, $_POST['id_ubicacion']);
	} else {

		$template_ubicacion =  '
			<h2 class="">Editar ubicacion</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_ubicacion" value="%s" disabled required>
					<input type="hidden" name="id_ubicacion" value="%s">
				</div>
				<div class="">
					<input type="text" name="ubicacion" placeholder="ubicacion" value="%s" required>
				</div>
				<div class="">
					<input  class="" type="submit" value="Editar">
					<input type="hidden" name="r" value="ubicacion-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_ubicacion,
			$_POST['id_ubicacion'],
			$_POST['id_ubicacion'],
			$_POST['ubicacion']
		);
	}
} else if ($_POST['r'] == 'ubicacion-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_ubicacion = array(
		'id_ubicacion' => $_POST['id_ubicacion'],
		'ubicacion' => $_POST['ubicacion']
	);

	$ubicacion = $ubicacion_controller->set($save_ubicacion);

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