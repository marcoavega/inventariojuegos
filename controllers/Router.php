<?php
class Router
{
    public $route;

    public function __construct($route)
    {
        /*$session_options = array(
        'use_only_cookies' => 1,
        'auto_start' => 1,models_path
        'read_and_close' => true);
         */
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['ok'])) {
            $_SESSION['ok'] = false;
        }

        if ($_SESSION['ok']) {

            $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';

            $controller = new ViewController();

            switch ($this->route) {
                case 'home':
                    $controller->load_view('home');
                    break;
                case 'productos':
                    if (!isset($_POST['r']))  $controller->load_view('productos');
                    else if ($_POST['r'] == 'producto-add')  $controller->load_view('producto-add');
                    else if ($_POST['r'] == 'producto-edit')  $controller->load_view('producto-edit');
                    else if ($_POST['r'] == 'producto-delete')  $controller->load_view('producto-delete');
                    else if ($_POST['r'] == 'producto-show')  $controller->load_view('producto-show');
                    break;
                case 'usuarios':
                    if (!isset($_POST['r']))  $controller->load_view('users');
                    else if ($_POST['r'] == 'user-add')  $controller->load_view('user-add');
                    else if ($_POST['r'] == 'user-edit')  $controller->load_view('user-edit');
                    else if ($_POST['r'] == 'user-delete')  $controller->load_view('user-delete');
                    break;
                case 'categorias':
                    if (!isset($_POST['r']))  $controller->load_view('categorias');
                    else if ($_POST['r'] == 'categoria-add')  $controller->load_view('categoria-add');
                    else if ($_POST['r'] == 'categoria-edit')  $controller->load_view('categoria-edit');
                    else if ($_POST['r'] == 'categoria-delete')  $controller->load_view('categoria-delete');
                    break;
                case 'consolas':
                    if (!isset($_POST['r']))  $controller->load_view('consolas');
                    else if ($_POST['r'] == 'consola-add')  $controller->load_view('consola-add');
                    else if ($_POST['r'] == 'consola-edit')  $controller->load_view('consola-edit');
                    else if ($_POST['r'] == 'consola-delete')  $controller->load_view('consola-delete');
                    break;
                case 'formatos':
                    if (!isset($_POST['r']))  $controller->load_view('formatos');
                    else if ($_POST['r'] == 'formato-add')  $controller->load_view('formato-add');
                    else if ($_POST['r'] == 'formato-edit')  $controller->load_view('formato-edit');
                    else if ($_POST['r'] == 'formato-delete')  $controller->load_view('formato-delete');
                    break;
                case 'ubicaciones':
                    if (!isset($_POST['r']))  $controller->load_view('ubicaciones');
                    else if ($_POST['r'] == 'ubicacion-add')  $controller->load_view('ubicacion-add');
                    else if ($_POST['r'] == 'ubicacion-edit')  $controller->load_view('ubicacion-edit');
                    else if ($_POST['r'] == 'ubicacion-delete')  $controller->load_view('ubicacion-delete');
                    break;
                case 'salir':
                    $user_session = new SessionController();
                    $user_session->logout();
                    break;
                default:
                    $controller->load_view('error404');
                    break;
            }
        } else {
            if (!isset($_POST['usuario']) && !isset($_POST['password'])) {
                $login_form = new ViewController();
                $login_form->load_view('login');
            } else {
                $user_session = new SessionController();
                $session = $user_session->login($_POST['usuario'], $_POST['password']);

                if (empty($session)) {
                    $login_form = new ViewController();
                    $login_form->load_view('login');
                    header('Location: ./?error=El usuario ' . $_POST['usuario'] .
                        ' y el password proporcionado no coinciden.');
                } else {
                    $_SESSION['ok'] = true;

                    foreach ($session as $row) {
                        $_SESSION['id_usuario'] = $row['id_usuario'];
                        $_SESSION['nombre'] = $row['nombre'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['permisos'] = $row['permisos'];
                    }

                    header('Location: ./');
                }
            }
        };
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}
