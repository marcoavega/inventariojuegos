<?php
$pd_controller = new ProductosController();

if ($_POST['r'] == 'producto-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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
		$template_pd = '
			<h2 class="">Eliminar producto</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar el producto: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="button  delete" type="submit" value="SI">
					<input class="button  add" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id_producto" value="%s">
					<input type="hidden" name="nombre_producto" value="%s">
					<input type="hidden" name="r" value="producto-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_pd,
			$pd[0]['nombre_producto'],
			$pd[0]['id_producto'],
			$pd[0]['nombre_producto']
		);
	}
} else if ($_POST['r'] == 'producto-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {

	$pd = $pd_controller->del($_POST['id_producto']);

	$template = '
		<div class="">
			<p class="">producto <b>%s</b> eliminado</p>
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