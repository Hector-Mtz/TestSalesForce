<?php

namespace App\Http\Controllers;

use App\Models\Asignacione;
use App\Models\BusquedaTerreno;
use App\Models\CampanaCanal;
use App\Models\FormaContacto;
use App\Models\HorarioContacto;
use App\Models\Idioma;
use App\Models\InversionAlMe;
use App\Models\MontoEnganche;
use App\Models\Origene;
use App\Models\ProductoDeInteres;
use App\Models\Prospecto;
use App\Models\Sede;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $sedes = Sede::all();
        $asignaciones = Asignacione::all();
        $producto_interes = ProductoDeInteres::all();
        $campana_canal = CampanaCanal::all();
        $origenes = Origene::all();
        $busqueda_terreno = BusquedaTerreno::all();
        $inversiones_al_mes = InversionAlMe::all();
        $idiomas = Idioma::all();
        $montos_eganche = MontoEnganche::all();
        $formas_contacto = FormaContacto::all();
        $horarios=HorarioContacto::all();

        return Inertia::render('Prospectos/Index', 
        [
           'sedes' => $sedes,
           'asignaciones' => $asignaciones,
           'producto_interes' => $producto_interes,
           'campana_canal' => $campana_canal,
           'origenes' => $origenes,
           'busqueda_terreno' => $busqueda_terreno,
           'inversiones_al_mes' => $inversiones_al_mes,
           'idiomas' => $idiomas,
           'montos_eganche' => $montos_eganche,
           'formas_contacto' => $formas_contacto,
           'horarios' => $horarios
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
    public function show(Prospecto $prospecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prospecto $prospecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prospecto $prospecto)
    {
        //
    }
}
