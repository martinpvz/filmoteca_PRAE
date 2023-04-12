<?php

use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->update($_POST);

echo $var->getResponse();
