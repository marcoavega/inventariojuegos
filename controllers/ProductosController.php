<?php
class ProductosController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductosModel();
    }

    public function set($pd_data = array())
    {
        return $this->model->set($pd_data);
    }

    public function get($pd = '')
    {
        return $this->model->get($pd);
    }

    public function del($pd = '')
    {
        return $this->model->del($pd);
    }

    public function __destruct()
    {
        //unset($this);
    }
}
