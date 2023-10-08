<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MapController;
use App\Http\Controllers\FireController;
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
Route::get('/chats', [Controller::class, 'indexchat']);
Route::post('/chatons', [Controller::class, 'chatons']);
Route::post('/logout', [Controller::class, 'logout']);
Route::get('/chat/{id}', [Controller::class, 'chat']);
Route::post('/comment', [Controller::class, 'commenting']);
Route::get('/statistics', [Controller::class, 'indexstatistics']);
Route::get('/reports', [Controller::class, 'indexreports']);
Route::put('/validaterep/{reportId}', [Controller::class, 'validateReport']);
Route::put('/rejectrep/{reportId}', [Controller::class, 'rejectReport']);
Route::put('/endfire/{statisticId}', [Controller::class, 'endfire']);
Route::post('/newreport', [Controller::class, 'newreport']);
Route::post('/newstatistic', [Controller::class, 'newstatistic']);
Route::put('/closedstatistic/{statisticId}', [Controller::class, 'closedstatistic']);
Route::get('/download/{imageName}', [Controller::class, 'download']);
});
Route::post('/register', [Controller::class, 'register']);

Route::post('/login', [Controller::class, 'login']);


Route::get('/calculate-bounding-box/{latitude}/{longitude}', [MapController::class,'calculateBoundingBox']);


Route::get('/compare-fire/{latitude}/{longitude}', [FireController::class,'compareWithFires']);
