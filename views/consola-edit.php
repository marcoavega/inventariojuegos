<?php
$consola_controller = new ConsolasController();

if ($_POST['r'] == 'consola-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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

		$template_consola =  '
			<h2 class="">Editar Consola</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_consola" value="%s" disabled required>
					<input type="hidden" name="id_consola" value="%s">
				</div>
				<div class="">
					<input type="text" name="consola" placeholder="consola" value="%s" required>
				</div>
				<div class="">
					<input  class="" type="submit" value="Editar">
					<input type="hidden" name="r" value="consola-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_consola,
			$_POST['id_consola'],
			$_POST['id_consola'],
			$_POST['consola']
		);
	}
} else if ($_POST['r'] == 'consola-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_consola = array(
		'id_consola' => $_POST['id_consola'],
		'consola' => $_POST['consola']
	);

	$consola = $consola_controller->set($save_consola);

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