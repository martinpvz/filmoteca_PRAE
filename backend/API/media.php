<?php

namespace DataBase;
use DataBase\DataBase;

use function PHPSTORM_META\type;

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
        $type = "";
        $cdc = "";
        if(isset($data['type'])) {
            $type = $data['type'] != "null" ? $data['type'] : "";
        } 
        if(isset($data['cdc'])) {
            $cdc = $data['cdc'] != "null" ? $data['cdc'] : "";
        }
        if (!empty($cdc)) {
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
        } else if (!empty($type)) {
            $sql = "";
            if($type == "multimedia") {
                $sql = "SELECT media_multi.id AS media_id, media_multi.description, media_multi.date, media_multi.type, media_multi.resource, media_multi.favourite, media_multi.year_multi_id, media_multi.category_multi_id
                FROM media_multi 
                WHERE is_deleted = 0";
                if( $_SESSION['role'] == "5" ) {
                    $sql = "SELECT media_multi.id AS media_id, media_multi.description, media_multi.date, media_multi.type, media_multi.resource, media_multi.favourite, media_multi.year_multi_id, media_multi.category_multi_id
                    FROM media_multi 
                    WHERE favourite = 1 AND is_deleted = 0";
                }
            } else if ( $type == "eventos") {
                $sql = "SELECT media_event.id AS media_id, media_event.description, media_event.date, media_event.type, media_event.resource, media_event.favourite, media_event.year_event_id, media_event.category_event_id
                FROM media_event
                WHERE is_deleted = 0";
                if( $_SESSION['role'] == "5" ) {
                    $sql = "SELECT media_event.id AS media_id, media_event.description, media_event.date, media_event.type, media_event.resource, media_event.favourite, media_event.year_event_id, media_event.category_event_id
                    FROM media_event
                    WHERE favourite = 1 AND is_deleted = 0";
                }
            }
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
    }

    public function add($post)
    {
        $date = $post->date;
        $description = $post->description;
        $type = $post->type;
        $resource = $post->resource;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $year_id = $post->year_id;
        $area_id = $post->area_id;
        $cdc_name = $post->cdc_id;
        $category_id = $post->category_id;
        $subcategory_id = $post->subcategory_id;
        $type_id = $post->type_id;
        $subtype_id = $post->subtype_id;
        $multimedia = '';
        if(isset($post->typeE)) {
            $multimedia = $post->typeE != "null" ? $post->typeE : "";
        }

        if ($category_id == "") {
            $category_id = NULL;
        }
        if ($subcategory_id == "") {
            $subcategory_id = NULL;
        }
        if ($type_id == "") {
            $type_id = NULL;
        }
        if ($subtype_id == "") {
            $subtype_id = NULL;
        }

        $resource = explode(',', $resource);
        $media = base64_decode($resource[1]);

        
        if ($type == '1') {
            $image = imagecreatefromstring($media);
            if (!$image) {
                $this->response['mensaje'] = 'Error: no se pudo crear la imagen';
            } else {
                $quality = 75; 
                $tmp_file = tempnam(sys_get_temp_dir(), 'image_');
                imagejpeg($image, $tmp_file, $quality);
                imagedestroy($image);
    
                $uploads_dir = '../../img';
                $name = uniqid() . '.jpeg';
                $path = $uploads_dir . '/' . $name;
                copy($tmp_file, $path);
    
                $resource = './img/' . $name;

                unlink($tmp_file);
            }
        } else if ($type == '2') {
            $tmp_file = tempnam(sys_get_temp_dir(), 'image_');
            file_put_contents($tmp_file, $media);

            $uploads_dir = '../../img';
            $name = uniqid() . '.mp4';
            $path = $uploads_dir . '/' . $name;
            copy($tmp_file, $path);

            $resource = './img/' . $name;

            // Eliminar el archivo temporal
            unlink($tmp_file);
        }


        $cdc_id = '';
        if(!empty($cdc_name)) {
            $cdc_query = "SELECT id FROM cdc WHERE name LIKE '%$cdc_name%'";
            $cdc_result = $this->conexion->query($cdc_query);
            $cdc_row = mysqli_fetch_assoc($cdc_result);
            $cdc_id = $cdc_row['id'];
        }
        
        $this->response = array();
        $sql = "INSERT INTO media (date, description, type, resource, created_at, updated_at, year_id, area_id, cdc_id, category_id, subcategory_id, type_id, subtype_id, favourite)
        VALUES ('$date', '$description', '$type', '$resource', '$created_at', '$updated_at', '$year_id', ";
        if ($area_id == '') {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$area_id', ";
        }
        
        if ($cdc_id == '') {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$cdc_id', ";
        }
        
        if ($category_id == '') {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$category_id', ";
        }
        
        if ($subcategory_id == '' ) {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$subcategory_id', ";
        }
        
        if ($type_id == '') {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$type_id', ";
        }
        
        if ($subtype_id == '') {
            $sql .= "NULL, ";
        } else {
            $sql .= "'$subtype_id', ";
        }
        
        $sql .= "0)";

        if(!empty($multimedia)) {
            if($multimedia == "multimedia") {
                $sql = "INSERT INTO media_multi (date, description, type, resource, created_at, updated_at, year_multi_id, category_multi_id, favourite)
                VALUES ('$date', '$description', '$type', '$resource', '$created_at', '$updated_at', '$year_id', '$area_id', 0) ";

            } else if ( $multimedia == "eventos") {
                $sql = "INSERT INTO media_event (date, description, type, resource, created_at, updated_at, year_event_id, category_event_id, favourite)
                VALUES ('$date', '$description', '$type', '$resource', '$created_at', '$updated_at', '$year_id', '$area_id', 0) ";
            }
        }
        
        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "La media se agregó correctamente";
        } else {
            $this->response['mensaje'] = $cdc_name . "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }

    public function update($post) {
        session_start();
        $this->response = array();
        $cdc = $post->cdc;
        $year = $post->year;
        $area = $post->area;
        $category = $post->category;
        $subcategory = $post->subcategory;
        $type = $post->type;
        $subtype = $post->subtype;
        $multimedia = $post->typeE != "null" ? $post->typeE : "";

        $query = "SELECT media.id AS media_id, media.description, media.date, media.type, media.resource, media.favourite, media.year_id, media.area_id, media.cdc_id, media.category_id, media.subcategory_id, media.type_id, media.subtype_id
        FROM media
        JOIN cdc ON media.cdc_id = cdc.id";

        if(!empty($multimedia)) {
            if($multimedia == "multimedia") {
                $query = "SELECT media_multi.id AS media_id, media_multi.description, media_multi.date, media_multi.type, media_multi.resource, media_multi.favourite, media_multi.year_multi_id, media_multi.category_multi_id
                FROM media_multi";
            } else if ( $multimedia == "eventos") {
                $query = "SELECT media_event.id AS media_id, media_event.description, media_event.date, media_event.type, media_event.resource, media_event.favourite, media_event.year_event_id, media_event.category_event_id
                FROM media_event";
            }
        }

        $conditions = array();

        if (!empty($cdc) && empty($multimedia)) {
            $conditions[] = "cdc.name LIKE '%$cdc%'";
        }
        if (!empty($year) && empty($multimedia)) {
            $conditions[] = "media.year_id = '$year'";
        } else if(!empty($year) && !empty($multimedia)) {
            if($multimedia == "multimedia") {
                $conditions[] = "media_multi.year_multi_id = '$year'";
            } else if ( $multimedia == "eventos") {
                $conditions[] = "media_event.year_event_id = '$year'";
            }
        }
        if (!empty($area) && empty($multimedia)) {
            $conditions[] = "media.area_id = '$area'";
        } else if(!empty($area) && !empty($multimedia)) {
            if($multimedia == "multimedia") {
                $conditions[] = "media_multi.category_multi_id = '$area'";
            } else if ( $multimedia == "eventos") {
                $conditions[] = "media_event.category_event_id = '$area'";
            }
        }
        if (!empty($category) && empty($multimedia)) {
            $conditions[] = "media.category_id = '$category'";
        }
        if (!empty($subcategory) && empty($multimedia)) {
            $conditions[] = "media.subcategory_id = '$subcategory'";
        }
        if (!empty($type) && empty($multimedia)) {
            $conditions[] = "media.type_id = '$type'";
        }
        if (!empty($subtype) && empty($multimedia)) {
            $conditions[] = "media.subtype_id = '$subtype'";
        }
        if ($_SESSION['role'] == "5" && empty($multimedia)) {
            $conditions[] = "media.favourite = '1'";
        } else if ($_SESSION['role'] == "5" && !empty($multimedia)) {
            if($multimedia == "multimedia") {
                $conditions[] = "media_multi.favourite = '1'";
            } else if ( $multimedia == "eventos") {
                $conditions[] = "media_event.favourite = '1'";
            }
        }
        if(empty($multimedia)){
            $conditions[] = "media.is_deleted = '0'";
        } else {
            if($multimedia == "multimedia") {
                $conditions[] = "media_multi.is_deleted = '0'";
            } else if ( $multimedia == "eventos") {
                $conditions[] = "media_event.is_deleted = '0'";
            }
        }
        //$conditions[] = "media.is_deleted = '0'";

        if(count($conditions) > 0) {
            $query .= " WHERE " . implode(' AND ', $conditions);
        }

        $result = $this->conexion->query($query);

        if ($result->num_rows > 0) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "Se encontraron " . $result->num_rows . " resultados";
            $this->response['data'] = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $this->response['data'][] = $row;
            }
        } else {
            $this->response['mensaje'] = $query . "No se encontraron resultados";
        }
    }

    public function edit($post, $get)
    {
        $type = "";
        $media_id = $post['id'];
        $date = $post['date'];
        $description = $post['description'];
        $this->response = array();
        $sql = "UPDATE media
                SET date = '$date', description = '$description'
                WHERE id = '$media_id';
            ";

        if(isset($get['type'])) {
            $type = $get['type'] != "null" ? $get['type'] : "";
            if($type == "multimedia") {
                $sql = "UPDATE media_multi
                SET date = '$date', description = '$description'
                WHERE id = '$media_id';
                ";
            } else if ( $type == "eventos") {
                $sql = "UPDATE media_event
                SET date = '$date', description = '$description'
                WHERE id = '$media_id';
                ";
            }
        }

        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "La media se actualizo correctamente";
        } else {
            $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }

    public function delete($get)
    {
        $type = "";
        $media_id = $get['id'];
        $this->response = array();
        $sql = "UPDATE media
                SET is_deleted = '1'
                WHERE id = '$media_id';
            ";

        if(isset($get['type'])) {
            $type = $get['type'] != "null" ? $get['type'] : "";
            if($type == "multimedia") {
                $sql = "UPDATE media_multi
                SET is_deleted = '1'
                WHERE id = '$media_id';
                ";
            } else if ( $type == "eventos") {
                $sql = "UPDATE media_event
                SET is_deleted = '1'
                WHERE id = '$media_id';
                ";
            }
        }

        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "La media se eliminó correctamente";
        } else {
            $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }
}

?>