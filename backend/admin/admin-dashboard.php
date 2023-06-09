<?php

use DataBase\ADMIN;

require_once '../API/admin.php';

session_start();

$var = new ADMIN();
$var -> getDasboard();
$datosJson = $var->getResponse();

$_SESSION['datos'] = $datosJson;
//header("Location: ../../dashboard.php");

exit;
