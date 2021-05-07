<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/', [Controller::class, 'index'])->name('welcome');

    Route::resource('/registry', RegistryController::class);

    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions');

    Route::post('/registry-import', [RegistryController::class, 'import'])->name('registry.import');

    Route::get('/registry-export', [RegistryController::class, 'export'])->name('registry.export');

    Route::resource('/user', UserController::class);
});
