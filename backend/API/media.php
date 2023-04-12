<?php

namespace DataBase;
use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class Media extends DataBase
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

    public function list($data)
    {
        $this->response = array();
        session_start();
        $cdc = $data['cdc'];
        $sql = "SELECT media.id AS media_id, media.description, media.date, media.type, media.resource, media.favourite, media.year_id, media.area_id, media.cdc_id, media.category_id, media.subcategory_id, media.type_id, media.subtype_id
        FROM media 
        JOIN cdc ON media.cdc_id = cdc.id 
        WHERE cdc.name LIKE '%$cdc%' AND is_deleted = 0";
        //"SELECT * FROM media JOIN cdc ON media.cdc_id = cdc.id WHERE cdc.name LIKE '%$cdc%'";
        $sqlDir = "SELECT media.id AS media_id, media.description, media.date, media.type, media.resource, media.favourite, media.year_id, media.area_id, media.cdc_id, media.category_id, media.subcategory_id, media.type_id, media.subtype_id
        FROM media 
        JOIN cdc ON media.cdc_id = cdc.id 
        WHERE cdc.name LIKE '%$cdc%' AND favourite = 1 AND is_deleted = 0";
        //"SELECT * FROM media JOIN cdc ON media.cdc_id = cdc.id WHERE cdc.name LIKE '%$cdc%' AND favourite = 1";
        
        if ($_SESSION['role'] == "5") {
            if ($result = $this->conexion->query($sqlDir)) {
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
        } else {
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
        }
        
        $this->conexion->close();
    }

    public function add($post)
    {

    }

    public function edit($post)
    {
        
    }

    public function delete($get)
    {
        $media_id = $get['id'];
        $this->response = array();
        $sql = "UPDATE media
                SET is_deleted = '1'
                WHERE id = '$media_id';
            ";
        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "El favorito se eliminó correctamente";
        } else {
            $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }
}

?>