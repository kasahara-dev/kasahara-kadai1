<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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
Route::get('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'register']);
Route::get('/admin', [ContactController::class, 'admin']);
Route::get('/register', [UserController::class, 'sign-up']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login']);

