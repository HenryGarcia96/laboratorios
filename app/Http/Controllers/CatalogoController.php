<?php

namespace App\Http\Controllers;

use App\Models\Analito;
use App\Models\Area;
use App\Models\Equipo;
use App\Models\Estudio;
use App\Models\Metodo;
use App\Models\Muestra;
use App\Models\Recipiente;
use App\Models\Referencia;
use App\Models\Tecnica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
    // Getters
    public function get_estudios(Request $request){
        $search = $request->except('_token');
        // Trae listas de estudios
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->estudios()->where('descripcion', 'LIKE', "%{$search['q']}%")->get();

        return $estudios;
    }

    public function get_analitos(Request $request){
        $search = $request->except('_token');

        // $analitos = Analito::where()
        $analitos = User::where('id', Auth::user()->id)->first()->labs()->first()->analitos()->where('descripcion', 'LIKE', "%{$search['q']}%")->get();

        return $analitos;

    }

    public function set_analito(Request $request){
        $search = $request->except('_token');
        $analito = User::where('id', Auth::user()->id)->first()->labs()->first()->analitos()->where('analito_id', $search['data'])->first();
        return $analito;
    }

    //ESTUDIOS
    public function catalogo_estudio_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        // Trae listas de estudios
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->estudios()->get();

        // Recogida de datos para el formulario
        // Trae areas creadas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
        // Trae muestas creadas
        $muestras = User::where('id', Auth::user()->id)->first()->labs()->first()->muestras()->get();
        // Trae recipientes creadas
        $recipientes = User::where('id', Auth::user()->id)->first()->labs()->first()->recipientes()->get();
        // Trae metodos creadas
        $metodos = User::where('id', Auth::user()->id)->first()->labs()->first()->metodos()->get();
        // Trae equipos creadas
        $equipos = User::where('id', Auth::user()->id)->first()->labs()->first()->equipos()->get();
         // Trae tecnicas creadas
        $tecnicas = User::where('id', Auth::user()->id)->first()->labs()->first()->tecnicas()->get();

        return view('catalogo.estudios.index', ['active'        => $active, 
                                                'sucursales'    => $sucursales, 
                                                'estudios'      => $estudios,
                                                'areas'         =>$areas,
                                                'muestras'      =>$muestras,
                                                'recipientes'   =>$recipientes,
                                                'metodos'       =>$metodos,
                                                'equipos'       =>$equipos,
                                                'tecnicas'      =>$tecnicas,
                                            ]);
    }

    public function catalogo_estudio_store(Request $request){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();
        //Verificar sucursal
        $sucursal = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();

        // Para validar datos de estudio
        $estudios = request()->validate([
            'clave'             => 'required',
            'codigo'            => 'required',
            'descripcion'       => 'required',
            'area'              => 'required',
            'muestra'           => 'required',
            'recipiente'        => 'required',
            'metodo'            => 'required',
            'tecnica'           => 'required',
            'condiciones'       => 'required',
            'aplicaciones'      => 'required',
            'dias_proceso'      => 'required',
        ],[
            'clave.required'        => 'Ingresa clave',
            'codigo.required'       => 'Ingresa código',
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'area.required'         => 'Selecciona tipo área',
            'muestra.required'      => 'Selecciona tipo muestra',
            'recipiente.required'   => 'Selecciona tipo recipiente',
            'metodo.required'       => 'Selecciona tipo método',
            'tecnica.required'      => 'Selecciona tipo tecnica',
            'condiciones.required'  => 'Ingresa condiciones del paciente',
            'aplicaciones.required' => 'Ingresa aplicaciones',
            'dias_proceso.required' => 'Ingresa días',
        ]);

        $estudio = Estudio::create($estudios);
        $estudy = Estudio::latest('id')->first();

        // Crea relación entre usuarios + laboratorios + sucursales
        $laboratorio->estdy()->attach($estudy->id, ['sucursal_id'   => $sucursal->id,
                                                    'area_id'       => $estudios['area'], 
                                                    'muestra_id'    => $estudios['muestra'], 
                                                    'recipiente_id' => $estudios['recipiente'], 
                                                    'metodo_id'     => $estudios['metodo'], 
                                                    'tecnica_id'    => $estudios['tecnica'],
                                                ]);

        return redirect()->route('catalogo.estudios');
    }


    // Catalogo analitos
    public function catalogo_analito_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        // Analitos
        $analitos = User::where('id', Auth::user()->id)->first()->labs()->first()->analitos()->get();

        return view('catalogo.analitos.index',['active' => $active, 'sucursales'=> $sucursales, 'analitos' => $analitos]);
    }

    public function catalogo_analito_store(Request $request){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();
        
        // Para validar datos de areas
        // $analitos = request()->validate([
        //     'clave'                 => 'required',
        //     'descripcion'           => 'required',
        //     'bitacora'              => 'required',
        //     'defecto'               => 'required',
        //     'unidad'                => 'required',
        //     'digito'                => 'required',
        // ],[
        //     'clave.required'        => 'Ingresa clave.',
        //     'descripcion.required'  => 'Ingresa descripción.',
        //     'bitacora.required'     => 'Ingresa bitacora.',
        //     'defecto.required'      => 'Ingresa valor por defecto.',
        //     'unidad.required'       => 'Ingresa unidad.',
        //     'digito.required'       => 'Ingresa digitos.',
        // ]);

        // Para obtener todos los datos
        $real = $request->except('_token');
        $analito = Analito::create($real);
        $laboratorio->analitos()->save($analito);

        // session()->flash('analito','Analito guardado.');
        return $analito;
    }

    public function catalogo_referencia_store(Request $request){
        $estudio = Analito::where('id', $request->analito)->first();

        $data = Referencia::create($request->except('_token'));

        $estudio->referencias()->save($data);

        return $data;
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
        // Trae metodos creadas
        $metodos = User::where('id', Auth::user()->id)->first()->labs()->first()->metodos()->get();
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();


        return view('catalogo.metodos.index',['active'=>$active,'sucursales'=>$sucursales, 'metodos'=>$metodos]);
    }

    public function catalogo_metodo_store(){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();
        // Para validar datos de metodos
        $metodos = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $metodo = Metodo::create($metodos);
        $laboratorio->metodos()->save($metodo);
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
        $muestras = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $muestra = Muestra::create($muestras);

        $laboratorio->muestras()->save($muestra);

        return redirect()->route('catalogo.muestras');
    }


    public function catalogo_tecnica_index(){
        // Trae tecnicas creadas
        $tecnicas = User::where('id', Auth::user()->id)->first()->labs()->first()->tecnicas()->get();

        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        
        return view('catalogo.tecnicas.index', ['active'=>$active, 'sucursales'=>$sucursales, 'tecnicas'=>$tecnicas]);
    }

    public function catalogo_tecnica_store(){
        
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        // Para validar datos de metodos
        $tecnicas = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $tecnica = Tecnica::create($tecnicas);
        $laboratorio->tecnicas()->save($tecnica);

        return redirect()->route('catalogo.tecnicas');
    }


    public function catalogo_equipo_index(){
        // Trae equipos creadas
        $equipos = User::where('id', Auth::user()->id)->first()->labs()->first()->equipos()->get();

        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        return view('catalogo.equipos.index', ['active'=>$active, 'sucursales' => $sucursales, 'equipos'=>$equipos]);
    }

    public function catalogo_equipo_store(){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        // Para validar datos de metodos
        $equipos = request()->validate([
            'descripcion'           => 'required',
            'observaciones'         => 'required',
        ],[
            'descripcion.required'  => 'Ingresa alguna descripcion',
            'observaciones.required'=> 'Ingresa alguna observación',
        ]);

        $equipo = Equipo::create($equipos);
        $laboratorio->equipos()->save($equipo);
        return redirect()->route('catalogo.equipos');
    }


}