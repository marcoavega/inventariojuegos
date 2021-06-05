<?php
$ubicacion_controller = new UbicacionesController();

if ($_POST['r'] == 'ubicacion-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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
		$template_ubicacion = '
			<h2 class="">Eliminar ubicacion</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar la ubicacion: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id_ubicacion" value="%s">
					<input type="hidden" name="r" value="ubicacion-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_ubicacion,
			$_POST['ubicacion'],
			$_POST['id_ubicacion']
		);
	}
} else if ($_POST['r'] == 'ubicacion-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {


	$ubicacion = $ubicacion_controller->del($_POST['id_ubicacion']);

	$template = '
	<input type="hidden" name="id_ubicacion" value="' . $_POST['id_ubicacion'] . '">
		<div class="">
			<p class="">ubicacion <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("ubicaciones")
			}
		</script>
	';

	printf($template, $_POST['id_ubicacion']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}