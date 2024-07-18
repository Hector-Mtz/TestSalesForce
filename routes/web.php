<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\RuletaGeneralController;
use App\Http\Controllers\UserController;
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
    //Creacion de nuevo rol
    Route::post('/saveRol',[RoleController::class,'store'])->name('saveRol');
    //Creacion de nuevo permiso
    Route::post('/savePermission',[PermissionController::class,'store'])->name('savePermission');
    //Ruta para setear permisos por rol
    Route::get('/role_permissions',[RolesPermissionController::class,'setPermission'])->name('roles.permissions');
    //Ruta para crear nuevos usuarios
    Route::post('/saveUser',[UserController::class,'store'])->name('saveUser');
    //Ruta para guardar nuevo prospecto desde el modal de nuevo prospecto
    Route::post('/saveProspecto',[ProspectoController::class, 'store'])->name('saveProspecto');
    //Ruta para ver el apartado de ruletas
    Route::get('/ruletas',[RuletaGeneralController::class,'index'])->name('ruletas');
    //creacion de ruletas
    Route::post('/saveRuleta',[RuletaGeneralController::class,'store'])->name('saveRuleta');
    //edicion de ruleta padre
    Route::post('/updateRuletaPadre',[RuletaGeneralController::class,'update'])->name('updateRuletaPadre');
});
