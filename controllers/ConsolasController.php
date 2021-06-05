<?php
class ConsolasController
{
    private $model;

    public function __construct()
    {
        $this->model = new ConsolasModel();
    }

    public function set($consola_data = array())
    {
        return $this->model->set($consola_data);
    }

    public function get($consola_id = '')
    {
        return $this->model->get($consola_id);
    }

    public function del($consola_id = '')
    {
        return $this->model->del($consola_id);
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}