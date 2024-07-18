<?php

namespace App\Http\Controllers;

use App\Models\Asignacione;
use App\Models\ProductoDeInteres;
use App\Models\RuletaGeneral;
use App\Models\RuletaSede;
use App\Models\RuletaSedeProductos;
use App\Models\RuletaSedeSedes;
use App\Models\Sede;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RuletaGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sedes = Sede::all();
        $asignaciones = Asignacione::all();
        $producto_interes = ProductoDeInteres::all();

        $ruletas_padre = RuletaGeneral::select('ruleta_generals.*',
        'sedes.nombre as sede_name', 'users.name as usuario_nombre')
        ->join('sedes','ruleta_generals.sede','sedes.id')
        ->join('users','ruleta_generals.creado_por','users.id');

        $ruletas_sede = RuletaSede::select('ruleta_sedes.*',
        'asignaciones.nombre as asignacion','ruleta_generals.nombre as ruleta_padre')
        ->join('asignaciones','ruleta_sedes.tipo_asignacion','asignaciones.id')
        ->leftjoin('ruleta_generals','ruleta_sedes.ruleta_general','ruleta_generals.id');

        return Inertia::render('Ruletas/Index', 
        [
            'sedes' => $sedes,
            'asignaciones' => $asignaciones,
            'producto_interes' => $producto_interes,

            'ruletas_padre' => fn() => $ruletas_padre->paginate(15),
            'ruletas_sede' => fn() => $ruletas_sede->paginate(15)

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        switch ($request['tipo_ruleta']) 
        {
            case 'ruleta_sede':
                //primero creamos la ruleta para despues asociale las sedes y productos
                $new_ruleta_sede = RuletaSede::updateOrCreate(
                    ['nombre' => $request['nombre']],
                    ['creado_por' => $request['creador'],
                     'tipo_asignacion' => $request['asignacion'],
                     'asignaciones' => 0
                    ]);
                
                for ($i=0; $i < count($request['sedes']); $i++) 
                { 
                    $sede = $request['sedes'][$i];
                    if($sede['inluir'] == true)
                    {
                       RuletaSedeSedes::updateOrCreate([
                         'ruleta_sede_id' => $new_ruleta_sede['id'],
                         'sede_id' => $sede['id']
                       ]);
                    }
                }

                for ($i=0; $i < count($request['producto_interes']) ; $i++) 
                { 
                   $producto = $request['producto_interes'][$i];
                   if($producto['incluir'] == true)
                   {
                     RuletaSedeProductos::updateOrCreate([
                        'ruleta_sede_id' => $new_ruleta_sede['id'],
                        'producto_id' => $producto['id']
                     ]);
                   }
                }
                
                break;
            case 'ruleta_padre':
                $new_ruleta_padre = RuletaGeneral::updateOrCreate([
                    'nombre' => $request['nombre'],
                    'sede' => $request['sede'],
                    'creado_por' => $request['creador']
                ]);
                break;
            case 'ruleta_asesores':
            break;

            redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RuletaGeneral $ruletaGeneral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RuletaGeneral $ruletaGeneral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RuletaGeneral $ruletaGeneral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RuletaGeneral $ruletaGeneral)
    {
        //
    }
}
