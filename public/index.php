<?php

use App\Application;
use App\Routing\Route;
use App\Controllers\EmojiController;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$app = new Application();

Route::get('/users', [EmojiController::class, 'index']);
Route::get('/users/{id}', [EmojiController::class, 'show']);
Route::post('/users', [EmojiController::class, 'store']);
Route::put('/users/{id}', [EmojiController::class, 'update']);
Route::delete('/users/{id}', [EmojiController::class, 'destroy']);

$app->run();
