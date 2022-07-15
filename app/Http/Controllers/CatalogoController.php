<?php

namespace App\Http\Controllers;

use App\Models\Analito;
use App\Models\Area;
use App\Models\Equipo;
use App\Models\Estudio;
use App\Models\Metodo;
use App\Models\Muestra;
use App\Models\Precio;
use App\Models\Recipiente;
use App\Models\Referencia;
use App\Models\Tecnica;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatalogoController extends Controller
{
    // Getters
    public function get_estudios(Request $request){
        $search = $request->except('_token');
        // Trae listas de estudios
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->estudios()->where('descripcion', 'LIKE', "%{$search['q']}%")->get();

        return $estudios;
    }

    public function get_check_analitos(Request $request){ 
        $id = $request->except('_token');

        $estudios = Estudio::where('id', $id)->first()->analitos()->orderBy('orden', 'asc')->get();
        // $estudio;
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
        // $equipos = User::where('id', Auth::user()->id)->first()->labs()->first()->equipos()->get();
         // Trae tecnicas creadas
        $tecnicas = User::where('id', Auth::user()->id)->first()->labs()->first()->tecnicas()->get();

        return view('catalogo.estudios.index', ['active'        => $active, 
                                                'sucursales'    => $sucursales, 
                                                'estudios'      => $estudios,
                                                'areas'         =>$areas,
                                                'muestras'      =>$muestras,
                                                'recipientes'   =>$recipientes,
                                                'metodos'       =>$metodos,
                                                // 'equipos'       =>$equipos,
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

    public function catalogo_verify_key(Request $request){
        $analito = Analito::where('clave', $request->clave)->first();

        if($analito) {
            $response = false;
        } else {
            $response = true;
        }
    
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
    }


// Elimina analito del estudio
    public function delete_analito_estudio(Request $request){
        $clave = $request->only('data');
        $estudio = $request->only('estudio');

        $analito = Analito::where('clave', '=' ,$clave)->first();
        
        $delete = DB::table('analitos_has_estudios')
                        ->where('analito_id', '=', $analito->id)
                        ->where('estudio_id', '=', $estudio['estudio'])
                        ->delete();

        if($delete) {
            $response = true;
        } else {
            $response = false;
        }

        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
    }

    // Asigna analito al estudio
    public function asign_estudio_analitos(Request $request){
        $analito = [];
        $numero = 0;

        $datos = $request->except('_token');
        $data = $request->only('data');
        $estudio = $request->only('estudio');
        foreach ($data['data'] as $key=>$value) {
            $analito_id = Analito::where('clave', $value)->first();

            $numero++;
            $analito[$key]['analito_id'] = $analito_id->id;
            $analito[$key]['estudio_id'] = $estudio['estudio'];
            $analito[$key]['orden']      = $numero;

            $insercion = DB::table('analitos_has_estudios')
                        ->updateOrInsert([  'analito_id' => $analito[$key]['analito_id'], 
                                            'estudio_id' => $analito[$key]['estudio_id']],

                                        [   'analito_id' => $analito[$key]['analito_id'],
                                            'estudio_id' => $analito[$key]['estudio_id'],
                                            'orden'      => $numero]  );
        }
        
        if($numero > 0 ) {
            $response = true;
        } else {
            $response = false;
        }

        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
    }

    public function catalogo_analito_store(Request $request){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();
        
        // Para obtener todos los datos
        $real = $request->except('_token');
        $analito = Analito::create($real);
        $laboratorio->analitos()->save($analito);

        return $analito;
    }

    public function catalogo_store_imagen_referencia(Request $request){
        // $analito = request()->validate([
        //     'imagen' =>'required| image | mimes:jpg,bmp,png | max:1'
        // ],[
        //     'imagen' => 'Formato de imagen incorrecto'
        // ]);
        // $request->validate([
        //     'file'=>'required|image'
        // ]);
        $analito = request()->except('_token');
        $id = intval($analito['analito']);

        if($request->hasFile('imagen')){
            if(Storage::exists($analito['imagen'])){
                Storage::delete($analito['imagen']);
            }

            $request->file('imagen')->storeAs('public', 'analitos/analito-' . $id .'.png');
            $analito['imagen'] = 'analitos/analito-'. $id.'.png';
        }

        $insert = Analito::where('id', $id)->updateOrInsert(
                                                        ['id' => $id],
                                                        ['imagen'=>$analito['imagen']]
                                                    );
        return redirect()->route('catalogo.analitos');

        
    }

    public function catalogo_referencia_store(Request $request){
        $estudio = Analito::where('id', $request->analito)->first();

        $data = $request->except('_token');

        if($data['tipo_inicial'] == 'dia'){
            $data['dias_inicio'] = intval($data['edad_inicial']) * 1;
        }else if($data['tipo_inicial'] == 'mes'){
            $data['dias_inicio'] = intval($data['edad_inicial']) * 30;
        }else if($data['tipo_inicial'] == 'año'){
            $data['dias_inicio'] = intval($data['edad_inicial']) * 365;
        }

        if($data['tipo_final'] == 'dia'){
            $data['dias_final'] = intval($data['edad_final']) * 1;
        }else if($data['tipo_final'] == 'mes'){
            $data['dias_final'] = intval($data['edad_final']) * 30;
        }else if($data['tipo_final'] == 'año'){
            $data['dias_final'] = intval($data['edad_final']) * 365;
        }

        $dato = Referencia::create($data);

        $estudio->referencias()->save($dato);

        return $dato;
    }

    // Delete referencia
    public function catalogo_referencia_delete(Request $request){
        $analito = Analito::where('id', $request->analito)->first();

        $dato = $request->except('_token');

        $delete = DB::table('referencias_has_analitos')->where('analito_id', $dato['analito'])->where('referencia_id', $dato['referencia'])->delete();

        $borra = Referencia::where('id', $dato['referencia'])->delete();

        if($delete) {
            $response = true;
        } else {
            $response = false;
        }

        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
    }

    // AREAS
    public function catalogo_area_index(){
        // Trae areas creadas
        $areas = User::where('id', Auth::user()->id)->first()->labs()->first()->areas()->get();
        // Trae metodos creadas
        $metodos = User::where('id', Auth::user()->id)->first()->labs()->first()->metodos()->get();
        // Trae recipientes creadas
        $recipientes = User::where('id', Auth::user()->id)->first()->labs()->first()->recipientes()->get();
        // Trae areas creadas
        $muestras = User::where('id', Auth::user()->id)->first()->labs()->first()->muestras()->get();
        // Trae tecnicas creadas
        $tecnicas = User::where('id', Auth::user()->id)->first()->labs()->first()->tecnicas()->get();

        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        return view('catalogo.areas.index', ['active' => $active, 
                                            'sucursales' => $sucursales, 
                                            'areas' =>$areas, 
                                            'metodos'=>$metodos, 
                                            'recipientes'=> $recipientes,
                                            'muestras'=>$muestras,
                                            'tecnicas'=>$tecnicas]);
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
        return redirect()->route('catalogo.areas');
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

        return redirect()->route('catalogo.areas');
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



    public function catalogo_precio_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        // Lista de precios disponibles
        $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->precios()->get();

        // Lista de estudios disponibles
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->estudios()->get();

        return view('catalogo.precios.index', ['active' => $active, 
                                                'sucursales' => $sucursales, 
                                                'listas' => $listas,
                                                'estudios' => $estudios]);
    }

    public function catalogo_store_list(Request $request){
        // Verificar laboratorio asignado
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();

        $listas = $request->except('_token');

        $lista = Precio::create($listas); 
        $laboratorio->precios()->save($lista);

        if($lista ) {
            $response = true;
        } else {
            $response = false;
        }

        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($response);
    }

}