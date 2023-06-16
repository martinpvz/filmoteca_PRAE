<?php
namespace DataBase;

use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class Admin extends DataBase
{
    public function __construct($string = 'proyecto_roberto'){
        $this->response = "";
        parent::__construct($string);
    }

    public function getResponse(){
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    //Funcion para mostrar el token almacenado en la base de datos
    public function indexToken(){
        session_start();
        $sql = "SELECT token FROM token WHERE  id = 1";
           
        if ($result = $this->conexion->query($sql)) {
            $row = $result->fetch_assoc();
            $_SESSION['token'] = $row['token'];
        } else {
            $this->response['mensaje'] = "Error en la consulta. " . mysqli_error($this->conexion);
        }        
        $result->free();
        $this->conexion->close();
    }

    //Función encargada de generar un nuevo token para el resgistro de usuarios
    public function updateToken(){
        $updated_at = date("Y-m-d H:i:s");
        $newtoken = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvxyz', ceil(6/36) )),1,6);
        $sql = "UPDATE token SET token = '$newtoken', uptadet_at = '$updated_at' WHERE id = 1";

        if($this->conexion->query($sql)) {
            //$this->response = $newtoken;
            header("Location: ../../token.php");
        } else {
            echo '<p>Hubo un error: ' . $this->conexion->error() . '</p>';
        }
    }

    //Funcion para mostrar a los usuarios registrados en una tabla
    public function getDasboard(){
        // Consulta para obtener los usuarios
        $this->response = array();
        $sql = "SELECT user.*, role.name AS role_name, cdc.name AS cdc_name
        FROM user
        LEFT JOIN role ON user.role_id = role.id
        LEFT JOIN cdc ON user.cdc_id = cdc.id
        WHERE role_id != 1";

        $result = $this->conexion->query($sql);
        while ($fila = $result->fetch_assoc()) {
            $this->response[] = $fila;
        }
        //$result->free();
        $this->conexion->close();
    }

    //Funcion para mostrar las opciones del select en roles.php
    public function indexCambioRol($post){
        session_start();
        $userID = $post['id'];
        
        //Verificamos el ID
        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);
        if ($this->conexion->query($sql)) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['surname'] = $row['surname'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['cdc_id'] = $row['cdc_id'];
        
            // Obtener todas las sedes
            $sqlCDC = "SELECT id AS id_cdc, name AS cdc_name FROM cdc ORDER BY id ASC";
            $resultCDC = $this->conexion->query($sqlCDC);
            $sedes = array();
            while ($row = $resultCDC->fetch_all(MYSQLI_ASSOC)) {
                $sedes[] = $row;
                $_SESSION['sedes'] = $sedes;
            }

            // Obtener todos los roles
            $sqlRole = "SELECT id AS id_role, name AS role_name FROM role WHERE id != 1 ORDER BY id_role ASC";
            $resultRole = $this->conexion->query($sqlRole);
            $roles = $resultRole->fetch_all(MYSQLI_ASSOC);
            $_SESSION['roles'] = $roles;
        }

        $this->conexion->close();
    }

    //Funcion para cambiar de rol
    public function cambioRol($post){
        $updated_at = date("Y-m-d H:i:s");
        $userID = $post['id'];

        //Verificamos el ID
        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);
            /*$roles= array();
            $sqlROL = "SELECT id AS id_role, name AS role_name FROM role WHERE id != 1";
            $resultROL= $this->conexion->query($sqlROL);
            while ($fila = $sqlROL->fetch_assoc()) {
                //$_SESSION['id_role'] = $row['id_role'];
                //$_SESSION['role_name'] = $row['role_name'];
                $roles[] = $fila;
                $this->response[] = $roles;
            }*/

            //opciones existentes de cdc
            $sedes= array();
            $sqlCDC = "SELECT id AS id_cdc, name AS cdc_name FROM cdc" ;
            $resultCDC= $this->conexion->query($sqlCDC);
            while ($fila = mysqli_fetch_assoc($resultCDC)) {
                $sedes[] = $fila;
            }
        $this->conexion->close();
    }

    //Funcion para cambiar la contraseña a un usuario desde el dashboard
    public function changePassword($post){
        session_start();
        $updated_at = date("Y-m-d H:i:s");
        $userID = $post['id'];

        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);

        if(mysqli_num_rows($result) > 0){
            $newPass = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz', ceil(8/36) )),1,8);
            $password= password_hash($newPass, PASSWORD_DEFAULT);
            $update = "UPDATE user SET updated_at = '$updated_at', password = '$password' WHERE role_id != 1 AND id = '$userID'";
            if ($this->conexion->query($update)) {
                $row = $result->fetch_assoc();
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['password'] = $newPass;
            } else {
                $this->response['mensaje'] = "Error en la consulta. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();

        }else{
            $error = 'No se encontró ningún usuario válido con el ID ' . $userId . '.';
            $this->response = $error;
        }
    }

    //Funcion para habilitar a un usuario desde el dashboard
    public function enable($post){
        $updated_at = date("Y-m-d H:i:s");
        $userID = $post['id'];

        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);

        if(mysqli_num_rows($result) > 0){
            $update = "UPDATE user SET active = 1, updated_at = '$updated_at' WHERE role_id != 1 AND id = '$userID'";
            $this->conexion->query($update);
            //header("Location: ../../dashboard.php");
            $this->conexion->close();
        }else{
            $error = 'No se encontró ningún usuario válido con el ID ' . $userId . '.';
            $this->response = $error;
        }
    }

    //Funcion para deshabilitar a un usuario desde el dashboard
    public function disable($post){
        $updated_at = date("Y-m-d H:i:s");
        $userID = $post['id'];

        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);

        if(mysqli_num_rows($result) > 0){
            $update = "UPDATE user SET active = 0, updated_at = '$updated_at' WHERE role_id != 1 AND id = '$userID'";
            $this->conexion->query($update);
            //header("Location: ../../dashboard.php");
            $this->conexion->close();
        }else{
            $error = 'No se encontró ningún usuario válido con el ID ' . $userId . '.';
            $this->response = $error;
        }
        getDasboard();
    }

    //Funcion para eliminar usuarios
    public function delete($post){
        $userID = $post['id'];

        $sql = "SELECT * FROM user WHERE role_id != 1 AND id = '$userID'";
        $result = $this->conexion->query($sql);

        if(mysqli_num_rows($result) > 0){
            $deleteUser = "DELETE FROM user WHERE role_id != 1 AND id = '$userID'";
            $this->conexion->query($deleteUser);
            //header("Location: ../../dashboard.php");
            $this->conexion->close();
        }else{
            $error = 'No se encontró ningún usuario válido con el ID ' . $userId . '.';
            $this->response = $error;
        }
    }
}
   
?>
