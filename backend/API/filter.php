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
        session_start();
        $cdc = $get['cdc'] != "null" ? $get['cdc'] : "";
        $type = $get['type'] != "null" ? $get['type'] : "";
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
    
        $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                FROM year y
                LEFT JOIN (
                    SELECT m.id, m.year_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
                ) m ON y.id = m.year_id
                GROUP BY y.id, y.year";

        if(!empty($type)){
            if($type == "multimedia") {
                $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                FROM year_multi y
                LEFT JOIN (
                    SELECT m.id, m.year_multi_id, m.is_deleted
                    FROM media_multi m
                    WHERE m.is_deleted = 0 $directivo
                ) m ON y.id = m.year_multi_id
                GROUP BY y.id, y.year";

            } else if ( $type == "eventos") {
                $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                FROM year_event y
                LEFT JOIN (
                    SELECT m.id, m.year_event_id, m.is_deleted
                    FROM media_event m
                    WHERE m.is_deleted = 0 $directivo
                ) m ON y.id = m.year_event_id
                GROUP BY y.id, y.year";
            }
        }

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
        session_start();
        $cdc = $get['cdc'] != "null" ? $get['cdc'] : "";
        $type = $get['type'] != "null" ? $get['type'] : "";
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
        $sql = "SELECT a.id, a.name, COUNT(m.id) as total
                FROM area a
                LEFT JOIN (
                    SELECT m.id, m.area_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
                ) m ON a.id = m.area_id
                GROUP BY a.id, a.name";

        if(!empty($type)){
            if($type == "multimedia") {
                $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM category_multi c
                LEFT JOIN (
                    SELECT m.id, m.category_multi_id, m.is_deleted
                    FROM media_multi m
                    WHERE m.is_deleted = 0 $directivo
                ) m ON c.id = m.category_multi_id
                GROUP BY c.id, c.name";

            } else if ( $type == "eventos") {
                $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM category_event c
                LEFT JOIN (
                    SELECT m.id, m.category_event_id, m.is_deleted
                    FROM media_event m
                    WHERE m.is_deleted = 0 $directivo
                ) m ON c.id = m.category_event_id
                GROUP BY c.id, c.name";
            }
        }

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
        session_start();
        $cdc = $get['cdc'];
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
        $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM category c
                LEFT JOIN (
                    SELECT m.id, m.category_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
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
        session_start();
        $cdc = $get['cdc'];
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
        $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                FROM subcategory c
                LEFT JOIN (
                    SELECT m.id, m.subcategory_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
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
        session_start();
        $cdc = $get['cdc'];
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
        $sql = "SELECT t.id, t.name, COUNT(m.id) as total
                FROM type t
                LEFT JOIN (
                    SELECT m.id, m.type_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
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
        session_start();
        $cdc = $get['cdc'];
        $this->response = array();

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }
        $sql = "SELECT t.id, t.name, COUNT(m.id) as total
                FROM subtype t
                LEFT JOIN (
                    SELECT m.id, m.type_id, m.cdc_id, m.is_deleted
                    FROM media m
                    INNER JOIN cdc c ON m.cdc_id = c.id
                    WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
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
        session_start();

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
        $multimedia = $data->typeE != "null" ? $data->typeE : "";

        $directivo = "";
        if ($_SESSION['role'] == "5") {
            $directivo = "AND m.favourite = 1";
        }

        if ($year != "" && $area == "" && $category == "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT y.id, y.year,COUNT(m.id) as total
            FROM year y
            LEFT JOIN (
                SELECT m.id, m.year_id, m.cdc_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.is_deleted = 0 $directivo
            ) m ON y.id = m.year_id
            GROUP BY y.id, y.year";

            if(!empty($multimedia)) {
                if($multimedia == "multimedia") {
                    $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                    FROM year_multi y
                    LEFT JOIN (
                        SELECT m.id, m.year_multi_id, m.is_deleted
                        FROM media_multi m
                        WHERE m.is_deleted = 0 $directivo
                    ) m ON y.id = m.year_multi_id
                    GROUP BY y.id, y.year";
    
                } else if ( $multimedia == "eventos") {
                    $sql = "SELECT y.id, y.year,COUNT(m.id) as total
                    FROM year_event y
                    LEFT JOIN (
                        SELECT m.id, m.year_event_id, m.is_deleted
                        FROM media_event m
                        WHERE m.is_deleted = 0 $directivo
                    ) m ON y.id = m.year_event_id
                    GROUP BY y.id, y.year";
                }
            }

            $result = $this->conexion->query($sql);
            $years = array();
            while($row = mysqli_fetch_assoc($result)){
                $years[] = array('name' => $row['year'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['years'] = $years;


            $sql = "SELECT a.id, a.name, COUNT(m.id) as total
            FROM area a
            LEFT JOIN (
                SELECT m.id, m.area_id, m.cdc_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.is_deleted = 0 $directivo
            ) m ON a.id = m.area_id
            GROUP BY a.id, a.name";

            if(!empty($multimedia)) {
                if($multimedia == "multimedia") {
                    $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                    FROM category_multi c
                    LEFT JOIN (
                        SELECT m.id, m.year_multi_id, m.is_deleted, m.category_multi_id
                        FROM media_multi m
                        WHERE m.is_deleted = 0 AND m.year_multi_id = '$year' $directivo
                    ) m ON c.id = m.category_multi_id
                    GROUP BY c.id, c.name";
    
                } else if ( $multimedia == "eventos") {
                    $sql = "SELECT c.id, c.name, COUNT(m.id) as total
                    FROM category_event c
                    LEFT JOIN (
                        SELECT m.id, m.year_event_id, m.is_deleted, m.category_event_id
                        FROM media_event m
                        WHERE m.is_deleted = 0 AND m.year_event_id = '$year' $directivo
                    ) m ON c.id = m.category_event_id
                    GROUP BY c.id, c.name";
                }
            }

            $result = $this->conexion->query($sql);
            $areas = array();
            while($row = mysqli_fetch_assoc($result)){
                $areas[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['areas'] = $areas;

            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM category c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.is_deleted = 0 $directivo
            ) m ON c.id = m.category_id
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $categories = array();
            while($row = mysqli_fetch_assoc($result)){
                $categories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['categories'] = $categories;
        } else if ($year == "" && $area != "" && $category == "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM category c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.area_id = '$area' AND m.is_deleted = 0 $directivo
            ) m ON c.id = m.category_id
            WHERE c.area_id = '$area'
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $categories = array();
            while($row = mysqli_fetch_assoc($result)){
                $categories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['categories'] = $categories;
        } else if ($year == "" && $area != "" && $category != "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM subcategory c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.subcategory_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.area_id = '$area' AND m.category_id = '$category' AND m.is_deleted = 0 $directivo
            ) m ON c.id = m.subcategory_id
            WHERE c.category_id = '$category'
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $subcategories = array();
            while($row = mysqli_fetch_assoc($result)){
                $subcategories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subcategories'] = $subcategories;
        }  else if ($year == "" && $area != "" && $category != "" && $subcategory != "" && $type == "" && $subtype == "") {
            $sql = "SELECT t.id, t.name, COUNT(m.id) as total
            FROM type t
            LEFT JOIN (
                SELECT m.id, m.type_id, m.cdc_id, m.subcategory_id, m.category_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.area_id = '$area' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.is_deleted = 0 $directivo
            ) m ON t.id = m.type_id
            WHERE t.subcategory_id = '$subcategory'
            GROUP BY t.id, t.name";

            $result = $this->conexion->query($sql);
            $types = array();
            while($row = mysqli_fetch_assoc($result)){
                $types[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['types'] = $types;
        }  else if ($year == "" && $area != "" && $category != "" && $subcategory != "" && $type != "" && $subtype == "") {
            $sql = "SELECT s.id, s.name, COUNT(m.id) as total
            FROM subtype s
            LEFT JOIN (
                SELECT m.id, m.subtype_id, m.cdc_id, m.subcategory_id, m.category_id, m.type_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.area_id = '$area' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.type_id = '$type', m.is_deleted = 0 $directivo
            ) m ON s.id = m.subtype_id
            WHERE s.type_id = '$type'
            GROUP BY s.id, s.name";

            $result = $this->conexion->query($sql);
            $subtypes = array();
            while($row = mysqli_fetch_assoc($result)){
                $subtypes[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subtypes'] = $subtypes;
        } 
        // aqui
        else if ($year == "" && $area == "" && $category != "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM subcategory c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.subcategory_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.category_id = '$category' AND m.is_deleted = 0 $directivo
            ) m ON c.id = m.subcategory_id
            WHERE c.category_id = '$category'
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $subcategories = array();
            while($row = mysqli_fetch_assoc($result)){
                $subcategories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subcategories'] = $subcategories;
        } else if ($year == "" && $area == "" && $category != "" && $subcategory != "" && $type == "" && $subtype == "") {
            $sql = "SELECT t.id, t.name, COUNT(m.id) as total
            FROM type t
            LEFT JOIN (
                SELECT m.id, m.type_id, m.cdc_id, m.subcategory_id, m.category_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.is_deleted = 0 $directivo
            ) m ON t.id = m.type_id
            WHERE t.subcategory_id = '$subcategory'
            GROUP BY t.id, t.name";

            $result = $this->conexion->query($sql);
            $types = array();
            while($row = mysqli_fetch_assoc($result)){
                $types[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['types'] = $types;
        }  else if ($year == "" && $area == "" && $category != "" && $subcategory != "" && $type != "" && $subtype == "") {
            $sql = "SELECT s.id, s.name, COUNT(m.id) as total
            FROM subtype s
            LEFT JOIN (
                SELECT m.id, m.subtype_id, m.cdc_id, m.subcategory_id, m.category_id, m.type_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.type_id = '$type' AND m.is_deleted = 0 $directivo
            ) m ON s.id = m.subtype_id
            WHERE s.type_id = '$type'
            GROUP BY s.id, s.name";

            $result = $this->conexion->query($sql);
            $subtypes = array();
            while($row = mysqli_fetch_assoc($result)){
                $subtypes[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subtypes'] = $subtypes;
        } else if ($year != "" && $area != "" && $category == "" && $subcategory == "" && $type == "" && $subtype == "") {
            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM category c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.area_id = '$area' AND m.is_deleted = 0 $directivo
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
            $sql = "SELECT c.id, c.name, COUNT(m.id) as total
            FROM subcategory c
            LEFT JOIN (
                SELECT m.id, m.category_id, m.cdc_id, m.subcategory_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.area_id = '$area' AND m.category_id = '$category' AND m.is_deleted = 0 $directivo
            ) m ON c.id = m.subcategory_id
            WHERE c.category_id = '$category'
            GROUP BY c.id, c.name";

            $result = $this->conexion->query($sql);
            $subcategories = array();
            while($row = mysqli_fetch_assoc($result)){
                $subcategories[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subcategories'] = $subcategories;
        } else if ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type == "" && $subtype == "") {
            $sql = "SELECT t.id, t.name, COUNT(m.id) as total
            FROM type t
            LEFT JOIN (
                SELECT m.id, m.type_id, m.cdc_id, m.subcategory_id, m.category_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.area_id = '$area' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.is_deleted = 0 $directivo
            ) m ON t.id = m.type_id
            WHERE t.subcategory_id = '$subcategory'
            GROUP BY t.id, t.name";

            $result = $this->conexion->query($sql);
            $types = array();
            while($row = mysqli_fetch_assoc($result)){
                $types[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['types'] = $types;
        } else if ( ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type != "" && $subtype == "") || ($year != "" && $area != "" && $category != "" && $subcategory != "" && $type != "" && $subtype != "") ) {
            $sql = "SELECT s.id, s.name, COUNT(m.id) as total
            FROM subtype s
            LEFT JOIN (
                SELECT m.id, m.subtype_id, m.cdc_id, m.subcategory_id, m.category_id, m.type_id, m.is_deleted
                FROM media m
                INNER JOIN cdc c ON m.cdc_id = c.id
                WHERE c.name LIKE '%$cdc%' AND m.year_id = '$year' AND m.area_id = '$area' AND m.category_id = '$category' AND m.subcategory_id = '$subcategory' AND m.type_id = '$type' AND m.is_deleted = 0 $directivo
            ) m ON s.id = m.subtype_id
            WHERE s.type_id = '$type'
            GROUP BY s.id, s.name";

            $result = $this->conexion->query($sql);
            $subtypes = array();
            while($row = mysqli_fetch_assoc($result)){
                $subtypes[] = array('name' => $row['name'], 'total' => $row['total'], 'id' => $row['id']);
            }
            $this->response['subtypes'] = $subtypes;
        }

        $this->conexion->close();
    }
}

?>