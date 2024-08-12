<?php

namespace App\Http\Controllers;

use App\Models\FormaContacto;
use Illuminate\Http\Request;

class FormaContactoController extends Controller
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
            'forma' => 'required',
        ]);

        FormaContacto::create([
            'forma' => $request['forma']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(FormaContacto $formaContacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormaContacto $formaContacto)
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
            'forma' => 'required',
            'id' => 'required'
        ]);

        FormaContacto::where('id','=',$request['id'])
        ->update([
            'forma' => $request['forma']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormaContacto $formaContacto)
    {
        //
    }
}
