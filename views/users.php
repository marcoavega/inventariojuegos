<?php
print('<h2 class="p1">GESTIÓN DE USUARIOS</h2>');

$user_controller = new UsersController();
$usuario = $user_controller->get();

if (empty($usuario)) {
	print('
		<div class="container">
			<p class="item  error">No hay Usuarios</p>
		</div>
	');
} else {
	$template_user = '
	<div class="">
		<table>
			<tr>
				<th>Id de usuario</th>
                <th>Nombre</th>
                <th>Password</th>
                <th>Rol</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="user-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($usuario); $n++) {
		$template_user .= '
			<tr>
				<td>' . $usuario[$n]['id_usuario'] . '</td>
				<td>' . $usuario[$n]['nombre'] . '</td>
                <td>' . $usuario[$n]['password'] . '</td>
                <td>' . $usuario[$n]['permisos'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="user-edit">
						<input type="hidden" name="nombre" value="' . $usuario[$n]['nombre'] . '">
						<input type="hidden" name="permisos" value="' . $usuario[$n]['permisos'] . '">
						<input class="button  edit" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="user-delete">
						<input type="hidden" name="nombre" value="' . $usuario[$n]['nombre'] . '">
						<input type="hidden" name="permisos" value="' . $usuario[$n]['permisos'] . '">
						<input class="button  delete" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_user .= '
		</table>
	</div>
	';

	print($template_user);
}