<?php

use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->update();

echo $var->getResponse();
