<?php

use DataBase\Admin;

require_once '../API/admin.php';

$var = new Admin();

$var->delete($_POST);
echo $var->getResponse();
