<?php
$users_controller = new UsersController();

if ($_POST['r'] == 'user-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$user = $users_controller->get($_POST['nombre']);

	if (empty($user)) {
		$template = '
			<div class="container">
				<p class="item  error">No existe el usuario <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("usuarios")
				}
			</script>
		';

		printf($template, $_POST['nombre']);
	} else {
		$template_user = '
			<h2 class="">Eliminar Usuario</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar el Usuario: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="nombre" value="%s">
					<input type="hidden" name="r" value="user-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_user,
			$user[0]['nombre'],
			$user[0]['nombre']
		);
	}
} else if ($_POST['r'] == 'user-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {

	$user = $users_controller->del($_POST['nombre']);

	$template = '
		<div class="container">
			<p class="item  delete">Usuario <b>%s</b> eliminado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("usuarios")
			}
		</script>
	';

	printf($template, $_POST['nombre']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
