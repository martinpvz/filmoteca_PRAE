<?php
    use DataBase\User;

    require_once '../API/user.php';

    if ($_POST['name'] != "" || $_POST['surname'] != "" || $_POST['email'] != "" || $_POST['user'] != null) {
        $var = new User();

        $var->edit($_POST);
        echo $var->getResponse();
    } else {
        echo "Error";
    }
?>