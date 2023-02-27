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
        $sqlUser = "SELECT * FROM user WHERE username='{$post['user']}' and password='{$post['password']}'";
        $resultAdmin = mysqli_query($this->conexion,$sqlAdmin);
        $resultUser = mysqli_query($this->conexion,$sqlUser);
        
        $filasAdmin = $resultAdmin->fetch_all(MYSQLI_ASSOC);;
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);;
        
        if($filasUser){
            $_SESSION['name'] = $filasUser[0]['name'];
            $_SESSION['surname'] = $filasUser[0]['surname'];

            header("location:../../firstPage.php?email=" . $_POST['email']); 
        }
        else if($filasAdmin){
            header("location:../../homeadmin.php"); // not implemented yet
        } else {
            header("location:../../login.php?error=1"); 
            //json_encode($this->response, JSON_PRETTY_PRINT);
        }
        mysqli_free_result($resultAdmin);
        mysqli_close($this->conexion);       
    }
}

?>
