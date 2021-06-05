<?php
class FormatosController
{
    private $model;

    public function __construct()
    {
        $this->model = new FormatosModel();
    }

    public function set($formato_data = array())
    {
        return $this->model->set($formato_data);
    }

    public function get($formato_id = '')
    {
        return $this->model->get($formato_id);
    }

    public function del($formato_id = '')
    {
        return $this->model->del($formato_id);
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}