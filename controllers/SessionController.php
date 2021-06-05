<?php
class SessionController
{
    private $session;

    public function __construct()
    {
        $this->session = new UsersModel();
    }

    public function login($usuario, $password)
    {
        return $this->session->validate_user($usuario, $password);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ./');
    }

    public function __destructor()
    {
        unset($this->db_name);
    }
}
