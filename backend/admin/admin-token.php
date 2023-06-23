<?php

use DataBase\Admin;

require_once '../API/admin.php';

$var = new Admin();

$var->updateToken();
$var->indexToken();

echo $var->getResponse(); 
