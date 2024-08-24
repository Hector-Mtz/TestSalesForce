<?php

namespace App\Http\Controllers;

use App\Models\CampanaCanal;
use App\Models\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        //
        $valores = Prospecto::select('prospectos.*');

        if(request()->has('seleccion'))
        {
          switch ($request['seleccion']) 
          {
            case 'Prospectos':
                   $valores = Prospecto::select(
                   'prospectos.*',
                   'origenes.nombre as origen_name',
                    DB::raw("CONCAT(name, ' ', ap_paterno,' ',ap_materno) as full_name"),

                   )
                   ->join('users','prospectos.propietario','users.id')
                   ->leftJoin('origenes','prospectos.origen','origenes.id')
                   ->where('prospectos.tipo_prospecto','=',1);

                   if(request()->has('date1') && request()->has('date2') )
                   { 
                    $date1 = substr($request['date1'], 0,10);
                    $date2 = substr($request['date2'], 0,10);
                    $valores->whereBetween('prospectos.created_at', [$date1, $date2]);
                   }

                   if (request()->has('searchs')) 
                   {
                    $valores->where(function ($query) 
                    {
                        foreach (request('searchs') as $field => $search) 
                        {
                            if($field !== 'status_progress.nombre')
                            {
                                if($search !== null)
                                {
                                    $searchLike = '%' . strtr($search, array("'" => "\\'", "%" => "\\%")) . '%';
                                    $query->where($field, 'LIKE', $searchLike);
                                }
                            }
                        }
                    });
                   }

                break;
            case 'Oportunidades':
                   $valores = Prospecto::select(
                     'prospectos.*',
                     'roles.nombre as funcion',
                     'status_progress.nombre as status_name',
                     DB::raw("CONCAT(name, ' ', ap_paterno,' ',ap_materno) as full_name"),
                     DB::raw("SUBSTRING(prospectos.created_at, 1, 10) as date")
                   )
                   ->join('users','prospectos.propietario','users.id')
                   ->join('roles','users.role_id','roles.id')
                   ->join('status_progress','prospectos.status','status_progress.id')
                   ->where('prospectos.tipo_prospecto','=',2);

                   if(request()->has('date1') && request()->has('date2') )
                   { 
                    $date1 = substr($request['date1'], 0,10);
                    $date2 = substr($request['date2'], 0,10);
                    $valores->whereBetween('prospectos.created_at', [$date1, $date2]);
                   }
                   if (request()->has('searchs')) 
                   {
                    $valores->where(function ($query) 
                    {
                        foreach (request('searchs') as $field => $search) 
                        {
                            if($field !== 'origenes.nombre')
                            {
                                if($search !== null)
                                {
                                    $searchLike = '%' . strtr($search, array("'" => "\\'", "%" => "\\%")) . '%';
                                    $query->where($field, 'LIKE', $searchLike);
                                }
                            }  
                        }
                    });
                   }
                break;
            case 'Campañas':
                $valores = CampanaCanal::select('campana_canals.*');
             break; 
            case 'Actividades con prospecto':
                $valores = Prospecto::select('prospectos.*')
                ->selectRaw('COUNT(prospectos.id) as contador');

                if(request()->has('date1') && request()->has('date2') )
                { 
                 $date1 = substr($request['date1'], 0,10);
                 $date2 = substr($request['date2'], 0,10);
                 $valores->whereBetween('prospectos.created_at', [$date1, $date2]);
                }
                break;
            case 'Conteo motivos de descarte':
                 $valores = Prospecto::select('prospectos.*');
                 if(request()->has('date1') && request()->has('date2') )
                 { 
                  $date1 = substr($request['date1'], 0,10);
                  $date2 = substr($request['date2'], 0,10);
                  $valores->whereBetween('prospectos.created_at', [$date1, $date2]);
                 }
                break;
            default:
                  $valores = Prospecto::select('prospectos.*')
                  ->where('prospectos.tipo_prospecto','=',1);

                break;
          }
        }

        

        return Inertia::render('Reportes/Index', 
        [
           'valores' => fn() => $valores->get()
        ]);
    }

}
