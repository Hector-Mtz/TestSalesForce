<?php

namespace App\Http\Controllers;

use App\Models\CampanaCanal;
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
        return Inertia::render('Catalogos/Index', 
        [
           'sedes' => $sedes,
           'productos' => $productos,
           'origenes' => $origenes,
           'campana_canales' => $campanas_canales
        ]);
    }

}
