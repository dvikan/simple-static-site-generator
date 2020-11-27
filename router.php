<?php

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/') {
    print file_get_contents(__DIR__ . "/out/index.html");
    exit;
}

if ($uri === '/feed.xml') {
    header('Content-type: application/rss+xml');
    print file_get_contents(__DIR__ . "/out/feed.xml");
    exit;
}

if (file_exists(__DIR__ . "/out/$uri.html")) {
    print file_get_contents(__DIR__ . "/out/$uri.html");
    exit;
}

return false;
