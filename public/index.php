<?php

use App\Application;
use App\Routing\Route;
use App\Controllers\UserController;
use App\Http\Request;
use App\Http\Response;

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

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/{username}', function (Request $request) {
  Response::json($request);
  echo "👋👋 " . $request->params->username . " i 🧡 " . $request->query->city;
});


$app->run();
