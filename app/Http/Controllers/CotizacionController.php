<?php

namespace App\Http\Controllers;

use App\Models\Empresas;
use App\Models\Estudio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PDF; 





class CotizacionController extends Controller
{
    public function cotizacion_index(Request $request){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();

        $listas = User::where('id', Auth::user()->id)->first()->labs()->first()->recepcions()->get();


        $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();
        $estudios = User::where('id', Auth::user()->id)->first()->labs()->first()->estudios()->get();



        return view('recepcion.cotizacion.index',
        ['active'=>$active,'sucursales'=>$sucursales, 'empresas' => $empresas, 'estudios' => $estudios]);


}

public function prue_pdf(Request $request){
    $empresas = User::where('id', Auth::user()->id)->first()->labs()->first()->empresas()->get();
    
$recep = new Empresas;
$recep -> nombre = $request->nombre;
$recep -> observaciones = $request->observaciones;
$recep -> listEmpresas = $request->listEmpresas;
$recep -> listEstudio = $request->listEstudio;


//return view('recepcion.cotizacion.pdf',$recep);
return $recep;

}

}























  /*



$dompdf = new Dompdf();
$html = '<h1>Hola</h1>';



  

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream("mypdf.pdf", [ "Attachment" => true]);

    $estudios = $request->only('lista');
    $data = $request->only('data');
    $laboratorio = User::Where('id', Auth::user()->id)->first()->labs()->first();

    $estudios = [];

    foreach ($estudios as $key => $value) {
        foreach($value as $id => $valor){
            $estudio =  Estudio::where('clave', $valor)->first();
            // Aqui solo estas sobreescribiendo el resultado, en el resultado solo te dara al ultimo estudio en la lista
        }
        dd($estudios);
        # code...
       // Recepcions has estudios

    }

    // recepcion has estudios
    // Que pedo con esto? ya no lo ocupas
    if($laboratorio) {
        $response = true;
    } else {
        $response = false;
    }

// Porque asi? por eso la vista esta toda culeibuenii dimer como es porfavor
    $data = [
        'nombre' => $request->nombre,
        'data'  => date('d/m/y'),
        'empresa' => $request->id_empresa,
        'observaciones' => $request->observaciones,
        'listEstudio' => $request->listEstudio //aqui estas llamando a la nada, porque estoy casi seguro que request no tiene listestudio
    
    ];
    // Compadre, hagase la suicidacion
    $pdf = PDF::loadView('recepcion.cotizacion.pdf', $data);
    
    return $pdf->stream();
    
    //return view('recepcion.cotizacion.prueba', $data); 
*/