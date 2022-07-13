<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use App\Models\Empresas;
use App\Models\Pacientes;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RecepcionsController extends Controller{

    public function index(Request $request){
      //Verificar sucursal
      $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
      // Lista de sucursales que tiene el usuario
      $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

      $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();


      $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();

      $pacientes = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();
      $doctores = User::where('id', Auth::user()->id)->first()->labs()->first()->doctores()->get();


      return view('recepcion.index',
      ['active'=>$active,'sucursales'=>$sucursales, 'empresas'=>$empresas,
      'pacientes'=>$pacientes, 'doctores' => $doctores, 'listas' => $listas]);  
    }  


    public function guardar(Request $request){
        dd($request);
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

        $recep = new Recepcions;
        $recep->folio           = $request->folio;
        $recep->numOrden        = $request->numOrden;
        $recep->numRegistro     = $request->numRegistro;
        $recep->id_paciente     = $request->id_paciente;
        $recep->id_empresa      = $request->id_empresa;
        $recep->servicio        = $request->servicio;
        $recep->tipPasiente     = $request->tipoPaciente;
        $recep->turno           = $request->turno;
        $recep->id_doctor       = $request->id_doctor;
        $recep->numCama         = $request->numCama;
        $recep->peso            = $request->peso;
        $recep->talla           = $request->talla;
        $recep->fur             = $request->fur;
        $recep->medicamento     = $request->medicamento;
        $recep->diagnostico     = $request->diagnostico;
        $recep->observaciones   = $request->observaciones;

        //recepcion has laboratories
        $laboratorio->recepcions()->save($recep);
        // recepcion has estudios
        // $recep->estudios()->save($recep);
        if($laboratorio) {
            $response = true;
        } else {
            $response = false;
        }
    
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
        // return redirect()->route('recepcion.index');
    }

    public function recepcion_captura_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        // Areas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();

        // Estudios para validad
        $estudios = Recepcions::all();
        return view('recepcion.captura.index',['active'     => $active, 
                                            'sucursales'    => $sucursales, 
                                            'areas'         => $areas,
                                            'estudios'      => $estudios
                                        ]);
    }

    public function recepcion_editar_index(Request $request){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        // Areas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
        
        $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();


        $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();
        $pacientes = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();
        $doctores = User::where('id', Auth::user()->id)->first()->labs()->first()->doctores()->get();
        $recepcions = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();

        return view('recepcion.editar.index',
                    ['active'=>$active,'sucursales'=>$sucursales, 
                    'empresas'=>$empresas,'pacientes'=>$pacientes, 
                    'doctores' => $doctores, 'listas' => $listas,
                    'areas'=>$areas, 'recepcions' => $recepcions]);
                    
    }

    public function recepcion_editar($id){
                //Verificar sucursal
                $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
                // Lista de sucursales que tiene el usuario
                $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
                // Areas
                $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
                
                $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();

                $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();
                $pacientes = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();
                $doctores = User::where('id', Auth::user()->id)->first()->labs()->first()->doctores()->get();

        $re = Recepcions::findOrFail($id);

        return view('recepcion.editar.editar',
        ['active'=>$active,'sucursales'=>$sucursales, 
        'empresas'=>$empresas,'pacientes'=>$pacientes, 
        'doctores' => $doctores, 'listas' => $listas,
        'areas'=>$areas,'re' =>$re]);
    }

    public function recepcion_actualizar(Request $request, $id){
        $recep = Recepcions::findOrFail($id);

        $recep->folio = $request->folio;
        $recep->numOrden = $request->numOrden;
        $recep->numRegistro = $request->numRegistro;
        $recep->id_empresa = $request->id_empresa;
        $recep->servicio = $request->servicio;
        $recep->tipPasiente = $request->tipPasiente;
        $recep->turno = $request->turno;
        $recep->id_doctor = $request->id_doctor;
        $recep->numCama = $request->numCama;
        $recep->peso = $request->peso;
        $recep->talla = $request->talla;
        $recep->fur = $request->fur;
        $recep->medicamento = $request->medicamento;
        $recep->diagnostico = $request->diagnostico;
        $recep->observaciones = $request->observaciones;
        $recep->listPrecio = $request->listPrecio;

        $recep->save();
        return redirect()->route('recepcion.editar');


    }

}
