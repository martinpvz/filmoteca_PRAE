<?php

use DataBase\Media;

require_once '../API/media.php';

$var = new Media();

$var->list($_GET);

echo $var->getResponse();
