<?php

use DataBase\Media;

require_once '../API/media.php';

$var = new Media();

$var->delete($_GET);

echo $var->getResponse();
