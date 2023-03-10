<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Auth::routes();
Route::get('/user-dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('user-dashboard');


Route::group(['middleware' => ['auth','role:Admin']], function() {
    Route::get('/admin-dashboard', [CategoryController::class, 'dashboard'])->name('admin-dashboard');
    Route::resource('categories', CategoryController::class);
});

