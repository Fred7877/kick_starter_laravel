<?php

use App\Http\Controllers\Admin\RoleAndPersmissionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    Auth::routes();
});

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::resource('users', UserController::class);

    Route::resource('roles-and-permissions', RoleAndPersmissionController::class);

    Route::get('/', function () {
        return view('layouts.admin');
    })->name('home');

});

Route::get('/', function () {
   return redirect(route('login'));
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
