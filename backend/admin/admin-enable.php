<?php

use DataBase\Admin;

require_once '../API/admin.php';

$var = new Admin();

$var->enable($_POST);
echo $var->getResponse();
