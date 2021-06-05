<?php
print('<h2 class="p1">GESTIÓN DE PRODUCTOS</h2>');

$pd_controller = new ProductosController();
$pd = $pd_controller->get();

if (empty($pd)) {
	print('
		<div class="">
			<p class="">No hay Productos</p>
		</div>
	');
} else {
	$template_pd = '
	<div class="">
		<table>
			<tr>
				<th>Id del producto</th>
				<th>Nombre de producto</th>
				<th>Categoria</th>
				<th>Consola</th>
				<th>Formato</th>
				<th>Codigo de barras SKU</th>
				<th>Ubicación</th>
				<th colspan="3">
					<form method="POST">
						<input type="hidden" name="r" value="producto-add">
						<input class="" type="submit" value="Agregar">
					</form>
				</th>
			</tr>';

	for ($n = 0; $n < count($pd); $n++) {
		$template_pd .= '
			<tr>
				<td>' . $pd[$n]['id_producto'] . '</td>
				<td>' . $pd[$n]['nombre_producto'] . '</td>
				<td>' . $pd[$n]['categoria'] . '</td>
				<td>' . $pd[$n]['consola'] . '</td>
				<td>' . $pd[$n]['formato'] . '</td>
				<td>' . $pd[$n]['codigo_barras'] . '</td>
				<td>' . $pd[$n]['ubicacion'] . '</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="producto-show">
						<input type="hidden" name="id_producto" value="' . $pd[$n]['id_producto'] . '">
						<input class="button  show" type="submit" value="Mostrar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="producto-edit">
						<input type="hidden" name="id_producto" value="' . $pd[$n]['id_producto'] . '">
						<input class="button  edit" type="submit" value="Editar">
					</form>
				</td>
				<td>
					<form method="POST">
						<input type="hidden" name="r" value="producto-delete">
						<input type="hidden" name="id_producto" value="' . $pd[$n]['id_producto'] . '">
						<input class="button  delete" type="submit" value="Eliminar">
					</form>
				</td>
			</tr>
		';
	}

	$template_pd .= '
		</table>
	</div>
	';

	print($template_pd);
}
