<?php
    use DataBase\User;

    require_once '../API/user.php';

    if ($_POST['user'] != "" || $_POST['password'] != "") {
        $var = new User();

        $var->validate($_POST);
        echo $var->getResponse();   
    } else if ($_POST['name'] != "" || $_POST['surname'] != "" || $_POST['email'] != "" || $_POST['userR'] != "" || $_POST['passwordR'] != "" || $_POST['confirmation'] != "" || $_POST['key'] != "") {
        $var = new User();

        $var->register($_POST);
        echo $var->getResponse();
    } else {
        echo "Error";
    }
?>