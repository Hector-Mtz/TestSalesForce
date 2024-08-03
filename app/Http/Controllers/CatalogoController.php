<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogoController extends Controller
{
    //
    public function index()
    {
        $sedes = Sede::all();
        return Inertia::render('Catalogos/Index', 
        [
           'sedes' => $sedes
        ]);
    }

}
