<?php


use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->listTypes($_GET);

echo $var->getResponse();
