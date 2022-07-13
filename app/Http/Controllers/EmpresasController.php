<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Support\Facades\DB;
use App\Models\Empresas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresasController extends Controller
{
    //
    public function empresa_index(){
                //Verificar sucursal
                $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
                // Lista de sucursales que tiene el usuario
                $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
                
                $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get(); 
            
                //datos traidos de la base de datos
                    $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();       

                    return view('catalogo.empresas.index',
                    ['active'=>$active,'sucursales'=>$sucursales]) ->with('empresas', $empresas);  
    }

    public function empresa_guardar(Request $request){
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

        $request->validate(['clave' => 'required | unique:empresas',
                            'descripcion' => 'required',
                            'calle' => 'required',
                            'colonia' => 'required',
                            'ciudad' => 'required',
                            'telefono' => 'required',
                            'rfc' => 'required | unique:empresas',
                            'email' => 'required',
                            'contacto' => 'required',
                            'list_precios' => 'required',
                            'usuario' => 'required | unique:empresas',
                            'password' => 'required | unique:empresas'
                        ]);
        
        $recep = new  Empresas;
        $recep->clave = $request->clave;
        $recep->descripcion = $request->descripcion;
        $recep->calle = $request->calle; 
        $recep->colonia = $request->colonia;
        $recep->ciudad = $request->ciudad;
        $recep->telefono = $request->telefono;
        $recep->rfc = $request->rfc;
        $recep->email = $request->email;
        $recep->contacto = $request->contacto;
        $recep->list_precios = $request->list_precios;
        $recep->usuario = $request->usuario;
        $recep->password = $request->password;

        //$recep->save();
        $laboratorio->empresas()->save($recep);
        return back()->with('success', 'Registro completo');
                       
    }

    public function get_empresa_edit(Request $request){
        $empresa = $request->except('_token');

        $empresas = Empresas::where('clave', $empresa)->first();
  
        return $empresas;
    }

    public function empresa_actualizar(Request $request){
        $request->validate(['id','clave' => 'required',
                            'descripcion' => 'required',
                            'calle' => 'required',
                            'colonia' => 'required',
                            'ciudad' => 'required',
                            'telefono' => 'required',
                            'rfc' => 'required',
                            'email' => 'required',
                            'contacto' => 'required',
                            'list_precios' => 'required',
                            'usuario' => 'required',
                            'password' => 'required'
                            ]);

        $recep = DB::table('empresas')
        ->where('id', $request->id)
        ->update(['clave'=> $request->clave,
                'descripcion' => $request->descripcion,
                'calle' => $request->calle,
                'colonia' => $request->colonia,
                'ciudad' => $request->ciudad,
                'telefono' => $request->telefono,
                'rfc' => $request->rfc,
                'email' => $request->email,
                'contacto' => $request->contacto,
                'list_precios' => $request->list_precios,
                'usuario' => $request->usuario,
                'password' => $request->password]);
  
        return back(); 

    }

    public function empresa_eliminar($id){
        $id = Empresas::find($id);
        $id->delete();
        return back();
    }
}
