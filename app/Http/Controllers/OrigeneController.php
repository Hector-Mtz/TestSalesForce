<?php

namespace App\Http\Controllers;

use App\Models\Origene;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrigeneController extends Controller
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

        Origene::create([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Origene $origene)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Origene $origene)
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

        Origene::where('id','=',$request['id'])
        ->update([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Origene $origene)
    {
        //
    }
}
