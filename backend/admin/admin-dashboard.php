<?php

use DataBase\Admin;

require_once '../API/admin.php';

$var = new Admin();

$var -> getDasboard();
echo $var->getResponse();

