<?php

namespace App\Http\Controllers;
use App\Models\Laboratory;
use Illuminate\Support\Facades\DB;
use App\Models\Pacientes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    //
    public function paciente_index(Request $request){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();
        
        $pacientes = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();

        $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();
    
        $a = rand(100000,999999);
        

        return view('catalogo.pacientes.index',
        ['active'=>$active,'sucursales'=>$sucursales,
         'listas' => $listas, 'pacientes'=> $pacientes,
        'empresas' => $empresas, 'a' => $a]); 
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
        return back()->with('success', 'Registro completo');
    }

    public function get_paciente_edit(Request $request){
        $paciente = $request->except('_token');

        $pacients = Pacientes::where('fecha_nacimiento', $paciente)->first();
  
        return $pacients;
    }

    public function paciente_actualizar(Request $request){
        $request->validate(['id','nombre' => 'required',
        'ap_paterno' => 'required', 'ap_materno' => 'required',
        'domicilio' => 'required', 'colonia' => 'required',
        'sexo' => 'required', 'fecha_nacimiento' => 'required',
        'celular', 'email',
        'id_empresa' => 'required', 'seguro_popular',
        'vigencia_inicio', 'vigencia_fin']);

        $recep = DB::table('pacientes')
        ->where('id', $request->id)
        ->update(['nombre'=> $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'domicilio' => $request->domicilio,
                'colonia' => $request->colonia,
                'sexo' => $request->sexo,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'celular' => $request->celular,
                'email' => $request->email,
                'id_empresa' => $request->id_empresa,
                'seguro_popular' => $request->seguro_popular,
                'vigencia_inicio' => $request->vigencia_inicio,
                'vigencia_fin' => $request->vigencia_fin]);
  
        return back();
    }

    public function paciente_eliminar($id){
        $id = Pacientes::find($id);
        $id->delete();
        return back();
    } 
}
