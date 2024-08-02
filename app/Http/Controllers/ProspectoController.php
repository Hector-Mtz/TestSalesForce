<?php

namespace App\Http\Controllers;

use App\Mail\SendNotification;
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
use App\Models\RuletaAsesore;
use App\Models\RuletaGeneral;
use App\Models\RuletaSede;
use App\Models\RuletaSedeProductos;
use App\Models\RuletaSedeSedes;
use App\Models\Sede;
use App\Models\StatusProgress;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        $prospectos = Prospecto::select('prospectos.*',
        'asignaciones.nombre as asignacion_name',
        'sedes.nombre as sede_name',
        'producto_de_interes.nombre as productoInteres',
        'campana_canals.nombre as campanaCanal',
        'users.name as userName',
        'users.ap_paterno as userApP',
        'users.ap_materno as userApM',
        'tipo_prospectos.nombre as tipoProspecto',
        'status_progress.nombre as statusP'
        )
        ->leftJoin('asignaciones','prospectos.asignacion','asignaciones.id')
        ->join('sedes','prospectos.sede','sedes.id')
        ->leftJoin('producto_de_interes','prospectos.producto_de_interes','producto_de_interes.id')
        ->leftJoin('campana_canals','prospectos.campana_canal','campana_canals.id')
        ->join('users','prospectos.propietario','users.id')
        ->join('tipo_prospectos','prospectos.tipo_prospecto','tipo_prospectos.id')
        ->leftJoin('status_progress','prospectos.status','status_progress.id');

        return Inertia::render('Prospectos/Index', 
        [
           'prospectos' => fn() => $prospectos->paginate(20),
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

    public function viewProspecto (Prospecto $prospecto)
    {
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
        $status_progress = StatusProgress::select('status_progress.*')
        ->where('status_progress.tipo_prospecto_status','=',$prospecto['tipo_prospecto'])
        ->get();
        $tareas = Tarea::select('tareas.*','caregorias_tareas.nombre as categoria')
        ->Join('caregorias_tareas','tareas.cat_tareas','caregorias_tareas.id')
        ->where('tareas.prospecto_id','=',$prospecto['id'])
        ->get();
        return Inertia::render('Prospectos/Individual/Index', 
        [
            'prospecto' => $prospecto,
            'tareas' => $tareas,
            'status_progress' => $status_progress,

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

    public function getDuplicados (Request $request)
    {
        $prospecto = Prospecto::select('prospectos.*')
        ->where('prospectos.id','=',$request['prospecto'])
        ->first();
        
        $duplicados = Prospecto::select('prospectos.*', 'sedes.nombre as sede_name',
        'producto_de_interes.nombre as producto_name','status_progress.nombre as status_name')
        ->join('status_progress','prospectos.status','status_progress.id')
        ->leftJoin('sedes','prospectos.sede','sedes.id')
        ->leftJoin('producto_de_interes','prospectos.producto_de_interes','producto_de_interes.id')
        ->where('prospectos.id','!=',$prospecto['id'])
        ->where(function ($query) use ($prospecto)
        {
            $query->where('prospectos.telefono','LIKE', substr($prospecto['telefono'],0,10))
            ->orWhere('prospectos.email','=', $prospecto['email']);
        })
        ->orderBy('created_at', 'ASC')
        ->get();

        return $duplicados;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function sendMail () //funcion de prueba
    {
          $user = User::select('users.*')
          ->where('id','=',2)
          ->first();

          $lead = Prospecto::select('prospectos.*')
          ->first();

          Mail::to('programador.mktd1@ciudadmaderas.com')
          ->send(new SendNotification($user, $lead));
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

      return $this->runRuleta($newProspecto);
    }

    public function runRuleta($prospecto)
    {
        //hay que chequear antes la duplicidad
        $prospectos = Prospecto::select('prospectos.*')
        ->where('prospectos.id','!=',$prospecto['id'])
        ->where(function ($query) use ($prospecto)
        {
            $query->where('prospectos.telefono','LIKE', substr($prospecto['telefono'],0,10))
            ->orWhere('prospectos.email','=', $prospecto['email']);
        })
        ->orderBy('created_at', 'ASC')
        ->get();

        if(count($prospectos) > 0)
        {
           for ($i=0; $i < count($prospectos); $i++) 
           { 
             $prospectoTemporal = $prospectos[$i];
             if($prospectoTemporal['propietario'] !== 1) //sino es admin
             {
                Prospecto::where('id','=',$prospecto['id'])
                ->update(['propietario' => $prospectoTemporal['propietario'],
                          'vendedor_anterior' => $prospecto['propietario']
                         ]);
               break;
             }
           }
        }
        else
        {
          //primero obtenemos el asesor para setear, 
          $asesor = $this->getAsesores($prospecto); //funcion de ruletas
          if($asesor !== null)
          {
             //actualizamos el propietario
             Prospecto::where('id','=',$prospecto['id'])
             ->update([
               'vendedor_anterior' => $prospecto['propietario'],
               'propietario' => $asesor['asesor']
             ]);

             $emailAsesor = User::select('users.*')
             ->where('id','=',$asesor['asesor'])
             ->first();

             Mail::to($emailAsesor['email'])->send(new SendNotification($emailAsesor, $prospecto ));
          }
          else
          {
            $asesor=$this->ruletaNacional();
            //actualizamos el propietario
            Prospecto::where('id','=',$prospecto['id'])
            ->update([
              'vendedor_anterior' => $prospecto['propietario'],
              'propietario' => $asesor['asesor']
            ]);

            $emailAsesor = User::select('users.*')
            ->where('id','=',$asesor['asesor'])
            ->first();

            Mail::to($emailAsesor['email'])->send(new SendNotification($emailAsesor, $prospecto));
          }
        }
    }

    public function getAsesores ($prospecto)
    {
        date_default_timezone_set('America/Mexico_City');
        $fecha_server = date("Y-m-d H:i:s");
        //primero buscamos que tipo de asignacion es el prospecto
        switch ($prospecto['asignacion']) 
        {
            case 1: //sede
                if($prospecto['sede'] !== null)//consultamos los asesores por esa sede
                {
                    $asesor = null;
                    //necesitamos obtener la ruleta_sede por medio de la sede del prospecto
                    $ruleta_sede_sede = RuletaSedeSedes::select('ruleta_sede_sedes.*')
                    ->where('ruleta_sede_sedes.sede_id','=',$prospecto['sede'])
                    ->first();

                    $asesor =  RuletaAsesore::select(
                        'ruleta_asesores.id',
                        'ruleta_asesores.asesor',
                        'ruleta_asesores.asignaciones'
                    )
                    ->where('ruleta_asesores.ruleta_sede','=',$ruleta_sede_sede['ruleta_sede_id'])
                    ->orderBy('ultima_asignacion','ASC')
                    ->first();

                    RuletaAsesore::where('ruleta_asesores.id','=',$asesor['id'])
                    ->update([
                        'asignaciones' => $asesor['asignaciones']+1,
                        'ultima_asignacion' => $fecha_server
                    ]);

                    //actualizamos la cantida de asignaciones de la ruleta_Sede
                    $ruleta_sede = RuletaSede::select('ruleta_sedes.*')
                    ->where('ruleta_sedes.id','=',$ruleta_sede_sede['ruleta_sede_id'])
                    ->first();

                    RuletaSede::where('ruleta_sedes.id','=',$ruleta_sede['id'])
                    ->update([
                      'asignaciones' => $ruleta_sede['asignaciones'] +1,
                      'ultima_asignacion' => $fecha_server
                    ]);

                    return $asesor; 
                }
                break;
            case 2: //producto
                //SI ES RULETA PADRE TIENE QUE DIVIDIRLO IGUALMENTE
                 $ruleta_sede_producto = RuletaSedeProductos::select('ruleta_sede_productos.*')
                 ->join('ruleta_sedes','ruleta_sede_productos.ruleta_sede_id','ruleta_sedes.id')
                 ->where('ruleta_sede_productos.producto_id','=',$prospecto['producto_de_interes'])
                 ->orderBy('ultima_asignacion','ASC')
                 ->first();
                 $asesor = null;
                 $asesor =  RuletaAsesore::select(
                    'ruleta_asesores.id',
                    'ruleta_asesores.asesor',
                    'ruleta_asesores.asignaciones'
                )
                ->where('ruleta_asesores.ruleta_sede','=',$ruleta_sede_producto['ruleta_sede_id'])
                ->orderBy('ultima_asignacion','ASC')
                ->first();

                RuletaAsesore::where('ruleta_asesores.id','=',$asesor['id'])
                ->update([
                    'asignaciones' => $asesor['asignaciones']+1,
                    'ultima_asignacion' => $fecha_server
                ]);

                 //actualizamos la cantida de asignaciones de la ruleta_Sede
                 $ruleta_sede = RuletaSede::select('ruleta_sedes.*')
                 ->where('ruleta_sedes.id','=',$ruleta_sede_producto['ruleta_sede_id'])
                 ->first();
                
                RuletaSede::where('ruleta_sedes.id','=',$ruleta_sede['id'])
                ->update([
                  'asignaciones' => $ruleta_sede['asignaciones'] +1,
                  'ultima_asignacion' => $fecha_server
                ]);
                
                return $asesor; 

                break;
            case 4: //zona sede / grupo (mini ruletas)
                  //Primero hay que buscar la ruleta padre para despues dividir
                  //entre las ruleta hijo
                  $ruleta_padre = RuletaGeneral::select('ruleta_generals.*')
                  ->where('ruleta_generals.sede','=',$prospecto['sede'])
                  ->first();

                  $ruleta_sede = RuletaSede::select('ruleta_sedes.*')
                  ->where('ruleta_sedes.ruleta_general','=',$ruleta_padre['id'])
                  ->orderBy('ultima_asignacion')
                  ->first();
                  $asesor = null;
                  $asesor =  RuletaAsesore::select(
                    'ruleta_asesores.id',
                    'ruleta_asesores.asesor',
                    'ruleta_asesores.asignaciones'
                   )
                   ->where('ruleta_asesores.ruleta_sede','=',$ruleta_sede['id'])
                   ->orderBy('ultima_asignacion','ASC')
                   ->first();
    
                   RuletaAsesore::where('ruleta_asesores.id','=',$asesor['id'])
                   ->update([
                       'asignaciones' => $asesor['asignaciones']+1,
                       'ultima_asignacion' => $fecha_server
                   ]);

                   RuletaSede::where('ruleta_sedes.id','=',$ruleta_sede['id'])
                   ->update([
                     'asignaciones' => $ruleta_sede['asignaciones'] +1,
                     'ultima_asignacion' => $fecha_server
                   ]);
                   return $asesor; 
                break;
            default: //nacional
                return $this->ruletaNacional();
                break;
        }

    }

    public function ruletaNacional()
    {
        date_default_timezone_set('America/Mexico_City');
        $fecha_server = date("Y-m-d H:i:s");
         //tomamos todas las sedes y las acomodamos por ultima_asignacion
         $siguienteRuletaParaAsignar = RuletaSede::select('ruleta_sedes.*')
         ->orderBy('ruleta_sedes.ultima_asignacion','ASC')
         ->first();
         $asesor =  RuletaAsesore::select(
           'ruleta_asesores.id',
           'ruleta_asesores.asesor',
           'ruleta_asesores.asignaciones'
         )
         ->where('ruleta_asesores.ruleta_sede','=',$siguienteRuletaParaAsignar['id'])
         ->orderBy('ultima_asignacion','ASC')
         ->first();
         RuletaAsesore::where('ruleta_asesores.id','=',$asesor['id'])
         ->update([
             'asignaciones' => $asesor['asignaciones']+1,
             'ultima_asignacion' => $fecha_server
         ]);
         RuletaSede::where('ruleta_sedes.id','=',$siguienteRuletaParaAsignar['id'])
         ->update([
           'asignaciones' => $siguienteRuletaParaAsignar['asignaciones'] +1,
           'ultima_asignacion' => $fecha_server
         ]);

         return $asesor; 
    }

    public function editStatus (Request $request)
    {
       Prospecto::where('id','=',$request['id'])
       ->update([
        'status' => $request['status']
       ]);

       redirect()->back();
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
    public function update(Request $request)
    {
        //
        Prospecto::where('id','=',$request['id'])
        ->update([
          'nombre' => $request['nombre'],
          'apellidos' => $request['apellidos'],
          'email' => $request['email'],
          'telefono' => $request['telefono'],
          'mensaje' => $request['mensaje'],
          //'propietario' => $request['propietario_del_prospecto'],
          'asignacion' => $request['asignacion'],
          'sede' => $request['sede'],
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

        $prospecto = Prospecto::select('prospectos.*')
        ->where('id','=',$request['id'])
        ->first();

        if($request->has('propietario_del_prospecto'))
        {
           //se esta cambiando el propietario
           if($request['propietario_del_prospecto'] !== $prospecto['propietario'] ) 
           {
              //verificamos si tiene el permiso adecuado para editar, de no ser asi no hara nada
              if($request['editor']['role_id'] == 1) //puede editar
              {
                 Prospecto::where('id','=',$request['id'])
                 ->update([
                  'propietario' => $request['propietario_del_prospecto'],
                  'vendedor_anterior' => $prospecto['propietario']
                 ]);
              }
           }
        }

        redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prospecto $prospecto)
    {
        //
    }
}
