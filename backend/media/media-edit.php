<?php

use DataBase\Media;

require_once '../API/media.php';

$var = new Media();

$var->edit($_POST);

echo $var->getResponse();
