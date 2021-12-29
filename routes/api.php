<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/send-mail', [SendMailController::class, 'sendEmail'])->name('send.mail');
Route::post('/clear-status', [SendMailController::class, 'clearStatus'])->name('clear.status');
Route::get('/get-status', [SendMailController::class, 'getStatus'])->name('get.status');
Route::get('/get-history', [SendMailController::class, 'getHistory'])->name('get.history');
