<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Support\Facades\DB;
use App\Models\Empresas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
                    ['active'=>$active,'sucursales'=>$sucursales,
                    'empresas' => $empresas, 'listas' => $listas]);  
    }

    public function empresa_guardar(Request $request){
        $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

        $request->validate(['clave' => 'required | unique:empresas',
                            'descripcion' => 'required',
                            'calle', 'colonia',
                            'ciudad','telefono' => 'required',
                            'rfc','email',
                            'contacto' => 'required',
                            'descuento' => 'required | integer | max:100',
                            'usuario' => 'required | unique:empresas',
                            'password' => 'required | unique:empresas',
                            'imagen' => 'image|max:2048'
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
        $recep->descuento = $request->descuento;
        $recep->usuario = $request->usuario;
        $recep->password = $request->password;
        $imagen= $recep->imagen = $request->imagen->storeAs('public/empresas', $recep->descripcion.'.jpg');
        $img = Storage::url($imagen);


        //$recep->save();
        $laboratorio->empresas()->save($recep);
        return back();

    }

    public function get_empresa_edit(Request $request){
        $empresa = $request->except('_token');

        $empresas = Empresas::where('clave', $empresa)->first();
        return $empresas;
    }

    public function empresa_actualizar(Request $request){
        $request->validate(['id','clave',
                            'descripcion',
                            'calle' ,
                            'colonia',
                            'ciudad',
                            'telefono',
                            'rfc',
                            'email',
                            'contacto',
                            'descuento | integer | max:100',
                            'usuario',
                            'password'
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
                'descuento' => $request->list_precios,
                'usuario' => $request->usuario,
                'password' => $request->password]);

        return back(); 

    }

    public function empresa_eliminar($id){
        $id = Empresas::find($id);
        $id->delete();
        return back();
    }

    public function get_empresas(Request $request){
        $search = $request->except('_token');
        // Trae listas de estudios
        
        $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->where('clave', 'LIKE', "%{$search['q']}%")->get();

        return $empresas;
    }
}
