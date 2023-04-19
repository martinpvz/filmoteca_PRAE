<?php


use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->listSubTypes($_GET);

echo $var->getResponse();
