<?php

use App\Http\Request;
use App\Http\Response;
use App\Routing\Route;

/*
|------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------
|
| Here is where you can register API routes for your application. 
|
*/

Route::get('/hello/{name}', function (Request $request, Response $response) {
  $name = $request->params->name;
  $response->write("Hello, $name");
});
