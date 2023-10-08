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
Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/login', [Controller::class, 'login']);
Route::get('/chats', [Controller::class, 'indexchat']);
Route::post('/logout', [Controller::class, 'logout']);
Route::get('/chat/{id}', [Controller::class, 'chat']);
Route::post('/register', [Controller::class, 'register']);
Route::post('/comment', [Controller::class, 'commenting']);
Route::get('/statistics', [Controller::class, 'indexstatistics']);
Route::get('/reports', [Controller::class, 'indexreports']);
Route::put('/validaterep', [Controller::class, 'validateReport']);
Route::put('/rejectrep', [Controller::class, 'rejectReport']);
Route::put('/endfire', [Controller::class, 'endfire']);
Route::post('/newreport', [Controller::class, 'newreport']);
Route::post('/newstatistic', [Controller::class, 'newstatistic']);
Route::put('/closedstatistic/{statisticId}', [Controller::class, 'closedstatistic']);
Route::get('/download/{imageName}', [Controller::class, 'download']);
});

use App\Http\Controllers\MapController;

Route::get('/calculate-bounding-box/{latitude}/{longitude}', [MapController::class,'calculateBoundingBox']);
use App\Http\Controllers\FireController;

Route::get('/compare-fire', [FireController::class,'compareWithFires']);
