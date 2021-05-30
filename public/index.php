<?php

use App\Application;
use App\Routing\Route;
use App\Controllers\UserController;
use App\Http\Middleware\JWTAuth;
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

Route::post('/user', function (Request $request) {
  $bb = $request->json();
  $jj = new JWTAuth();
  // $token =  $jj->create($bb);
  $x = $jj->verify($request->authorization);
  // Response::json($x);
  // echo 'hello ' . $request->params->name . ' have id : ' . $request->query->id;
});


// Route::get('/hello/{name}', function (Request $request) {
// });
// Route::get('/user/{id}', function (Request $request) {
// });
// Route::get('/posts', function (Request $request) {
// });
// Route::post('/likes/{id}', function (Request $request) {
// });

// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::post('/users', [UserController::class, 'store']);
// Route::put('/users/{id}', [UserController::class, 'update']);
// Route::delete('/users/{id}', [UserController::class, 'destroy']);


$app->run();
