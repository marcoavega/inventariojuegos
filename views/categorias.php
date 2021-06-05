<?php
print('<h2 class="p1">GESTIÓN DE CATEGORIA</h2>');

$categoria_controller = new CategoriasController();
$categoria = $categoria_controller->get();

if (empty($categoria)) {
	print('
		<div class="">
			<p class="">No hay Categorias</p>
		</div>
	');
} else {
	$template_categoria = '
	<div class="">
		<table>
			<tr>
				<th>Id</th>
				<th>Categoria</th>
				<th colspan="2">
					<form method="POST">
						<input type="hidden" name="r" value="categoria-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($categoria); $n++) {
		$template_categoria .= '
			<tr>
				<td>' . $categoria[$n]['id_categoria'] . '</td>
				<td>' . $categoria[$n]['categoria'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="categoria-edit">
						<input type="hidden" name="id_categoria" value="' . $categoria[$n]['id_categoria'] . '">
						<input type="hidden" name="categoria" value="' . $categoria[$n]['categoria'] . '">
						<input class="" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="categoria-delete">
						<input type="hidden" name="id_categoria" value="' . $categoria[$n]['id_categoria'] . '">
						<input type="hidden" name="categoria" value="' . $categoria[$n]['categoria'] . '">
						<input class="" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_categoria .= '
		</table>
	</div>
	';

	print($template_categoria);
}
