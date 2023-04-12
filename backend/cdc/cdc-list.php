<?php

use DataBase\CDC;

require_once '../API/cdc.php';

$var = new CDC();

$var->list();

echo $var->getResponse();
