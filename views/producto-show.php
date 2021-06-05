<?php
if ($_POST['r'] == 'producto-show' && isset($_POST['id_producto'])) {

	$pd_controller = new ProductosController();

	$pd = $pd_controller->get($_POST['id_producto']);

	if (empty($pd)) {
		printf('
			<div class="container">
				<p class="">Error al cargar la información de la MovieSerie <b>%s</b></p>
			</div>
		', $_POST['id_producto']);
	} else {
		$template_pd = '
			<div class="">
				<h2 class="">%s</h2>
				<p class="">%s</p>
				<p class="">%s</p>
				<p class="">%s</p>
				<p class="">%s</p>
				<p class="">
					<small class="">( %s )</small>
				</p>
				<img class="" src="%s">
				<input class="" type="button" value="Regresar" onclick="history.back()">
			</div>
		';

		$trailer = str_replace('watch?v=', 'embed/', $pd[0]['nombre_producto']);

		printf(
			$template_pd,
			$pd[0]['id_producto'],
			$pd[0]['nombre_producto'],
			$pd[0]['categoria'],
			$pd[0]['consola'],
			$pd[0]['formato'],
			$pd[0]['codigo_barras'],
			$pd[0]['ubicacion'],
			$trailer
		);
	}
} else {
	$controller = new ViewController();
	$controller->load_view('error404');
}
