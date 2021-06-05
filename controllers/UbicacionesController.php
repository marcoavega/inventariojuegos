<?php
class UbicacionesController
{
    private $model;

    public function __construct()
    {
        $this->model = new UbicacionesModel();
    }

    public function set($ubicacion_data = array())
    {
        return $this->model->set($ubicacion_data);
    }

    public function get($ubicacion_id = '')
    {
        return $this->model->get($ubicacion_id);
    }

    public function del($ubicacion_id = '')
    {
        return $this->model->del($ubicacion_id);
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}