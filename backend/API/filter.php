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
        $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                FROM year y
                LEFT JOIN (
                    SELECT m.id, m.year_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON y.id = m.year_id
                GROUP BY y.id, y.year";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $year = $row['year'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('year' => $year, 'total' => $total, 'id' => $id);
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
        $sql = "SELECT a.id, a.name, COUNT(m.id) as total
                FROM area a
                LEFT JOIN (
                    SELECT m.id, m.area_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON a.id = m.area_id
                GROUP BY a.id, a.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $area = $row['name'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('area' => $area, 'total' => $total, 'id' => $id);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function listCategories( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM category c
                LEFT JOIN (
                    SELECT m.id, m.category_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON c.id = m.category_id
                GROUP BY c.id, c.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $category = $row['name'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('category' => $category, 'total' => $total, 'id' => $id);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function listSubCategories( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM subcategory c
                LEFT JOIN (
                    SELECT m.id, m.subcategory_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON c.id = m.subcategory_id
                GROUP BY c.id, c.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $subcategory = $row['name'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('category' => $subcategory, 'total' => $total, 'id' => $id);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }


    public function listTypes( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT t.id, t.name, COUNT(m.id) as total
                FROM type t
                LEFT JOIN (
                    SELECT m.id, m.type_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON t.id = m.type_id
                GROUP BY t.id, t.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $type = $row['name'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('type' => $type, 'total' => $total, 'id' => $id);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }


    public function listSubTypes( $get )
    {  
        $cdc = $get['cdc'];
        $this->response = array();
        $sql = "SELECT t.id, t.name, COUNT(m.id) as total
                FROM subtype t
                LEFT JOIN (
                    SELECT m.id, m.type_id, m.cdc_id
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%'
                ) m ON t.id = m.type_id
                GROUP BY t.id, t.name";
        if ($result = $this->conexion->query($sql)) {
            while($row = mysqli_fetch_assoc($result)){
                $subtype = $row['name'];
                $total = $row['total'];
                $id = $row['id'];
                $this->response[] = array('subtype' => $subtype, 'total' => $total, 'id' => $id);
            }
            $result->free();
        } else {
            die('No se pudo completar la operación');
        }
        $this->conexion->close();
    }

    public function update()
    {
        $data = json_decode(file_get_contents('php://input'));
        $this->response = array();
        $provisional = array();
        $cdc = $data->cdc;
        $year = $data->year;
        $area = $data->area;
        $category = $data->category;
        $subcategory = $data->subcategory;
        $type = $data->type;
        $subtype = $data->subtype;

        if ($year != "" && $area == "" && $category == "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT y.id, y.year,COUNT(m.id) as total
            FROM year y
            LEFT JOIN (
                SELECT m.id, m.year_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%'
            ) m ON y.id = m.year_id
            GROUP BY y.id, y.year";

            $result = $this->conexion->query($sql);
            $years = array();
            while($row = mysqli_fetch_assoc($result)){
                $years[] = array('name' => $row['year'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['years'] = $years;


            $sql = "SELECT a.id, a.name, COUNT(m.id) as total
            FROM area a
            LEFT JOIN (
                SELECT m.id, m.area_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON a.id = m.area_id
            GROUP BY a.id, a.name";

            $result = $this->conexion->query($sql);
            $areas = array();
            while($row = mysqli_fetch_assoc($result)){
                $areas[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['areas'] = $areas;

            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM category c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON c.id = m.category_id
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $categories = array();
            while($row = mysqli_fetch_assoc($result)){
                $categories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['categories'] = $categories;

            $sql = "SELECT s.id, s.name, COUNT(m.id) as total
            FROM subcategory s
            LEFT JOIN (
                SELECT m.id, m.subcategory_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON s.id = m.subcategory_id
            GROUP BY s.id, s.name";

            $result = $this->conexion->query($sql);
            $subcategories = array();
            while($row = mysqli_fetch_assoc($result)){
                $subcategories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subcategories'] = $subcategories;

            $sql = "SELECT t.id, t.name, COUNT(m.id) as total
            FROM type t
            LEFT JOIN (
                SELECT m.id, m.type_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON t.id = m.type_id
            GROUP BY t.id, t.name";

            $result = $this->conexion->query($sql);
            $types = array();
            while($row = mysqli_fetch_assoc($result)){
                $types[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['types'] = $types;

            $sql = "SELECT st.id, st.name, COUNT(m.id) as total
            FROM subtype st
            LEFT JOIN (
                SELECT m.id, m.subtype_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON st.id = m.subtype_id
            GROUP BY st.id, st.name";

            $result = $this->conexion->query($sql);
            $subtypes = array();
            while($row = mysqli_fetch_assoc($result)){
                $subtypes[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subtypes'] = $subtypes;

        } else if ($year != "" && $area != "" && $category == "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT y.id, y.year,COUNT(m.id) as total
            FROM year y
            LEFT JOIN (
                SELECT m.id, m.year_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%'
            ) m ON y.id = m.year_id
            GROUP BY y.id, y.year";

            $result = $this->conexion->query($sql);
            $years = array();
            while($row = mysqli_fetch_assoc($result)){
                $years[] = array('name' => $row['year'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['years'] = $years;


            $sql = "SELECT a.id, a.name, COUNT(m.id) as total
            FROM area a
            LEFT JOIN (
                SELECT m.id, m.area_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year'
            ) m ON a.id = m.area_id
            GROUP BY a.id, a.name";

            $result = $this->conexion->query($sql);
            $areas = array();
            while($row = mysqli_fetch_assoc($result)){
                $areas[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['areas'] = $areas;

            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM category c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.area_id = '$area'
            ) m ON c.id = m.category_id
            WHERE c.area_id = '$area'
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $categories = array();
            while($row = mysqli_fetch_assoc($result)){
                $categories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['categories'] = $categories;
        } else if ($year != "" && $area != "" && $category != "" && $subcategory == "" && $type == "" && $subtype == "") {

        } else if ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type == "" && $subtype == "") {

        } else if ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type != "" && $subtype == "") {

        } else if ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type != "" && $subtype != "") {

        } 

        $this->conexion->close();
    }
}

?>