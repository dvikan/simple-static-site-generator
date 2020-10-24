<?php

$uri = $_SERVER['REQUEST_URI'];

if(file_exists(__DIR__ . "/../out/$uri.html")) {
    print file_get_contents(__DIR__ . "/../out/$uri.html");
    exit;
}

return false;
