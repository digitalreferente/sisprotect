<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Folio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente\Cliente;
use App\Models\Custodio\Custodio;
use App\Models\Tarifario\Tarifario;
use App\Models\Programacion\Programacion;
use App\Models\Programacion\AcompanantesProgramacion;
use App\Models\Programacion\EstatusProgramacion;
use App\Models\Programacion\FolioProgramacion;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MonitoreoController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listadomonitoreo()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        // dd($data);
        $tarifario = Tarifario::where('siaf_status', 1)->get();

        return view('monitoreo.listado-monitoreo', compact('data'));
    }

    public function monitoreodatatable(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $permisos = RolPermiso::where('role_id', $user->role)->get();
        $permiso_array = array();
        foreach ($permisos as $key => $value) {
            $permiso_array[] = $value->permission_id;
        }

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Programacion::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Programacion::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

        /* Getting the first element of the array. */
        $order_arr = $columnIndex_arr[0];

        /* Getting the column index of the column that is being sorted. */
        $order_column_index = $order_arr['column'];

        /* Getting the direction of the sort. */
        $order_dir = $order_arr['dir'];

        /* Getting the column name from the array of columns. */
        $order_column_name = $columnName_arr[$order_column_index]['data'];
        $order_column_dir = $order_dir;

        $order_column_dir = $order_column_dir == 'asc' ? 'asc' : 'desc';


        // Fetch records

        $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='name'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
                    ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
                    ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
                    ->where('programacion.siaf_status', 1)
                    ->where("programacion.cliente_id", $valor)
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }
        }

        if($valor == "No"){
            $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        }else{
            $totalRecords = count($records);
            $totalRecordswithFilter = count($records);          
        }

        $data_arr = array();
        $pro="";
        foreach($records as $record){

            $data_arr[] = array(
                "id" => $record->id,
                "folio" => $record->folio,
                "tipo_servicio" => $record->tipo_servicio,
                "estatus_programacion" => $record->estatus_programacion,
                "nombre_cliente" => $record->nombre_cliente,
                "dom_origen" => $record->dom_origen,
                "dom_destino" => $record->dom_destino,
                "fecha_servicio" => $record->fecha_servicio,
                'acciones'=>null,
            );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response);
    }

}