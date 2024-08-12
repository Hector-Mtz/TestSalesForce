<?php

use App\Http\Controllers\BusquedaTerrenoController;
use App\Http\Controllers\CampanaCanalController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\FormaContactoController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\InversionAlMeController;
use App\Http\Controllers\MontoEngancheController;
use App\Http\Controllers\OrigeneController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductoDeInteresController;
use App\Http\Controllers\ProspectoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\RuletaAsesoreController;
use App\Http\Controllers\RuletaGeneralController;
use App\Http\Controllers\RuletaSedeController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use App\Models\Origene;
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

        $oportunidades_ganadas = Prospecto::select('prospectos.*')
        ->where('prospectos.tipo_prospecto','=',3)
        ->where('prospectos.status','=',9)
        ->get();

        $oportunidades_perdidas= Prospecto::select('prospectos.*')
        ->where('prospectos.tipo_prospecto','=',3)
        ->where('prospectos.status','=',8)
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

        $origenes = Origene::all();
        $prospectos_por_fuente = Prospecto::selectRaw(
            'origenes.nombre,COUNT(prospectos.id) as contador')
        ->leftJoin('origenes','prospectos.origen','origenes.id')
        ->groupBy('prospectos.origen')
        ->get();

        return Inertia::render('Dashboard',[
            'prospectos' => $prospectos,
            'prospectosGraph' => $prospectosGraph,
            'oportunidades_ganadas' => $oportunidades_ganadas,
            'oportunidades_perdidas' => $oportunidades_perdidas,
            'origenes' => $origenes,
            'prospectos_por_fuente' => $prospectos_por_fuente
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
    //Ruta para visualizacion de catalogos
    Route::get('/catalogos',[CatalogoController::class,'index'])->name('catalogos');
    //Ruta para visualizacion de catalogos
    Route::get('/reportes',[ReportesController::class,'index'])->name('reportes');
    //Ruta para guardar una nueva sede
    Route::post('/saveSede',[SedeController::class,'store'])->name('saveSede');
    //Ruta para guardar la edicion de la sede
    Route::post('/saveEditSede',[SedeController::class,'update'])->name('saveEditSede');
    //Ruta para guardar nuevos productos
    Route::post('/saveProducto',[ProductoDeInteresController::class,'store'])->name('saveProducto');
    //Ruta para guardar la edicion del producto
    Route::post('/saveEditProducto',[ProductoDeInteresController::class,'update'])->name('saveEditProducto');
    //Ruta para guardar nuevos origenes
    Route::post('/saveOrigen',[OrigeneController::class, 'store'])->name('saveOrigen');
    //Ruta para edicion de origenes
    Route::post('/saveEditOrigen',[OrigeneController::class, 'update'])->name('saveEditOrigen');
    //Ruta para guardar nuevas campañas canales
    Route::post('/saveCampCanal',[CampanaCanalController::class,'store'])->name('saveCampCanal');
    //Ruta para guardar edicion de campana canale
    Route::post('/saveEditCamp',[CampanaCanalController::class,'update'])->name('saveEditCamp');
    //Ruta para guardado de idioma
    Route::post('/saveIdioma', [IdiomaController::class,'store'])->name('saveIdioma');
    //Ruta para guardar edicion de idioma
    Route::post('/saveEditIdioma',[IdiomaController::class,'update'])->name('saveEditIdioma');
    //Ruta para guardar monto de enganche nuevo
    Route::post('/saveMontoE',[MontoEngancheController::class,'store'])->name('saveMontoE');
    //Ruta para edicion de monto de enganche nuevi
    Route::post('/saveEditMontoE',[MontoEngancheController::class,'update'])->name('saveEditMontoE');
    //Ruta para guardado de busqueda de terreno
    Route::post('/saveBusquedaT',[BusquedaTerrenoController::class, 'store'])->name('saveBusquedaT');
    //Ruta para edicion de busqueda de terreno
    Route::post('/saveEditBusquedaT',[BusquedaTerrenoController::class,'update'])->name('saveEditBusquedaT');
    //Ruta para guardar inversion al mes
    Route::post('/saveInversion',[InversionAlMeController::class,'store'])->name('saveInversion');
    //Ruta para guardar edicion de inversion al mes
    Route::post('/saveEditInversion',[InversionAlMeController::class,'update'])->name('saveEditInversion');
    //Ruta para guardar forma de contacto
    Route::post('/saveFormaContacto',[FormaContactoController::class,'store'])->name('saveFormaContacto');
    //Ruta para guardar edicion de forma de contacto
    Route::post('/saveEditFormaContacto',[FormaContactoController::class,'update'])->name('saveEditFormaContacto');
    //Ruta para descargar reportes
    Route::get('/exporProspectos',[ProspectoController::class,'exporProspectos'])->name('exporProspectos');
});
