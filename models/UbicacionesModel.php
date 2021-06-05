<?php
class UbicacionesModel extends Model
{

    public function set($ubicacion_data = array())
    {
        foreach ($ubicacion_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_ubicacion = test_input($id_ubicacion);
        $ubicacion = test_input($ubicacion);

        $this->query = "REPLACE INTO ubicacion (id_ubicacion, ubicacion) VALUES ('$id_ubicacion','$ubicacion')";
        $this->set_query();
    }

    public function get($ubicacion = '')
    {
        $sql = ($ubicacion != '')
            ? "SELECT * FROM ubicacion WHERE id_ubicacion = $ubicacion"
            : "SELECT * FROM ubicacion";
        $this->query = $sql;

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }

    public function del($id_ubicacion = '')
    {
        $this->query = "DELETE FROM ubicacion WHERE id_ubicacion = $id_ubicacion";
        $this->set_query();
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}