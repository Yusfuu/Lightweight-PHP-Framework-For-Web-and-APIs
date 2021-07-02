<?php

use App\Http\Request;
use App\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function (Request $request) {
  Route::view('welcome', ['lang' => "PHP"]);
});
