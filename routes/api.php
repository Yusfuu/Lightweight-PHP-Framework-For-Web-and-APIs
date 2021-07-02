<?php

use App\Http\Request;
use App\Routing\Route;

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
