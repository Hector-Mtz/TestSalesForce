<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\RolesPermissionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    //ruta leads
    Route::get('/prospectos',[ProspectoController::class,'index'])->name('prospectos');
    //ruta roles y permisos
    Route::get('/roles_permisos',[RolesPermissionController::class,'index'])->name('roles_permisos');
    //ruta para obtener roles por permisos
    Route::get('/getPermisosByRol',[PermissionController::class, 'getPermisosByRol'])->name('getPermisosByRol');
});
