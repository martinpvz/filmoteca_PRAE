<?php

namespace DataBase;
use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class Filter extends DataBase
{
    public function __construct($string = 'proyecto_roberto')
    {
        $this->response = "";
        parent::__construct($string);
    }

    public function getResponse()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function listYears( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT y.year, COUNT(m.id) as total
                FROM year y
                LEFT JOIN (
                    SELECT m.id, m.year_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON y.id = m.year_id
                GROUP BY y.year";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $year = $row['year'];
                $total = $row['total'];
                $this->response[] = array('year' => $year, 'total' => $total);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function listAreas( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT a.name, COUNT(m.id) as total
                FROM area a
                LEFT JOIN (
                    SELECT m.id, m.area_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON a.id = m.area_id
                GROUP BY a.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $area = $row['name'];
                $total = $row['total'];
                $this->response[] = array('area' => $area, 'total' => $total);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function update()
    {
        $this->response = array();
        $sql = "SELECT * FROM cdc";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->response[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }
}

?>