<?php

namespace DataBase;
use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class CDC extends DataBase
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

    public function list()
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

    // public function add($post) {
    //     $nameCdc = $post->name;
    //     $address = $post->address;
    //     $phone = $post->phone;
    //     $resource = $post->resource;
    //     $created_at = date('Y-m-d H:i:s');
    //     $updated_at = date('Y-m-d H:i:s');
        
    //     $resource = explode( ',', $resource );
    //     $media = base64_decode($resource[1]);

    //     // Guardar los datos de la imagen en un archivo temporal
    //     $tmp_file = tempnam(sys_get_temp_dir(), 'image_');
    //     file_put_contents($tmp_file, $media);

    //     // Revisar si el archivo se generó correctamente
    //     if (!file_exists($tmp_file)) {
    //         $this->response['mensaje'] = 'Error: no se pudo guardar la imagen en un archivo temporal';
    //     } else {
    //         $this->response['mensaje'] = 'Archivo temporal generado correctamente: ' . $tmp_file;
    //     }

    //     // Copiar el archivo temporal a la carpeta de destino
    //     $uploads_dir = '../../img';
    //     $name = uniqid() . '.jpg';
    //     $path = $uploads_dir . '/' . $name;
    //     if (!copy($tmp_file, $path)) {
    //         $this->response['mensaje'] = 'Error: no se pudo copiar el archivo temporal a la carpeta de destino';
    //     } else {
    //         $this->response['mensaje'] = $path;
    //     }

    //     $resource = './img/' . $name;

    //     // Eliminar el archivo temporal
    //     unlink($tmp_file);
        
    //     $this->response = array();
    //     $sql = "INSERT INTO cdc (name, image, address, phone, created_at, updated_at)
    //     VALUES ('$nameCdc', '$resource', '$address', '$phone', '$created_at', '$updated_at')";
        
    //     if ($this->conexion->query($sql)) {
    //         $this->response['estatus'] =  "Correcto";
    //         $this->response['mensaje'] =  "El CDC se agregó correctamente";
    //     } else {
    //         $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
    //     }
    //     $this->conexion->close();
    // }

    public function add($post) {
        $nameCdc = $post->name;
        $address = $post->address;
        $phone = $post->phone;
        $resource = $post->resource;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        $resource = explode( ',', $resource );
        $media = base64_decode($resource[1]);

        // Comprobar si la imagen se decodifica correctamente
        $imageCheck = @imagecreatefromstring($media);
        if ($imageCheck === false) {
            $this->response['mensaje'] = 'Error: La imagen no se pudo decodificar correctamente';
            return;
        }
    
        // Guardar los datos de la imagen en un archivo temporal
        $uploads_dir = '../../img';
        $name = uniqid() . '.jpg';
        $path = $uploads_dir . '/' . $name;
        
        // Guardar la imagen en la carpeta de destino
        if (file_put_contents($path, $media) === false) {
            $this->response['mensaje'] = 'Error: no se pudo guardar la imagen en la carpeta de destino';
        } else {
            $this->response['mensaje'] = $path;
        }
    
        $resource = './img/' . $name;
        
        $this->response = array();
        $sql = "INSERT INTO cdc (name, image, address, phone, created_at, updated_at)
        VALUES ('$nameCdc', '$resource', '$address', '$phone', '$created_at', '$updated_at')";
        
        if ($this->conexion->query($sql)) {
            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  "El CDC se agregó correctamente";
        } else {
            $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }
}

?>