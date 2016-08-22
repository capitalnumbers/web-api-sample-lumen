<?php

require("../vendor/autoload.php");
$swagger = \Swagger\scan('../app/Http/Controllers');
header('Content-Type: application/json');
echo $swagger;
