<?php

use App\Http\Controllers\backend\articleController;
//category
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\dashboardcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [dashboardcontroller::class, 'index']);

Route::resource('/category', categoryController::class);
Route::resource('/article', articleController::class);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['guest']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
