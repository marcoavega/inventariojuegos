<?php
$consola_controller = new ConsolasController();

if ($_POST['r'] == 'consola-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$consola = $consola_controller->get($_POST['id_consola']);

	if (empty($consola)) {
		$template = '
			<div class="">
				<p class="">No existe el id_consola <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("consolas")
				}
			</script>
		';

		printf($template, $_POST['id_consola']);
	} else {
		$template_consola = '
			<h2 class="">Eliminar Consola</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar la consola: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id_consola" value="%s">
					<input type="hidden" name="r" value="consola-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_consola,
			$_POST['consola'],
			$_POST['id_consola']
		);
	}
} else if ($_POST['r'] == 'consola-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {


	$consola = $consola_controller->del($_POST['id_consola']);

	$template = '
	<input type="hidden" name="id_consola" value="' . $_POST['id_consola'] . '">
		<div class="">
			<p class="">Consola <b>%s</b> eliminada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("consolas")
			}
		</script>
	';

	printf($template, $_POST['id_consola']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
