<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirmed']);
Route::get('/thanks', [ContactController::class, 'completed'])->name('.revise');
Route::post('/thanks', [ContactController::class, 'complete']);
Route::middleware('auth')->group(function () {
    Route::get('/admin', [UserController::class, 'admin']);
    Route::post('/admin', [UserController::class, 'delete']);
});