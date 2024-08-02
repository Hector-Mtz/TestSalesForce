<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CatalogoController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Catalogos/Index', 
        [
    
        ]);
    }

}
