<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\RuletaAsesoreController;
use App\Http\Controllers\RuletaGeneralController;
use App\Http\Controllers\RuletaSedeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Models\Prospecto;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
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
    Route::get('/dashboard', function () 
    {
        $prospectos = Prospecto::select('prospectos.*')
        ->where('prospectos.tipo_prospecto','=',1)
        ->get();

        $prospectosGraph = DB::table('prospectos')
        ->selectRaw(
            'COUNT(prospectos.id) as contador,
             prospectos.created_at,
             prospectos.status,
             LEFT(prospectos.created_at,7) AS FechaString',
            )
        ->where('prospectos.tipo_prospecto','=',1)
        ->groupBy('FechaString','prospectos.status')
        ->get();

        return Inertia::render('Dashboard',[
            'prospectos' => $prospectos,
            'prospectosGraph' => $prospectosGraph
        ]);
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
    //edicion de ruleta_sede
    Route::post('/updateRuletaSede',[RuletaSedeController::class,'update'])->name('updateRuletaSede');
    //obtencion de usuarios
    Route::get('/usersList',[UserController::class,'index'])->name('users.list');
    //agregar nuevo asesor a una ruleta
    Route::post('/saveRuletaAsesor',[RuletaAsesoreController::class,'store'])->name('saveRuletaAsesor');
    //Ruta para revisar los asesores de una ruleta especifica
    Route::get('/checkAsesores',[RuletaAsesoreController::class,'index'])->name('checkAsesores');
    //Ruta para ver la informacion detallada del prospecto
    Route::get('/viewProspecto/{prospecto}',[ProspectoController::class,'viewProspecto'])->name('viewProspecto');
    //Ruta para guardar campos del lead que se editara
    Route::post('/editLead',[ProspectoController::class,'update'])->name('editLead');
    //Ruta para editar el status del lead
    Route::post('/editStatus',[ProspectoController::class,'editStatus'])->name('editStatus');
    //Ruta para guardar tareas
    Route::post('/saveTask',[TareaController::class,'store'])->name('saveTask');
    //Ruta para obtener duplicados en dado caso que haya
    Route::get('/getDuplicados',[ProspectoController::class,'getDuplicados'])->name('getDuplicados');
});
