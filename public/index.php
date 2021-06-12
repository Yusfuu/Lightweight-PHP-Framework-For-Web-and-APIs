<?php

use App\Application;
use App\Routing\Route;
use App\Controllers\UserController;
use App\Http\Middleware\Auth;
use App\Http\Response;
use App\Http\Request;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$app = new Application();

/*
|------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------
|
| Here is where you can register API routes for your application. 
|
*/

Route::get('/hello/{name}', function (Request $request) {
  $name = $request->params->name;
  echo ("Hello, $name");
});

$app->run();
