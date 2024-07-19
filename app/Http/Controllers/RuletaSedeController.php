<?php

namespace App\Http\Controllers;

use App\Models\RuletaSede;
use App\Models\RuletaSedeProductos;
use App\Models\RuletaSedeSedes;
use Illuminate\Http\Request;

class RuletaSedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show(RuletaSede $ruletaSede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RuletaSede $ruletaSede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $request;
        //primero actualizamos la ruleta
        $ruleta = RuletaSede::where('id','=',$request['id'])
        ->update([
            'nombre' => $request['nombre'],
            'tipo_asignacion' => $request['asignacion']
        ]);
        
        //checkeamos las sedes
        if(count($request['sedes']) > 0)
        {
           for ($i=0; $i < count($request['sedes']) ; $i++) 
           { 
             $sede = $request['sedes'][$i];
             if($sede['inluir'] == true)
             {
                RuletaSedeSedes::updateOrCreare(
                    ['ruleta_sede_id' => $ruleta,
                     'sede_id' => $sede['id'],
                     'activo' => 1
                    ]
                );
             }
             else
             {
                RuletaSedeSedes::updateOrCreare(
                    ['ruleta_sede_id' => $ruleta,
                     'sede_id' => $sede['id'],
                     'activo' => 0
                    ]
                );
             }
           }
        }

        //checkeamos los productos
        if(count($request['productos_interes']) > 0)
        {
          for ($i=0; $i < count($request['productos_interes']) ; $i++) 
          { 
            $producto = $request['productos_interes'][$i];
            if($producto['incluir'] == true)
            {
              RuletaSedeProductos::updateOrCreate([
                'ruleta_sede_id' => $ruleta,
                'sede_id' => $sede['id'],
                'activo' => 1
              ]);
            }
            else
            {
              RuletaSedeProductos::updateOrCreate([
                    'ruleta_sede_id' => $ruleta,
                    'sede_id' => $sede['id'],
                    'activo' => 0
                  ]);
            }
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RuletaSede $ruletaSede)
    {
        //
    }
}
