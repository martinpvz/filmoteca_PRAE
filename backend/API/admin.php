<?php
namespace DataBase;

use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class Admin extends DataBase
{
    public function __construct($string = 'proyecto_roberto'){
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'Algo salio mal'
        );
        parent::__construct($string);
    }

    public function getResponse(){
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function getDasboard(){
        // Consulta para obtener los usuarios
        $sqlAdmin = "SELECT * FROM users WHERE id_role != 1";
        $resultAdmin = mysqli_query($this->conexion,$sqlAdmin);

        $usuarios = array();

        // Verificar si se encontraron usuarios
        if ($resultAdmin->num_rows > 0) {
            // Obtener cada fila de resultados como un arreglo asociativo
            while ($row = $resultAdmin->mysqli_fetch_assoc($resultAdmin)) {
                // Agregar cada usuario al arreglo $usuarios
                $usuarios[] = $row;
            }
        }else
        foreach ($usuarios as $usuario) {
            echo 'Usuario: ' . $usuario['username'] . '<br>';
            echo 'Nombre(s): ' . $usuario['name'] . '<br>';
            echo 'Apellidos: ' . $usuario['surname'] . '<br>';
            echo 'Email: ' . $usuario['email'] . '<br>';
            echo 'Estado: ' . ($usuario['active'] ? 'Activo' : 'Desactivado') . '<br>';
            echo 'Tipo de usuario: ' . $usuario['role_id'] . '<br>';
            echo 'CDC: ' . ($usuario['cdc_id'] ? $usuario['cdc_id'] : 'N/A') . '<br>';
            echo '<br>';
        }
        // Cerrar la conexión a la base de datos
        $this->conexion->close();
    }

    public function indexToken(){}

    public function updateToken(){}

    public function indexCambioRol(){}

    public function cambioRol(){}

    public function enable(){}

    public function disable(){}

    public function changePassword(){}

}

    /* Obtener los atributos de los usuarios
    $usuarios = array();
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }

    // Cerrar la conexión a la base de datos
    $this->conexion->close();

    // Mostrar los atributos de los usuarios
    foreach ($usuarios as $usuario) {
        echo 'Usuario: ' . $usuario['username'] . '<br>';
        echo 'Nombre(s): ' . $usuario['name'] . '<br>';
        echo 'Apellidos: ' . $usuario['surname'] . '<br>';
        echo 'Email: ' . $usuario['email'] . '<br>';
        echo 'Estado: ' . ($usuario['active'] ? 'Activo' : 'Desactivado') . '<br>';
        echo 'Tipo de usuario: ' . $usuario['role_id'] . '<br>';
        echo 'CDC: ' . ($usuario['cdc_id'] ? $usuario['cdc_id'] : 'N/A') . '<br>';
        echo '<br>';
    }*/
   
?>

