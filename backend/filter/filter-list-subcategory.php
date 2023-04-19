<?php


use DataBase\Filter;

require_once '../API/filter.php';

$var = new Filter();

$var->listSubCategories($_GET);

echo $var->getResponse();
