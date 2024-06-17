<?php

use App\Http\Controllers\ConvertController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RedisController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use mycode\sinhvat\dongvat\Cat;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'index']);

Route::get('/form-convert-pdf', function () {
    return view('form_convert_pdf');
});

Route::post('/upload', [\App\Http\Controllers\ConvertController::class, 'convert'])->name('convert');

Route::get('/users', [UserController::class, 'get']);

Route::get('/article/{id}', [RedisController::class, 'get']);
Route::get('/articles', [RedisController::class, 'index']);

Route::get('/posts', [PostController::class, 'get']);


Route::get('/cat', function() {
    $cat = new Cat();
    dd($cat->sound());
});
