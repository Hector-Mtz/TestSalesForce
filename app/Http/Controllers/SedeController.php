<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
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
            'nombre' => 'required',
        ]);

        Sede::create(
            ['nombre' => $request['nombre'],
             'id_crm' => $request['id_crm']
            ]
        );
        redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Sede $sede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sede $sede)
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

        Sede::where('id','=',$request['id'])
        ->update([
            'nombre' => $request['nombre'],
            'id_crm' => $request['id_crm']
        ]);

        redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sede $sede)
    {
        //
    }
}
