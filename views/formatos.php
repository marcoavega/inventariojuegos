<?php
print('<h2 class="">GESTIÓN DE FORMATOS</h2>');

$formato_controller = new FormatosController();
$formato = $formato_controller->get();

if (empty($formato)) {
	print('
		<div class="">
			<p class="">No hay Formatos</p>
		</div>
	');
} else {
	$template_formato = '
	<div class="">
		<table>
			<tr>
				<th>Id</th>
				<th>Formato</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="formato-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($formato); $n++) {
		$template_formato .= '
			<tr>
				<td>' . $formato[$n]['id_formato'] . '</td>
				<td>' . $formato[$n]['formato'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="formato-edit">
						<input type="hidden" name="id_formato" value="' . $formato[$n]['id_formato'] . '">
						<input type="hidden" name="formato" value="' . $formato[$n]['formato'] . '">
						<input class="" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="formato-delete">
						<input type="hidden" name="id_formato" value="' . $formato[$n]['id_formato'] . '">
						<input type="hidden" name="formato" value="' . $formato[$n]['formato'] . '">
						<input class="" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_formato .= '
		</table>
	</div>
	';

	print($template_formato);
}