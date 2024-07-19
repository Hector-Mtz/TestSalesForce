<?php

namespace App\Http\Controllers;

use App\Models\RuletaSede;
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
                
             }
             else
             {
                
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
