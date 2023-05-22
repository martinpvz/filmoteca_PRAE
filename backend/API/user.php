<?php
namespace DataBase;

use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class User extends DataBase
{
    public function __construct($string = 'proyecto_roberto')
    {
        $this->response = array(
            'estatus'  => 'Error',
            'mensaje' => 'Algo salio mal'
        );
        parent::__construct($string);
    }

    public function getResponse()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function validate($post)
    {
        session_start();
        $_SESSION['sesion'] = true;
        $_SESSION['username'] = $post['user'];
        
        //Consulta
        $sqlAdmin = "SELECT * FROM user WHERE username='{$post['user']}' and password='{$post['password']}'";
        $sqlUser = "SELECT * FROM user WHERE username='{$post['user']}' AND active='1'";
        $resultAdmin = mysqli_query($this->conexion,$sqlAdmin);
        $resultUser = mysqli_query($this->conexion,$sqlUser);
        
        $filasAdmin = $resultAdmin->fetch_all(MYSQLI_ASSOC);;
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);;
        
        if($filasUser){
            $password_hash = $filasUser[0]['password'];
            if (password_verify($post['password'], $password_hash)) {
                $_SESSION['id'] = $filasUser[0]['id'];
                $_SESSION['name'] = $filasUser[0]['name'];
                $_SESSION['surname'] = $filasUser[0]['surname'];
                $_SESSION['email'] = $filasUser[0]['email'];
                $_SESSION['role'] = $filasUser[0]['role_id'];
                $_SESSION['cdc'] = $filasUser[0]['cdc_id'];

                header("location:../../firstPage.php?email=" . $_POST['email']); 
            } else {
                header("location:../../login.php?error=1"); 
                //json_encode($this->response, JSON_PRETTY_PRINT);
            }
        } else if($filasAdmin){
            header("location:../../homeadmin.php"); // not implemented yet
        } else {
            header("location:../../login.php?error=1");
        }
        mysqli_free_result($resultAdmin);
        mysqli_close($this->conexion);       
    }

    public function register($post)
    {
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $key = $post['key'];
        // we search for the key in the database
        $searchKey = "SELECT * FROM token WHERE token = '{$key}'";
        $resultKey = mysqli_query($this->conexion, $searchKey);
        $filasKey = $resultKey->fetch_all(MYSQLI_ASSOC);
        // we search for the username in the database
        $searchUser = "SELECT * FROM user WHERE username = '{$post['userR']}'";
        $resultUser = mysqli_query($this->conexion, $searchUser);
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);
        // we search for the email in the database
        $searchEmail = "SELECT * FROM user WHERE email = '{$post['email']}'";
        $resultEmail = mysqli_query($this->conexion, $searchEmail);
        $filasEmail = $resultEmail->fetch_all(MYSQLI_ASSOC);
        // we encrypt the password
        $passE = password_hash($post['passwordR'], PASSWORD_DEFAULT);
        if($filasKey[0]['token'] == $key){
            // we check if the username or email already exists
            if (!empty($filasUser) || !empty($filasEmail)) {
                header("location:../../login.php?user=0");
                exit();
            }

            $sql = "INSERT INTO user (id, name, surname, username, password, email, active, updated_at, created_at, role_id, cdc_id) VALUES (NULL, '{$post['name']}', '{$post['surname']}', '{$post['userR']}', '{$passE}', '{$post['email']}', '1', '{$updated_at}', '{$created_at}', '4', NULL)";
            $result = mysqli_query($this->conexion, $sql);
            if ($result) {
                header("location:../../login.php?registered=1");
            } else {
                header("location:../../login.php?registered=0");
            }
        } else {
            header("location:../../login.php?token=0");
        }
        mysqli_close($this->conexion);
    }

    public function edit($post)
    {
        session_start();
        
        $updated_at = date("Y-m-d H:i:s");
        // we search for the username in the database
        $searchUser = "SELECT * FROM user WHERE username = '{$post['user']}'";
        $resultUser = mysqli_query($this->conexion, $searchUser);
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);
        // we search for the email in the database
        $searchEmail = "SELECT * FROM user WHERE email = '{$post['email']}'";
        $resultEmail = mysqli_query($this->conexion, $searchEmail);
        $filasEmail = $resultEmail->fetch_all(MYSQLI_ASSOC);
        if ($_SESSION['id']) {
            // we check if the username or email already exists
            if ((!empty($filasUser) && ($post['user'] != $_SESSION['username'])) || (!empty($filasEmail) && ($post['email'] != $_SESSION['email']))) {
                $this->response['estatus'] =  "Error";
                $this->response['mensaje'] =  "El usuario o email ya se encuentran registrados";
            } else {
                $sql = "
                    UPDATE user SET  name = '{$post['name']}', surname ='{$post['surname']}', email = '{$post['email']}', username = '{$post['user']}', updated_at = '{$updated_at}' WHERE id = '{$_SESSION['id']}'
                    ";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->response['estatus'] =  "Correcto";
                    $this->response['mensaje'] =  "El perfil se actualizó correctamente";
                    $_SESSION['name'] = $post['name'];
                    $_SESSION['surname'] = $post['surname'];
                    $_SESSION['email'] = $post['email'];
                    $_SESSION['username'] = $post['user'];
                } else {
                    $this->response['mensaje'] = "No se pudo ejecutar la instrucción $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            }
        }
    }

    public function getName() {
        session_start();
        if ($_SESSION['id']) {
            // get the name out of the database
            $sql = "SELECT name, surname FROM user WHERE id = '{$_SESSION['id']}'";
            $result = mysqli_query($this->conexion, $sql);
            $filas = $result->fetch_all(MYSQLI_ASSOC);
            // get the first letter of name and surname and put it together in mayus
            $name = strtoupper(substr($filas[0]['name'], 0, 1) . substr($filas[0]['surname'], 0, 1));

            $this->response['estatus'] =  "Correcto";
            $this->response['mensaje'] =  $name;
        } else {
            $this->response['estatus'] =  "Error";
            $this->response['mensaje'] =  "No se pudo obtener el nombre";
        }
    }
}

?>
