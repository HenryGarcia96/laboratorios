<?php

namespace App\Http\Controllers;

use App\Models\Recepcions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RecepcionsController extends Controller
{
    //
    public function index(Request $request){
    //Verificar sucursal
       $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
    // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get(); 

        return view('recepcion.index',['active'=>$active,'sucursales'=>$sucursales]);  
     }

    public function guardar(Request $request){
        $request->validate([
            'folio' => 'required | unique:recepcions',
            'numOrden' => 'required | unique:recepcions',
            'numRegistro' => 'required | unique:recepcions',
            'paciente' =>'required', 'empresa' =>'required',
            'servicio' =>'required', 'tipPasiente' =>'required',
            'turno' =>'required', 'medico' =>'required',
            'numCama' =>'required', 'peso' =>'required',
            'talla' =>'required', 'fur',
            'medicamento' =>'required', 'diagnostico' =>'required',
            'observaciones', 'listPrecio'
        ]);

        $recep = new Recepcions;
        $recep->folio = $request->folio;
        $recep->numOrden = $request->numOrden;
        $recep->numRegistro = $request->numRegistro;
        $recep->paciente = $request->paciente;
        $recep->empresa = $request->empresa;
        $recep->servicio = $request->servicio;
        $recep->tipPasiente = $request->tipPasiente;
        $recep->turno = $request->turno;
        $recep->medico = $request->medico;
        $recep->numCama = $request->numCama;
        $recep->peso = $request->peso;
        $recep->talla = $request->talla;
        $recep->fur = $request->fur;
        $recep->medicamento = $request->medicamento;
        $recep->diagnostico = $request->diagnostico;
        $recep->observaciones = $request->observaciones;
        $recep->listPrecio = $request->listPrecio;


        $recep->save();
        return back()->with('success', 'Registro completo');
     }
}
