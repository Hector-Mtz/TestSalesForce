<?php

namespace App\Http\Controllers;

use App\Mail\OptionalMail;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PSpell\Config;

class TareaController extends Controller
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
        date_default_timezone_set('America/Mexico_City');
        Tarea::create(
            [
                'comentarios' => $request['comentarios'], 
                'mensaje_whats' => $request['mensaje_wa'],
                'from_email' => $request['from'] ,
                'to_email' => $request['to'] ,
                'asunto_mail' => $request['asunto_mail'],
                'cuerpo_mail' => $request['cuerpo_mail'],
                'cat_tareas' => $request['asunto'],
                'prospecto_id' => $request['prospecto'],
                'asesor' => $request['asesor'],
            ]
           );

       if($request['asunto'] == 2) //si es email, mandara email desde la plataforma
       {
         Mail::to($request['to'])
         ->send(new OptionalMail($request['cuerpo_mail'], $request['asunto_mail'],$request['from']));
         /*
          Mail::send('emails/optional-email',$data,function($message) use($request)
          {
              $message->from($request['from'],$request['from']); //correo y nombre de remitente
          
              $message->to($request['to'] ); //correo del receptor ->cc('bar@example.com') para copia es esa funcion
          });
          */
       }

       redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
