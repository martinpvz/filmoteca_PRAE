<?php

use DataBase\Media;

require_once '../API/media.php';

$var = new Media();

$post = json_decode(file_get_contents('php://input'));

$var->update($post);

echo $var->getResponse();
