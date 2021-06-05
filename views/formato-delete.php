<?php
$formato_controller = new FormatosController();

if ($_POST['r'] == 'formato-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$formato = $formato_controller->get($_POST['id_formato']);

	if (empty($formato)) {
		$template = '
			<div class="">
				<p class="">No existe el id_formato <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("formatos")
				}
			</script>
		';

		printf($template, $_POST['id_formato']);
	} else {
		$template_formato = '
			<h2 class="">Eliminar formato</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar la formato: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id_formato" value="%s">
					<input type="hidden" name="r" value="formato-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_formato,
			$_POST['formato'],
			$_POST['id_formato']
		);
	}
} else if ($_POST['r'] == 'formato-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {


	$formato = $formato_controller->del($_POST['id_formato']);

	$template = '
	<input type="hidden" name="id_formato" value="' . $_POST['id_formato'] . '">
		<div class="">
			<p class="">Formato <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("formatos")
			}
		</script>
	';

	printf($template, $_POST['id_formato']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}