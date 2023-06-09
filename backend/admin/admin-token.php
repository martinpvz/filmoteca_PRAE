<?php

use DataBase\ADMIN;

require_once '../API/admin.php';

$var = new ADMIN();

$var->updateToken();
$var->indexToken();

echo $var->getResponse(); 
