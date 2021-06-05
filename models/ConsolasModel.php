<?php
class ConsolasModel extends Model
{

    public function set($consola_data = array())
    {
        foreach ($consola_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_consola = test_input($id_consola);
        $consola = test_input($consola);

        $this->query = "REPLACE INTO consolas (id_consola, consola) VALUES ('$id_consola','$consola')";
        $this->set_query();
    }

    public function get($consola = '')
    {
        $sql = ($consola != '')
            ? "SELECT * FROM consolas WHERE id_consola = $consola"
            : "SELECT * FROM consolas";
        $this->query = $sql;

        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }
        return $data;
    }

    public function del($id_consola = '')
    {
        $this->query = "DELETE FROM consolas WHERE id_consola = $id_consola";
        $this->set_query();
    }

    public function __destruct()
    {
        unset($this->db_name);
    }
}
