<?php

use DataBase\CDC;

require_once '../API/cdc.php';

$var = new CDC();

$post = json_decode(file_get_contents('php://input'));

$var->add($post);

echo $var->getResponse();
