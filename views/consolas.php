<?php
print('<h2 class="">GESTIÓN DE CONSOLAS</h2>');

$consola_controller = new ConsolasController();
$consola = $consola_controller->get();

if (empty($consola)) {
	print('
		<div class="">
			<p class="">No hay Consolas</p>
		</div>
	');
} else {
	$template_consola = '
	<div class="">
		<table>
			<tr>
				<th>Id</th>
				<th>Consola</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="consola-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($consola); $n++) {
		$template_consola .= '
			<tr>
				<td>' . $consola[$n]['id_consola'] . '</td>
				<td>' . $consola[$n]['consola'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="consola-edit">
						<input type="hidden" name="id_consola" value="' . $consola[$n]['id_consola'] . '">
						<input type="hidden" name="consola" value="' . $consola[$n]['consola'] . '">
						<input class="" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="consola-delete">
						<input type="hidden" name="id_consola" value="' . $consola[$n]['id_consola'] . '">
						<input type="hidden" name="consola" value="' . $consola[$n]['consola'] . '">
						<input class="" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_consola .= '
		</table>
	</div>
	';

	print($template_consola);
}
