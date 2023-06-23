<?php

use DataBase\Admin;

require_once '../API/admin.php';

$var = new Admin();

$var->indexCambioRol($_POST);
echo $var->getResponse();

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Admin();
    $admin->cambioRol();
    echo $admin->getResponse();
}