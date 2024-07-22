<?php

namespace App\Http\Controllers;

use App\Models\RuletaAsesore;
use Illuminate\Http\Request;

class RuletaAsesoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
       return RuletaAsesore::select('ruleta_asesores.*',
       'users.name as nombre_user', 'users.ap_paterno as ap_paterno', 'users.ap_materno as ap_materno'
       )
       ->join('users','ruleta_asesores.asesor','users.id')
       ->where('ruleta_asesores.ruleta_sede','=',$request['ruleta_id'])
       ->paginate(10);
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
            'asesor' => 'required | min:1',
        ]);
       
        RuletaAsesore::updateOrCreate(
            ['ruleta_sede' => $request['ruleta_sede']],
            ['creado_por' => $request['creado_por'],
             'asignaciones' => 0,
             'asesor' => $request['asesor']]
        );

        redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(RuletaAsesore $ruletaAsesore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RuletaAsesore $ruletaAsesore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RuletaAsesore $ruletaAsesore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RuletaAsesore $ruletaAsesore)
    {
        //
    }
}
