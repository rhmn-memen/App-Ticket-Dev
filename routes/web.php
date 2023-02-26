<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/user', App\Http\Controllers\UserController::class);
    Route::resource('/departement', App\Http\Controllers\DepartementController::class);
    Route::resource('/project', App\Http\Controllers\MasterProjectController::class);
    Route::post('/project/addUser', [App\Http\Controllers\MasterProjectController::class, 'addUser'])->name('project.addUser');
    Route::get('/pengaturan', [App\Http\Controllers\UserController::class, 'create'])->name('pengaturan');
    Route::post('/edit/name', [App\Http\Controllers\UserController::class, 'name'])->name('edit.name');
    Route::post('/edit/password', [App\Http\Controllers\UserController::class, 'password'])->name('edit.password');
});
