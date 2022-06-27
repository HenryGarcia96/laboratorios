<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Equipo;
use App\Models\Estudio;
use App\Models\Metodo;
use App\Models\Muestra;
use App\Models\Recipiente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
    //ESTUDIOS
    public function catalogo_estudio_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        // Lista de estudios
        $estudios = Estudio::all();

        // Recogida de datos para el formulario
        // Trae areas creadas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
        // Trae muestas creadas
        $muestras = User::where('id', Auth::user()->id)->first()->labs()->first()->muestras()->get();
        // Trae recipientes creadas
        $recipientes = User::where('id', Auth::user()->id)->first()->labs()->first()->recipientes()->get();

        return view('catalogo.estudios.index', ['active' => $active, 
                                                'sucursales' => $sucursales, 
                                                'estudios' => $estudios,
                                                'areas'=>$areas,
                                                'muestras'=>$muestras,
                                                'recipientes'=>$recipientes,
                                            ]);
    }

    public function catalogo_estudio_store(Request $request){

        // Para validar datos de estudio
        $estudios = request()->validate([
            'clave'             => 'required',
            'codigo'            => 'required',
            'descripcion'       => 'required',
            'condiciones'       => 'required',
            'aplicaciones'      => 'required',
            'dias_proceso'      => 'required',
        ],[
            'clave.required'        => 'Ingresa clave',
            'codigo.required'       => 'Ingresa código',
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'condiciones.required'  => 'Ingresa condiciones del paciente',
            'aplicaciones.required' => 'Ingresa aplicaciones',
            'dias_proceso.required' => 'Ingresa días',
        ]);

        // Para validar demás datos enlazados
        $data = request()->validate([
            'area'              => 'required',
            'muestra'           => 'required',
            'recipiente'        => 'required',
            'metodo'            => 'required',
            'tecnica'           => 'required',
            'equipo'            => 'required',
        ],[
            'area.required'         => 'Selecciona tipo área',
            'muestra.required'      => 'Selecciona tipo muestra',
            'recipiente.required'   => 'Selecciona tipo recipiente',
            'metodo.required'       => 'Selecciona tipo método',
            'tecnica.required'      => 'Selecciona tipo tecnica',
            'equipo.required'       => 'Selecciona tipo equipo',
        ]);

        $estudio = Estudio::create($estudios);

        return redirect()->route('catalogo.estudios');
    }


    // AREAS
    public function catalogo_area_index(){
        // Trae areas creadas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        return view('catalogo.areas.index', ['active' => $active, 'sucursales' => $sucursales, 'areas' =>$areas]);
    }

    public function catalogo_area_store(){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        // Para validar datos de areas
        $areas = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $area = Area::create($areas);

        $laboratorio->areas()->save($area);

        return redirect()->route('catalogo.areas');
    }


    // METODOS
    public function catalogo_metodo_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        // Trae  todos los metodos
        $metodos = Metodo::all();

        return view('catalogo.metodos.index',['active'=>$active,'sucursales'=>$sucursales, 'metodos'=>$metodos]);
    }

    public function catalogo_metodo_store(){
        // Para validar datos de metodos
        $metodos = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $metodo = Metodo::create($metodos);

        return redirect()->route('catalogo.metodos');
    }


    // RECIPIENTES
    public function catalogo_recipiente_index(){
        // Trae recipientes creadas
        $recipientes = User::where('id', Auth::user()->id)->first()->labs()->first()->recipientes()->get();
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        return view('catalogo.recipientes.index', ['active'=> $active, 'sucursales' => $sucursales, 'recipientes'=> $recipientes]);
    }

    public function catalogo_recipiente_store(){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        // Para validar datos de metodos
        $recipientes = request()->validate([
            'descripcion'           => 'required',
            'marca'                 => 'required',
            'capacidad'             => 'required',
            'presentacion'          => 'required',
            'unidad_medida'         => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'      => 'Ingresa alguna descripcion',
            'marca.required'            => 'Ingresa nombre de marca',
            'capacidad.required'        => 'Ingresa capacidad',
            'presentacion.required'     => 'Ingresa presentación',
            'unidad_medida.required'    => 'Ingresa unidad de medida',
            'observaciones.required'    => 'Ingresa observaciones',
        ]);

        $recipiente = Recipiente::create($recipientes);
        $laboratorio->recipientes()->save($recipiente);

        return redirect()->route('catalogo.recipientes');
    }


    public function catalogo_muestra_index(){
        // Trae areas creadas
        $muestras = User::where('id', Auth::user()->id)->first()->labs()->first()->muestras()->get();

        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        return view('catalogo.muestras.index', ['active'=>$active, 'sucursales'=>$sucursales, 'muestras'=>$muestras]);
    }

    public function catalogo_muestra_store(){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        // Para validar datos de metodos
        $muestra = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $muestras = Muestra::create($muestra);

        $laboratorio->muestras()->save($muestras);

        return redirect()->route('catalogo.muestras');
    }


    public function catalogo_equipo_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        // Recoger todos los equipos
        $equipos = Equipo::all();

        return view('catalogo.equipos.index', ['active'=>$active, 'sucursales' => $sucursales, 'equipos'=>$equipos]);
    }

    public function catalogo_equipo_store(){
        // Para validar datos de metodos
        $equipo = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $equipos = Equipo::create($equipo);

        return redirect()->route('catalogo.equipos');
    }


}