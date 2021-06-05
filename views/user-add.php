<?php
if ($_POST['r'] == 'user-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {
	print('
		<h2 class="">Agregar Usuario</h2>
		<form method="POST" class="">
			<div class="">
				<input type="text" placeholder="Id" value="" disabled>
				<input type="hidden" name="id_usuario" value="0">
			</div>
			<div class="">
				<input type="text" name="nombre" placeholder="Nombre" required>
			</div>
			<div class="">
				<input type="text" name="password" placeholder="Password" required>
			</div>
			<div class="">
				<input type="radio" name="permisos" id="admin" value="admin" required><label for="admin">Administrador</label>
				<input type="radio" name="permisos" id="noadmin" value="user" required><label for="noadmin">Usuario</label>
			</div>
			<div class="">
				<input  class="" type="submit" value="Agregar">
				<input type="hidden" name="r" value="user-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	');
} else if ($_POST['r'] == 'user-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$users_controller = new UsersController();

	$new_user = array(
		'id_usuario' => $_POST['id_usuario'],
		'nombre' =>  $_POST['nombre'],
		'password' =>  $_POST['password'],
		'permisos' =>  $_POST['permisos'],
	);

	$user = $users_controller->set($new_user);

	$template = '
		<div class="">
			<p class="">Usuario <b>%s</b> salvado</p>
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