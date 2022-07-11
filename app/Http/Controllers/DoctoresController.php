<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Doctores; 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctoresController extends Controller
{
    //
    public function doctores_index(Request $request){ 
   //Verificar sucursal
      $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
   // Lista de sucursales que tiene el usuario
      $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get(); 

      $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->doctores()->get();

   //datos traidos de la base de datos
      $doctores = DB::table('doctores')
                  ->select('doctores.*')
                  ->orderBy('id','DESC')
                  ->get();
      
      return view('catalogo.doctores.index',
      ['active'=>$active,'sucursales'=>$sucursales]) ->with('doctores', $doctores);  
   }

   public function doctores_guardar(Request $request){
      $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

      $request->validate(['clave' => 'required | unique:doctores',
                           'nombre' => 'required', 'ap_paterno' => 'required',
                           'ap_materno' => 'required', 'telefono' => 'unique:doctores',
                           'celular' => 'unique:doctores', 'email' => 'required | unique:doctores',
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
      return back()->with('success', 'Registro completo');
            
   }

   public function get_doctor_edit(Request $request){
      $doctor = $request->except('_token');

      $doctors = Doctores::where('clave', $doctor)->first();

      return $doctors;
   }

   public function doctor_actualizar(Request $request){

      $request->validate(['id','clave' => 'required',
      'nombre' => 'required', 'ap_paterno' => 'required',
      'ap_materno' => 'required', 'telefono',
      'celular', 'email' => 'required',
      'usuario' => 'required',
      'password' => 'required' 
      ]);

      $recep = DB::table('doctores')
               ->where('id', $request->id)
               ->update(['clave'=> $request->clave,
                        'nombre' => $request->nombre,
                        'ap_paterno'=> $request->ap_paterno,
                        'ap_materno'=> $request->ap_materno,
                        'telefono'=> $request->telefono,
                        'celular'=> $request->celular,
                        'email'=> $request->email,
                        'usuario'=> $request->usuario,
                        'password'=> $request->password]);
         
               return back();
     

      //$recep = new Doctores;
      //$recep->clave = $request->clave;
      //$recep->nombre = $request->nombre;
      //$recep->ap_paterno = $request->ap_paterno;
      //$recep->ap_materno = $request->ap_materno;
      //$recep->telefono = $request->telefono;
      //$recep->celular = $request->celular;
      //$recep->email = $request->email;
      //$recep->usuario = $request->usuario;
      //$recep->password = $request->password;

      //$recep->save();
      //return back();

   }

   public function doctor_eliminar($id){
      $id = Doctores::find($id);
      $id->delete();
      return back();
   }

}
