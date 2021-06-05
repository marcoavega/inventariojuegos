<?php
$users_controller = new UsersController();

if ($_POST['r'] == 'user-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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
		$role_admin = ($user[0]['permisos'] == 'admin') ? 'checked' : '';
		$role_user = ($user[0]['permisos'] == 'user') ? 'checked' : '';

		$template_user = '
			<h2 class="">Editar Usuario</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="Id" value="%s" disabled required>
					<input type="hidden" name="id_usuario" value="%s">
				</div>
				<div class="">
					<input type="text" name="nombre" placeholder="nombre" value="%s" required>
				</div>
				<div class="">
					<input type="password" name="password" placeholder="password" value="%s" required>
				</div>
				<div class="p_25">
					<input type="radio" name="permisos" id="admin" value="admin" %s required><label for="admin">Administrador</label>
					<input type="radio" name="permisos" id="noadmin" value="user" %s required><label for="noadmin">Usuario</label>
				</div>
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="user-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_user,
			$user[0]['id_usuario'],
			$user[0]['id_usuario'],
			$user[0]['nombre'],
			$user[0]['password'],
			//$user[0]['pass'],
			$role_admin,
			$role_user
		);
	}
} else if ($_POST['r'] == 'user-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_user = array(
		'id_usuario' =>  $_POST['id_usuario'],
		'nombre' =>  $_POST['nombre'],
		'password' =>  $_POST['password'],
		'permisos' =>  $_POST['permisos']
	);

	$user = $users_controller->set($save_user);

	$template = '
		<div class="container">
			<p class="item  edit">Usuario <b>%s</b> salvado</p>
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
