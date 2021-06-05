<?php
class ProductosModel extends Model
{
    public function set($pd_data = array())
    {
        foreach ($pd_data as $key => $value) {
            $$key = $value;
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_producto = test_input($id_producto);
        $nombre_producto = test_input($nombre_producto);
        $categoria = test_input($categoria);
        $consola = test_input($consola);
        $formato = test_input($formato);
        $codigo_barras = test_input($codigo_barras);
        $ubicacion = test_input($ubicacion);

        $this->query = "REPLACE INTO productos SET id_producto = '$id_producto', nombre_producto = '$nombre_producto', categoria = '$categoria', consola = '$consola', formato = '$formato', codigo_barras = '$codigo_barras', ubicacion = '$ubicacion'";
        $this->set_query();
    }

    public function get($pd = '')
    {
        $this->query = ($pd != '')
            ? "SELECT pd.id_producto, pd.nombre_producto, ca.categoria, co.consola, fo.formato, pd.codigo_barras, ub.ubicacion FROM productos AS pd INNER JOIN categorias AS ca ON pd.categoria = ca.id_categoria INNER JOIN consolas AS co ON pd.consola = co.id_consola INNER JOIN formato AS fo ON pd.formato = fo.id_formato INNER JOIN ubicacion AS ub ON pd.ubicacion = ub.id_ubicacion WHERE pd.id_producto = '$pd'"
            : "SELECT pd.id_producto, pd.nombre_producto, ca.categoria, co.consola, fo.formato, pd.codigo_barras, ub.ubicacion FROM productos AS pd INNER JOIN categorias AS ca ON pd.categoria = ca.id_categoria INNER JOIN consolas AS co ON pd.consola = co.id_consola INNER JOIN formato AS fo ON pd.formato = fo.id_formato INNER JOIN ubicacion AS ub ON pd.ubicacion = ub.id_ubicacion";


        $this->get_query();

        $num_rows = count($this->rows);

        $data = array();

        foreach ($this->rows as $key => $value) {
            array_push($data, $value);
        }

        return $data;
    }

    public function del($pd = '')
    {
        $this->query = "DELETE FROM productos WHERE id_producto = '$pd'";
        $this->set_query();
    }

    public function __destruct()
    {
        //unset($this);
    }
}