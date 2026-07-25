<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$req = new Illuminate\Http\Request(['message' => 'Rekomendasi Kurma']);
$controller = new App\Http\Controllers\ChatbotController();
$res = $controller->message($req);

echo $res->getContent();
