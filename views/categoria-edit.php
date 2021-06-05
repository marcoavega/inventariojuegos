<?php
$categoria_controller = new CategoriasController();

if ($_POST['r'] == 'categoria-edit' && $_SESSION['permisos'] == 'admin' && !isset($_POST['crud'])) {

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

		$template_categoria =  '
			<h2 class="">Editar Categoria</h2>
			<form method="POST" class="">
				<div class="">
					<input type="text" placeholder="id_categoria" value="%s" disabled required>
					<input type="hidden" name="id_categoria" value="%s">
				</div>
				<div class="">
					<input type="text" name="categoria" placeholder="categoria" value="%s" required>
				</div>
				<div class="">
					<input  class="" type="submit" value="Editar">
					<input type="hidden" name="r" value="categoria-edit">
					<input type="hidden" name="crud" value="set">
				</div>
			</form>
		';

		printf(
			$template_categoria,
			$_POST['id_categoria'],
			$_POST['id_categoria'],
			$_POST['categoria']
		);
	}
} else if ($_POST['r'] == 'categoria-edit' && $_SESSION['permisos'] == 'admin' && $_POST['crud'] == 'set') {

	$save_categoria = array(
		'id_categoria' => $_POST['id_categoria'],
		'categoria' => $_POST['categoria']
	);

	$categoria = $categoria_controller->set($save_categoria);

	$template = '
		<div class="">
			<p class="">Categoria <b>%s</b> salvado</p>
		</div>
		<script>
			window.onload = function () {
				reloadPage("categorias")
			}
		</script>
	';

	printf($template, $_POST['categoria']);
} else {
	$controller = new ViewController();
	$controller->load_view('error401');
}