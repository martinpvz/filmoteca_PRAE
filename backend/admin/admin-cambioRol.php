<?php

use DataBase\ADMIN;

require_once '../API/admin.php';

$var = new ADMIN();

$var->indexCambioRol($_POST);
echo $var->getResponse();

