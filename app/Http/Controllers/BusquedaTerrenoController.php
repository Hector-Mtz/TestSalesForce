<?php

namespace App\Http\Controllers;

use App\Models\BusquedaTerreno;
use Illuminate\Http\Request;

class BusquedaTerrenoController extends Controller
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
        $validated = $request->validate([
            'nombre' => 'required'
        ]);

        BusquedaTerreno::create([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BusquedaTerreno $busquedaTerreno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusquedaTerreno $busquedaTerreno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $validated = $request->validate([
            'nombre' => 'required',
            'id' => 'required'
        ]);

        BusquedaTerreno::where('id','=',$request['id'])
        ->update([
            'nombre' => $request['nombre'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusquedaTerreno $busquedaTerreno)
    {
        //
    }
}
