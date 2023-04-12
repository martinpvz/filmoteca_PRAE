<?php


use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->listYears($_GET);

echo $var->getResponse();
