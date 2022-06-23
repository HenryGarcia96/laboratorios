<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
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
        // Trae las cajas que haya aperturado el usuario
        $cajas = User::where('id', Auth::user()->id)->first()->caja()->get();

        echo view('caja.index', ['cajas' => $cajas]);
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
        
        return redirect()->route('dashboard');
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
