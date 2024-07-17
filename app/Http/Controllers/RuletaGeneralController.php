<?php

namespace App\Http\Controllers;

use App\Models\RuletaGeneral;
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
        return Inertia::render('Ruletas/Index', 
        [

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
