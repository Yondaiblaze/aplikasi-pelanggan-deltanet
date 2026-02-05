<?php

// Router untuk PHP built-in server
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Jika file statis ada, serve langsung
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Semua request lainnya diarahkan ke index.php
require_once __DIR__ . '/public/index.php';