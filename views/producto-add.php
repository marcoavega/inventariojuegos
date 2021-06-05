<?php
if ($_POST['r'] == 'producto-add' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$categoria_controller = new CategoriasController();
	$categoria = $categoria_controller->get();
	$categoria_select = '';
	for ($n = 0; $n < count($categoria); $n++) {
		$categoria_select .= '<option value="' . $categoria[$n]['id_categoria'] . '">' . $categoria[$n]['categoria'] . '</option>';
	}

	$consola_controller = new ConsolasController();
	$consola = $consola_controller->get();
	$consola_select = '';
	for ($n = 0; $n < count($consola); $n++) {
		$consola_select .= '<option value="' . $consola[$n]['id_consola'] . '">' . $consola[$n]['consola'] . '</option>';
	}

	$formato_controller = new FormatosController();
	$formato = $formato_controller->get();
	$formato_select = '';
	for ($n = 0; $n < count($formato); $n++) {
		$formato_select .= '<option value="' . $formato[$n]['id_formato'] . '">' . $formato[$n]['formato'] . '</option>';
	}

	$ubicacion_controller = new UbicacionesController();
	$ubicacion = $ubicacion_controller->get();
	$ubicacion_select = '';
	for ($n = 0; $n < count($ubicacion); $n++) {
		$ubicacion_select .= '<option value="' . $ubicacion[$n]['id_ubicacion'] . '">' . $ubicacion[$n]['ubicacion'] . '</option>';
	}

	printf('
		<h2 class="">Agregar producto</h2>
		<form method="POST" class="">
			<div class="">
				<input type="hidden" name="id_producto" value="0">
			</div>
			<div class="">
				<input type="text" name="nombre_producto" placeholder="Nombre producto" required>
			</div>
			<div class="">
				<select name="categoria" placeholder="categoria" required>
					<option value="">categoria</option>
					%s
				</select>
			</div>
			<div class="">
				<select name="consola" placeholder="consola" required>
					<option value="">consola</option>
					%s
				</select>
			</div>
			<div class="">
				<select name="formato" placeholder="formato" required>
					<option value="">formato</option>
					%s
				</select>
			</div>
			<div class="">
				<input type="text" name="codigo_barras" placeholder="Codigo de barras">
			</div>
			<div class="">
				<select name="ubicacion" placeholder="ubicacion" required>
					<option value="">ubicacion</option>
					%s
				</select>
			</div>
			<div class="">
				<input  class="button  add" type="submit" value="Agregar">
				<input type="hidden" name="r" value="producto-add">
				<input type="hidden" name="crud" value="set">
			</div>
		</form>
	', $categoria_select, $consola_select, $formato_select, $ubicacion_select);
} else if ($_POST['r'] == 'producto-add' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {
	$pd_controller = new ProductosController();

	$new_pd = array(
		'id_producto' =>  $_POST['id_producto'],
		'nombre_producto' =>  $_POST['nombre_producto'],
		'categoria' =>  $_POST['categoria'],
		'consola' =>  $_POST['consola'],
		'formato' =>  $_POST['formato'],
		'codigo_barras' =>  $_POST['codigo_barras'],
		'ubicacion' =>  $_POST['ubicacion']
	);

	$pd = $pd_controller->set($new_pd);

	$template = '
		<div class="container">
			<p class="item  add">Producto <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("productos")
			}
		</script>
	';

	printf($template, $_POST['nombre_producto']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}
