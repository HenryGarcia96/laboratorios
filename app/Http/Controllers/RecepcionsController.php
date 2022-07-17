<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use App\Models\Empresas;
use App\Models\Estudio;
use App\Models\Pacientes;
use Illuminate\Support\Facades\DB;
use App\Models\Recepcions;
use App\Models\User;
use Carbon\Carbon;
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


        $a = rand(100000,999999);

        return view('recepcion.index',
        ['active'=>$active,'sucursales'=>$sucursales, 'empresas'=>$empresas,
        'pacientes'=>$pacientes, 'doctores' => $doctores, 'listas' => $listas, 'a' => $a]);  
    }  


    public function guardar(Request $request){

        $estudios = $request->only('lista');
        $data = $request->only('data');
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

        $recep = new Recepcions;
        $recep->folio           = $data['data'][1]['value'];
        $recep->numOrden        = $data['data'][2]['value'];
        $recep->numRegistro     = $data['data'][3]['value'];
        $recep->id_paciente     = $data['data'][4]['value'];
        $recep->id_empresa      = $data['data'][5]['value'];
        $recep->servicio        = $data['data'][6]['value'];
        $recep->tipPasiente     = $data['data'][7]['value'];
        $recep->turno           = $data['data'][8]['value'];
        $recep->id_doctor       = $data['data'][9]['value'];
        $recep->numCama         = $data['data'][10]['value'];
        $recep->peso            = $data['data'][11]['value'];
        $recep->talla           = $data['data'][12]['value'];
        $recep->fur             = $data['data'][13]['value'];
        $recep->f_flebotomia    = $data['data'][14]['value'];
        $recep->num_vuelo       = $data['data'][15]['value'];
        $recep->pais_destino    = $data['data'][16]['value'];
        $recep->aerolinea       = $data['data'][17]['value'];
        $recep->medicamento     = $data['data'][18]['value'];
        $recep->diagnostico     = $data['data'][19]['value'];
        $recep->observaciones   = $data['data'][20]['value'];
        
        $recep->num_total       = $data['data'][21]['value']; 

        $recepcion = Recepcions::where('folio', $recep->folio)->first();
        //recepcion has laboratories
        $laboratorio->recepcions()->save($recep);

        // Guardamos los estudios
        foreach ($estudios as $key => $value) {
            foreach($value as $id => $valor){
                $estudio = Estudio::where('clave', $valor)->first();
    
                $recepcion->estudios()->save($estudio);

            }
            # code...
            // Recepcions has estudios
            
        }

        // recepcion has estudios
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
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get()->load(['pacientes', 'empresas']);

        return view('recepcion.captura.index',['active'     => $active, 
                                            'sucursales'    => $sucursales, 
                                            'areas'         => $areas,
                                            'estudios'      => $estudios
                                        ]);
    }

    public function recepcion_captura_consulta(Request $request){
        $fecha_inicio = Carbon::parse($request->fecha_inicio);
        $fecha_final = Carbon::parse($request->fecha_final)->addDay();

        $estudios = Recepcions::whereBetween('created_at', [$fecha_inicio, $fecha_final])->get();
        
        return $estudios;
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

    public function paciente_guardar(Request $request){
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

        $request->validate(['nombre' => 'required',
                            'ap_paterno' => 'required', 'ap_materno' => 'required',
                            'domicilio' => 'nullable', 'colonia' => 'nullable',
                            'sexo' => 'required', 'fecha_nacimiento' => 'required',
                            'celular' => 'nullable', 'email' => 'nullable',
                            'id_empresa' => 'required', 'seguro_popular' => 'nullable',
                            'vigencia_inicio' => 'nullable', 'vigencia_fin' => 'nullable',
                            'usuario' => 'unique:pacientes',
                            'password' => 'unique:pacientes']);

                           
        $recep = new Pacientes;

        $recep->nombre = $request->nombre;
        $recep->ap_paterno = $request->ap_paterno;
        $recep->ap_materno = $request->ap_materno;
        $recep->domicilio = $request->domicilio;
        $recep->colonia = $request->colonia;
        $recep->sexo = $request->sexo;
        $recep->fecha_nacimiento = $request->fecha_nacimiento;
        $recep->celular = $request->celular;
        $recep->email = $request->email;
        $recep->id_empresa = $request->id_empresa;
        $recep->seguro_popular = $request->seguro_popular;
        $recep->vigencia_inicio = $request->vigencia_inicio;
        $recep->vigencia_fin = $request->vigencia_fin;
        $recep->usuario = $request->usuario;
        $recep->password = $request->password;   
        

        $laboratorio->pacientes()->save($recep);
        return back();
    }

    public function doctores_guardar(Request $request){
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();
  
        $request->validate(['clave' => 'required | unique:doctores',
                             'nombre' => 'required', 'ap_paterno' => 'required',
                             'ap_materno' => 'required', 'telefono' => 'unique:doctores',
                             'celular' => 'unique:doctores', 'email',
                             'usuario' => 'required | unique:doctores',
                             'password' => 'required | unique:doctores' 
                             ]);
  
        $recep = new  Doctores;
        $recep->clave = $request->clave;
        $recep->nombre = $request->nombre;
        $recep->ap_paterno = $request->ap_paterno;
        $recep->ap_materno = $request->ap_materno;
        $recep->telefono = $request->telefono;
        $recep->celular = $request->celular;
        $recep->email = $request->email;
        $recep->usuario = $request->usuario;
        $recep->password = $request->password;
  
        //$recep->save();
        $laboratorio->doctores()->save($recep);
        return back();
              
     }

}
