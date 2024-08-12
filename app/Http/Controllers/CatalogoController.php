<?php

namespace App\Http\Controllers;

use App\Models\BusquedaTerreno;
use App\Models\CampanaCanal;
use App\Models\FormaContacto;
use App\Models\Idioma;
use App\Models\InversionAlMe;
use App\Models\MontoEnganche;
use App\Models\Origene;
use App\Models\ProductoDeInteres;
use App\Models\Sede;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogoController extends Controller
{
    //
    public function index()
    {
        $sedes = Sede::all();
        $productos = ProductoDeInteres::all();
        $origenes = Origene::all();
        $campanas_canales = CampanaCanal::all();
        $idiomas = Idioma::all();
        $montos_enganches = MontoEnganche::all();
        $busqueda_terrenos = BusquedaTerreno::all();
        $inversiones_al_mes = InversionAlMe::all();
        $formas_de_contacto = FormaContacto::all();

        return Inertia::render('Catalogos/Index', 
        [
           'sedes' => $sedes,
           'productos' => $productos,
           'origenes' => $origenes,
           'campana_canales' => $campanas_canales,
           'idiomas' => $idiomas,
           'busqueda_terrenos' => $busqueda_terrenos,
           'montos_enganches' => $montos_enganches,
           'inversiones_al_mes' => $inversiones_al_mes,
           'formas_de_contacto' => $formas_de_contacto
        ]);
    }

}
