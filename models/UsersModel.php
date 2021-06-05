<?php
class UsersModel extends Model
{
    public function set($user_data = array())
    {
        foreach ($user_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $nombre = test_input($_POST['nombre']);
        $password = test_input($_POST['password']);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->query = "REPLACE INTO usuarios (id_usuario, nombre, password, permisos) VALUES ('$id_usuario', '$nombre', '$password', '$permisos')";
        $this->set_query();
    }

    public function get($usuario = '')
    {
        $this->query = ($usuario != '')
            ? "SELECT * FROM usuarios WHERE nombre = '$usuario'"
            : "SELECT * FROM usuarios";

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($usuario = '')
    {
        $this->query = "DELETE FROM usuarios WHERE nombre = '$usuario'";
        $this->set_query();
    }

    public function validate_user($usuario, $password)
    {

        function test_input_validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $usuario = test_input_validate($usuario);
        $password = test_input_validate($password);

        $this->query = "SELECT * FROM usuarios WHERE nombre = '$usuario'";
        $this->get_query();

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }



        if (password_verify($password, $value['password'])) {
            return $data;
        }
    }

    public function __destruct()
    {
        //unset($this);
    }
}