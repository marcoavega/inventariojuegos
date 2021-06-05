<?php
$categoria_controller = new CategoriasController();

if ($_POST['r'] == 'categoria-delete' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

	$categoria = $categoria_controller->get($_POST['id_categoria']);

	if (empty($categoria)) {
		$template = '
			<div class="">
				<p class="">No existe el id_categoria <b>%s</b></p>
			</div>
			<script>
				window.onload = function (){
					reloadPage("categorias")
				}
			</script>
		';

		printf($template, $_POST['id_categoria']);
	} else {
		$template_categoria = '
			<h2 class="">Eliminar Categoria</h2>
			<form method="POST" class="">
				<div class="">
					¿Estas seguro de eliminar la categoria: 
					<mark class="">%s</mark>?
				</div>
				<div class="">
					<input  class="" type="submit" value="SI">
					<input class="" type="button" value="NO" onclick="history.back()">
					<input type="hidden" name="id_categoria" value="%s">
					<input type="hidden" name="r" value="categoria-delete">
					<input type="hidden" name="crud" value="del">
				</div>
			</form>
		';

		printf(
			$template_categoria,
			$_POST['categoria'],
			$_POST['id_categoria']
		);
	}
} else if ($_POST['r'] == 'categoria-delete' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'del') {


	$categoria = $categoria_controller->del($_POST['id_categoria']);

	$template = '
	<input type="hidden" name="id_categoria" value="' . $_POST['id_categoria'] . '">
		<div class="">
			<p class="">Categoria <b>%s</b> eliminada</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("categorias")
			}
		</script>
	';

	printf($template, $_POST['id_categoria']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}