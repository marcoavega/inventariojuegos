<?php
class FormatosModel extends Model
{

    public function set($formato_data = array())
    {
        foreach ($formato_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_formato = test_input($id_formato);
        $formato = test_input($formato);

        $this->query = "REPLACE INTO formato (id_formato, formato) VALUES ('$id_formato','$formato')";
        $this->set_query();
    }

    public function get($formato = '')
    {
        $sql = ($formato != '')
            ? "SELECT * FROM formato WHERE id_formato = $formato"
            : "SELECT * FROM formato";
        $this->query = $sql;

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }

    public function del($id_formato = '')
    {
        $this->query = "DELETE FROM formato WHERE id_formato = $id_formato";
        $this->set_query();
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}