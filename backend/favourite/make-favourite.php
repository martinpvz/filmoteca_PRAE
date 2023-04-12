<?php


use DataBase\Favourite;

require_once '../API/favourite.php';

$var = new Favourite();

$var->makeFavourite($_GET);

echo $var->getResponse();
