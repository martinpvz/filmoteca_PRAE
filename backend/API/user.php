<?php
namespace DataBase;

use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class User extends DataBase
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

    public function validate($post)
    {
        session_start();
        $_SESSION['sesion'] = true;
        $_SESSION['username'] = $post['user'];
        
        //Consulta
        $sqlAdmin = "SELECT * FROM user WHERE username='{$post['user']}' and password='{$post['password']}'";
        $sqlUser = "SELECT * FROM user WHERE username='{$post['user']}'";
        $resultAdmin = mysqli_query($this->conexion,$sqlAdmin);
        $resultUser = mysqli_query($this->conexion,$sqlUser);
        
        $filasAdmin = $resultAdmin->fetch_all(MYSQLI_ASSOC);;
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);;
        
        if($filasUser){
            $password_hash = $filasUser[0]['password'];
            if (password_verify($post['password'], $password_hash)) {
                $_SESSION['name'] = $filasUser[0]['name'];
                $_SESSION['surname'] = $filasUser[0]['surname'];

                header("location:../../firstPage.php?email=" . $_POST['email']); 
            } else {
                header("location:../../login.php?error=1"); 
                //json_encode($this->response, JSON_PRETTY_PRINT);
            }
        } else if($filasAdmin){
            header("location:../../homeadmin.php"); // not implemented yet
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

            $sql = "INSERT INTO user (id, name, surname, username, password, email, active, updated_at, created_at, role_id, cdc_id) VALUES (NULL, '{$post['name']}', '{$post['surname']}', '{$post['userR']}', '{$passE}', '{$post['email']}', '1', '{$updated_at}', '{$created_at}', '1', NULL)";
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
}

?>
