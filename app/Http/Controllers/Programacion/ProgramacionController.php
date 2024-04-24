<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente\Cliente;
use App\Models\Custodio\Custodio;
use App\Models\Tarifario\Tarifario;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgramacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodoprogramacion()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        // dd($data);
        $tarifario = Tarifario::where('siaf_status', 1)->get();

        return view('programacion.listado-programacion', compact('data'));
    }

    public function nuevaprogramacion()
    {
        $cliente = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();


        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($custodio as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';


        return view('programacion.agregar-programacion', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento'));
    }

    public function obtenertarifas(Request $request)
    {
        $tarifas = Tarifario::where('siaf_status', 1)->where('cliente_id', $request->id)->get();
        $cadena_tarifa = "";
        foreach ($tarifas as $tar) {
            $cadena_tarifa .= '"' . $tar->id . '":"' ."Origen: ". $tar->origen."- Destino: ".$tar->destino . '",';
        }
        $cadena_tarifa = '{' . rtrim($cadena_tarifa, ',') . '}';
        return response()->json(['success' => $cadena_tarifa]);
    }

}