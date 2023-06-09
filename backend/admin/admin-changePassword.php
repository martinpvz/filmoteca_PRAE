<?php

use DataBase\ADMIN;

require_once '../API/admin.php';

$var = new ADMIN();

$var->changePassword($_POST);
echo $var->getResponse();
