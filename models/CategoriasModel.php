<?php
class CategoriasModel extends Model
{

    public function set($categoria_data = array())
    {
        foreach ($categoria_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_categoria = test_input($id_categoria);
        $categoria = test_input($categoria);

        $this->query = "REPLACE INTO categorias (id_categoria, categoria) VALUES ('$id_categoria','$categoria')";
        $this->set_query();
    }

    public function get($categoria = '')
    {
        $sql = ($categoria != '')
            ? "SELECT * FROM categorias WHERE id_categoria = $categoria"
            : "SELECT * FROM categorias";
        $this->query = $sql;

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }

    public function del($id_categoria = '')
    {
        $this->query = "DELETE FROM categorias WHERE id_categoria = $id_categoria";
        $this->set_query();
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}