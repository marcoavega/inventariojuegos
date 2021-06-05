<?php
print('<h2 class="">GESTIÓN DE UBICACIONES</h2>');

$ubicacion_controller = new UbicacionesController();
$ubicacion = $ubicacion_controller->get();

if (empty($ubicacion)) {
	print('
		<div class="">
			<p class="">No hay ubicacions</p>
		</div>
	');
} else {
	$template_ubicacion = '
	<div class="">
		<table>
			<tr>
				<th>Id</th>
				<th>Ubicacion</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="ubicacion-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($ubicacion); $n++) {
		$template_ubicacion .= '
			<tr>
				<td>' . $ubicacion[$n]['id_ubicacion'] . '</td>
				<td>' . $ubicacion[$n]['ubicacion'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="ubicacion-edit">
						<input type="hidden" name="id_ubicacion" value="' . $ubicacion[$n]['id_ubicacion'] . '">
						<input type="hidden" name="ubicacion" value="' . $ubicacion[$n]['ubicacion'] . '">
						<input class="" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="ubicacion-delete">
						<input type="hidden" name="id_ubicacion" value="' . $ubicacion[$n]['id_ubicacion'] . '">
						<input type="hidden" name="ubicacion" value="' . $ubicacion[$n]['ubicacion'] . '">
						<input class="" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_ubicacion .= '
		</table>
	</div>
	';

	print($template_ubicacion);
}
