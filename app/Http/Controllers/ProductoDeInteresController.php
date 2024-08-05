<?php

namespace App\Http\Controllers;

use App\Models\ProductoDeInteres;
use Illuminate\Http\Request;

class ProductoDeInteresController extends Controller
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

        ProductoDeInteres::create([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoDeInteres $productoDeInteres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductoDeInteres $productoDeInteres)
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

        ProductoDeInteres::where('id','=',$request['id'])
        ->update([
            'nombre' => $request['nombre']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoDeInteres $productoDeInteres)
    {
        //
    }
}
