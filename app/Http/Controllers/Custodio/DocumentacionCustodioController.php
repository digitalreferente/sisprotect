<?php

namespace App\Http\Controllers\Custodio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Models\Custodio\DocumentacionCustodio;

class DocumentacionCustodioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodoccustodio()
    {
        $data = DocumentacionCustodio::where('siaf_status', 1)->get();

        return view('custodio.documentacion-custodio.listado-documentos-custodio', compact('data'));
    }

    public function documentoscustodiodatatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DocumentacionCustodio::select('count(*) as allcount')->count();
        $totalRecordswithFilter = DocumentacionCustodio::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();
        // Fetch records
        $records = DocumentacionCustodio::select('custodio_documentacion.id', 'custodio_documentacion.tipo_documento', 'custodio_documentacion.siaf_status')
            ->where('custodio_documentacion.siaf_status', 1)
            ->skip($start)
            ->take($rowperpage);

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='nombre'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);
                    $records = $records->where("custodio_documentacion.tipo_documento", '=' , $valor);
                }
            }
        }

        if($valor == "No"){
            $records= $records->get();
        }else{
            $records = $records->get();
            $totalRecords = count($records);
            $totalRecordswithFilter = count($records);          
        }

        $data_arr = array();
        $pro="";
        foreach($records as $record){

            $data_arr[] = array(
                "id" => $record->id,
                "nombre" => $record->tipo_documento,
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


    public function guardardocumento(Request $request)
    {


        $data = [
            'tipo_documento' => $request->documento,
            'siaf_status' => 1,
            'iduserCreated' => auth()->user()->id,
            'iduserUpdated' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionCustodio::insert($data);

        session()->flash('success', 'El registro se creo correctamente');
        return redirect()->route('doccustodio.listadodoccustodio');

    }

    public function editardocumento(Request $request)
    {
        $data = [
            'tipo_documento' => $request->documento,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionCustodio::where('id', $request->id_documento)->update($data);

        session()->flash('success', 'El registro modifico correctamente');
        return redirect()->route('doccustodio.listadodoccustodio');       
    }

    public function desactivardocumento(Request $request)
    {
        $data = [
            'siaf_status' => 2,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionCustodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se desactivo correctamente');
        return redirect()->route('doccustodio.listadodoccustodio');    
    }

    public function catalogodocinactivos()
    {
        $data = DocumentacionCustodio::where('siaf_status', 2)->get();

        return view('custodio.documentacion-custodio.listado-documentos-custodio-inactivos', compact('data'));
    }

    public function activardocumento(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionCustodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se activo correctamente');
        return redirect()->route('doccustodio.catalogodocinactivos');    
    }

}