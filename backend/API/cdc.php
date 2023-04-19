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

    /*public function listAdmin()
    {
        $this->response = array();
        $sql = "
            SELECT p.idpelicula AS id, concat('Pelicula') AS tipo, r.clave AS region, g.nombre AS genero, c.clave AS clasificacion, p.lanzamiento, p.titulo, p.eliminado, p.rutaPortada as imagen
            FROM peliculas AS p 
            LEFT JOIN regiones AS r ON p.idgenero = r.idregion
            LEFT JOIN generos AS g ON p.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON p.idclasificacion = c.idclasificacion
            UNION
            SELECT s.idserie AS id, concat('Serie') AS tipo, r.clave, g.nombre, c.clave, s.lanzamiento, s.titulo, s.eliminado, s.rutaPortada as imagen
            FROM series AS s 
            LEFT JOIN regiones AS r ON s.idgenero = r.idregion
            LEFT JOIN generos AS g ON s.idgenero = g.idgenero
            LEFT JOIN clasificaciones AS c ON s.idclasificacion = c.idclasificacion
            ";

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
    }*/

    public function add($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'El elemento ya existe en la base de datos'
        );
        if($post['tipoElemento'] == 'Pelicula')
        {
            if (isset($post['title'])) {
                $sql = "
                    SELECT * FROM peliculas WHERE titulo = '{$post['title']}'
                    ";
                $result = $this->conexion->query($sql);
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
    
                    $sql = "
                        INSERT INTO peliculas (idpelicula, idregion, idgenero, idclasificacion, lanzamiento, titulo, duracion, rutaPortada) VALUES
                        (null, '{$post['region']}', '{$post['genre']}', '{$post['clasification']}', '{$post['year']}', '{$post['title']}', '{$post['duration']}', '{$post['image']}')
                        ";
    
                    if ($this->conexion->query($sql)) {
                        $this->response['estatus'] =  "Correcto";
                        $this->response['mensaje'] =  "La película se agregó correctamente";
                    } else {
                        $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                    }
                }
                $result->free();
            }    
        }
        else{
            if (isset($post['title'])) {
                $sql = "
                    SELECT * FROM series WHERE titulo = '{$post['title']}'
                    ";
                $result = $this->conexion->query($sql);
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
    
                    $sql = "
                        INSERT INTO series (idserie, idregion, idgenero, idclasificacion, lanzamiento, titulo, numTemporadas, totalCapitulos, rutaPortada) VALUES
                        (null, '{$post['region']}', '{$post['genre']}', '{$post['clasification']}', '{$post['year']}', '{$post['title']}', '{$post['seasons']}', '{$post['chapters']}', '{$post['image']}')
                        ";
    
                    if ($this->conexion->query($sql)) {
                        $this->response['estatus'] =  "Correcto";
                        $this->response['mensaje'] =  "La serie se agregó correctamente";
                    } else {
                        $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                    }
                }
                $result->free();
            }            
        }
        $this->conexion->close();
    }

    public function edit($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'La película o serie no existe en la base de datos'
        );
        if (isset($post['id'])) {
            if ($post['tipoElemento'] == 'Pelicula') {
                $sql = "
                    UPDATE peliculas SET idregion = '{$post['region']}', idgenero = '{$post['genre']}', idclasificacion ='{$post['clasification']}', lanzamiento = '{$post['year']}', titulo = '{$post['title']}', duracion = '{$post['duration']}', rutaPortada = '{$post['image']}', eliminado = '{$post['available']}' WHERE idpelicula = '{$post['id']}'
                    ";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La película se actualizó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            } else {
                $sql = "
                UPDATE series SET idregion = '{$post['region']}', idgenero = '{$post['genre']}', idclasificacion ='{$post['clasification']}', lanzamiento = '{$post['year']}', titulo = '{$post['title']}', numTemporadas = '{$post['seasons']}', totalCapitulos = '{$post['chapters']}', rutaPortada = '{$post['image']}', eliminado = '{$post['available']}' WHERE idserie = '{$post['id']}'
                    ";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La serie se actualizó correctamente";
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            }
            $this->conexion->close();
        }
    }

    public function delete($post)
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'No se pudo realizar la operación'
        );

        if (isset($post['id'])) {
            if ($post['tipo'] == 'Pelicula') {
                $sql = "
                    UPDATE peliculas SET eliminado = 1 WHERE idpelicula = {$post['id']}
                    ";
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La película se deshabilitó correctamente";
                } else {
                    $this->response['estatus'] = "Error";
                    $this->response['message'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            } else {
                $sql = "
                UPDATE series SET eliminado = 1 WHERE idserie = {$post['id']}
                ";
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "La serie se deshabilitó correctamente";
                } else {
                    $this->response['estatus'] = "Error";
                    $this->response['message'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
            }
            $this->conexion->close();
        }
    }
}

?>