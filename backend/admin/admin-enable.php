<?php

use DataBase\ADMIN;

require_once '../API/admin.php';

$var = new ADMIN();

$var->enable($_POST);
echo $var->getResponse();
