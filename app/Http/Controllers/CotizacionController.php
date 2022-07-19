<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF; 


class CotizacionController extends Controller
{
    public function cotizacion_index(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();


        $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();

        //$pacientes = User::where('id', Auth::user()->id)->first()->labs()->first()->pacientes()->get();
        //$doctores = User::where('id', Auth::user()->id)->first()->labs()->first()->doctores()->get();

        return view('recepcion.cotizacion.index',
        ['active'=>$active,'sucursales'=>$sucursales, 'empresas' => $empresas]);
}

public function prue_pdf(Request $request){


//$pdf->loadHTML('<h1>Test</h1>');

$data = [
    'nombre' => $request->nombre,
    'data'  => date('d/m/y'),
    'empresa' => $request->id_empresa,
    'observaciones' => $request->observaciones,
    'listEstudio' => $request->listEstudio
];
$pdf = PDF::loadView('recepcion.cotizacion.prueba', $data);

return $pdf->stream();

//return view('recepcion.cotizacion.prueba'); 
}
}
