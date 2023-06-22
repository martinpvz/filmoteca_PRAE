<?php

use DataBase\User;

require_once '../API/user.php';

$var = new User();

$var->recover($_POST);
