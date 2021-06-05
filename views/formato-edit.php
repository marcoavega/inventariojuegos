<?php
$formato_controller = new FormatosController();

if ($_POST['r'] == 'formato-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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

		$template_formato =  '
			<h2 class="">Editar formato</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_formato" value="%s" disabled required>
					<input type="hidden" name="id_formato" value="%s">
				</div>
				<div class="">
					<input type="text" name="formato" placeholder="formato" value="%s" required>
				</div>
				<div class="">
					<input  class="" type="submit" value="Editar">
					<input type="hidden" name="r" value="formato-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_formato,
			$_POST['id_formato'],
			$_POST['id_formato'],
			$_POST['formato']
		);
	}
} else if ($_POST['r'] == 'formato-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_formato = array(
		'id_formato' => $_POST['id_formato'],
		'formato' => $_POST['formato']
	);

	$formato = $formato_controller->set($save_formato);

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