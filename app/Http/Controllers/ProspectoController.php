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
        $validated = $request->validate([
            'sede' => 'required | min:1',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required'
        ]);

        //primero generamos el lead para despues mandarlo a ruleta para su asignacio
        $newProspecto = Prospecto::create
        ([
           'nombre' => $request['nombre'],
           'apellidos' => $request['apellidos'],
           'email' => $request['email'],
           'telefono' => $request['telefono'],
           'mensaje' => $request['mensaje'],
           'propietario' => $request['propietario_del_prospecto'],
           'asignacion' => $request['asignacion'],
           'sede' => $request['sede'],
           'tipo_prospecto' => 1, //prospecto
           'status' => 1,
           'producto_de_interes' => $request['producto_interes'],
           'campana_canal' => $request['campana_canal'],
           'origen' => $request['origen'],
           'monto_enganche' => $request['monto_enganche'],
           'forma_contacto' => $request['forma_de_contacto'],
           'horario_contacto' => $request['horario_contacto'],
           'busqueda_terreno' => $request['busca_terreno_para'],
           'inversion_al_mes' => $request['inversion_al_mes'],
           'tiempo_inversion' => $request['tiempo_inversion'],
           'idioma' => $request['idioma'],
           'UTM_Source' => $request['UTM_Source'],
           'UTM_Content' =>$request['UTM_Content'],
           'UTM_Medium' => $request['UTM_Medium'],
           'UTM_Campaign' => $request['UTM Term'],
           'First_Click' => $request['First_Click_Channel'],
           'First_Click_Campaign' => $request['First_Click_Campaign'],
           'GCLID' => $request['GCLID'],
           'IP_Adress' => $request['Ip_adrees'],
           'Device' => $request['Device'],
           'Operating_System' => $request['Operating_System'],
           'Browser' => $request['Browser'],
           'First_Click_Content' => $request['First_Click_Content'],
           'First_Click_Landing_Page' => $request['First_Click_Landing_Page'],
           'Time_Zone' => $request['Time_Zone'],
           'City' => $request['City'],
           'Country' => $request['Country'],
           'State' => $request['State']
        ]);
    }

    public function runRuleta ($prospecto)
    {
        return 'hola';
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
