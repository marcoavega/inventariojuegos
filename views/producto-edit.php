<?php
$pd_controller = new ProductosController();

if ($_POST['r'] == 'producto-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$pd = $pd_controller->get($_POST['id_producto']);

	if (empty($pd)) {
		$template = '
			<div class="">
				<p class="">No existe el producto <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("productos")
				}
			</script>
		';

		printf($template, $_POST['nombre_producto']);
	} else {

		$categoria_controller = new CategoriasController();
		$categoria = $categoria_controller->get();
		$categoria_select = '';
		for ($a = 0; $a < count($categoria); $a++) {
			$selected = ($pd[0]['categoria'] == $categoria[$a]['categoria']) ? 'selected' : '';
			$categoria_select .= '<option value="' . $categoria[$a]['id_categoria'] . '"' . $selected . '>' . $categoria[$a]['categoria'] . '</option>';
		}

		$consola_controller = new ConsolasController();
		$consola = $consola_controller->get();
		$consola_select = '';
		for ($b = 0; $b < count($consola); $b++) {
			$selected_consola = ($pd[0]['consola'] == $consola[$b]['consola']) ? 'selected' : '';
			$consola_select .= '<option value="' . $consola[$b]['id_consola'] . '"' . $selected_consola . '>' . $consola[$b]['consola'] . '</option>';
		}

		$formato_controller = new FormatosController();
		$formato = $formato_controller->get();
		$formato_select = '';
		for ($c = 0; $c < count($formato); $c++) {
			$selected_formato = ($pd[0]['formato'] == $formato[$c]['formato']) ? 'selected' : '';
			$formato_select .= '<option value="' . $formato[$c]['id_formato'] . '"' . $selected_formato . '>' . $formato[$c]['formato'] . '</option>';
		}

		$ubicacion_controller = new UbicacionesController();
		$ubicacion = $ubicacion_controller->get();
		$ubicacion_select = '';
		for ($d = 0; $d < count($ubicacion); $d++) {
			$selected_ubicacion = ($pd[0]['ubicacion'] == $ubicacion[$d]['ubicacion']) ? 'selected' : '';
			$ubicacion_select .= '<option value="' . $ubicacion[$d]['id_ubicacion'] . '"' . $selected_ubicacion . '>' . $ubicacion[$d]['ubicacion'] . '</option>';
		}

		$template_pd = '
			<h2 class="">Editar producto</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_producto" value="%s" disabled required>
					<input type="hidden" name="id_producto" value="%s">
				</div>
				<div class="">
					<input type="text" name="nombre_producto" placeholder="Nombre producto" value="%s" required>
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
					<input type="text" name="codigo_barras" placeholder="Código de barras" value="%s" required>
				</div>
			<div class="">
				<select name="ubicacion" placeholder="ubicacion" required>
					<option value="">ubicacion</option>
					%s
				</select>
			</div>
				
				<div class="p_25">
					<input  class="button  edit" type="submit" value="Editar">
					<input type="hidden" name="r" value="producto-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_pd,
			$pd[0]['id_producto'],
			$pd[0]['id_producto'],
			$pd[0]['nombre_producto'],
			$categoria_select,
			$consola_select,
			$formato_select,
			$pd[0]['codigo_barras'],
			$ubicacion_select
		);
	}
} else if ($_POST['r'] == 'producto-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_pd = array(
		'id_producto' =>  $_POST['id_producto'],
		'nombre_producto' =>  $_POST['nombre_producto'],
		'categoria' =>  $_POST['categoria'],
		'consola' =>  $_POST['consola'],
		'formato' =>  $_POST['formato'],
		'codigo_barras' =>  $_POST['codigo_barras'],
		'ubicacion' =>  $_POST['ubicacion']
	);

	$pd = $pd_controller->set($save_pd);

	$template = '
		<div class="container">
			<p class="item  edit">producto <b>%s</b> salvado</p>
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
