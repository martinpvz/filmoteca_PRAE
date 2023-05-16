<?php

namespace DataBase;
use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class Favourite extends DataBase
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

    public function makeFavourite( $get )
    {  
        $media_id = $get['id'];
        $type = "";
        if(isset($get['type'])) {
            $type = $get['type'] != "null" ? $get['type'] : "";
        } 
        $this->response = array();
        $sql = "UPDATE media
                SET favourite = NOT favourite
                WHERE id = '$media_id';
            ";
        
        if(!empty($type)) {
            if($type == "multimedia") {
                $sql = "UPDATE media_multi
                SET favourite = NOT favourite
                WHERE id = '$media_id';
                ";

            } else if ( $type == "eventos") {
                $sql = "UPDATE media_event
                SET favourite = NOT favourite
                WHERE id = '$media_id';
                ";
            }
        }
        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "El favorito se actualizó correctamente";
        } else {
            $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }
}

?>