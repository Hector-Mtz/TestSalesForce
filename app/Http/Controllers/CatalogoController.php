<?php

namespace App\Http\Controllers;

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
        return Inertia::render('Catalogos/Index', 
        [
           'sedes' => $sedes,
           'productos' => $productos,
           'origenes' => $origenes
        ]);
    }

}
