<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        // Verificar y contar caja del usuario
        $caja = User::where('id', Auth::user()->id)->first()->caja()->where('estatus', 'abierta')->first();
        // Trae las cajas que haya aperturado y cerrado el usuario
        $cajas = User::where('id', Auth::user()->id)->first()->caja()->get();
        if(isset($caja)){

            // Verifica tiempo de caja
            $fecha_inicial = $caja->created_at;
            $fecha_final = $fecha_inicial->diffInDays(Carbon::now());

            // Notifico si paso de 24 horas
            if($fecha_final == 0){
                
                session()->flash('status', 'Caja activa, recuerde que se cierra cada 24 horas, o cuando usted cierre manualmente la caja.');
            
            }elseif($fecha_final > 0 ){
                
                $new_caja = Caja::where('id', $caja->id)->update(['estatus' => 'cerrada']);
                session()->flash('status', 'Caja cerrada automáticamente...');

            }

        }else{

            session()->flash('status','Debes aperturar caja antes de empezar a trabajar.' );

        }

        echo view('caja.index', [
                            'active'=>$active,
                            'sucursales' => $sucursales, 
                            'cajas' => $cajas, 
                        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monto = request()->validate([
            'monto'                    => 'required',
        ],[
            'monto.required'             => 'Ingresa la cantidad correcta para aperturar caja',
        ]);


        // Esto trae al usuario
        $usuario = User::where('id', Auth::user()->id)->first();
        // Trae la clinica en la que esta registrado el usuario
        $laboratorio = User::where('id', Auth::user()->id)->first()->labs()->first();
        // Trae la sucursal actual
        $sucursal = User::where('id', Auth::user()->id)->first()->sucs()->first();

        $caja = Caja::create([
                                'apertura'  => $monto['monto'],
                                'estatus'   => 'abierta',
                            ]);
                            
        $lastcaja = Caja::latest('id')->first();

        $lastcaja->laboratorios()->attach($laboratorio->id, 
                                        ['sucursal_id'=>$sucursal->id, 
                                        'usuario_id'=>$usuario->id]);
        
        return redirect()->route('caja.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
