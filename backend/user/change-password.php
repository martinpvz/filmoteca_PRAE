<?php

use DataBase\User;

require_once '../API/user.php';

$var = new User();

$var->changePassword($_POST);

echo $var->getResponse();