<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [Controller::class, 'login']);
Route::get('/chats', [Controller::class, 'indexchat']);
Route::get('/chat/{id}', [Controller::class, 'chat']);
Route::post('/register', [Controller::class, 'register']);
Route::post('/comment', [Controller::class, 'commenting']);

