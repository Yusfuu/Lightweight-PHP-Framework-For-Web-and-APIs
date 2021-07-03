<?php

use App\Http\Request;
use App\Routing\Route;
use function App\lib\view;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

Route::get('/', function (Request $request) {
  return view('welcome', ['lang' => 'PHP']);
});
