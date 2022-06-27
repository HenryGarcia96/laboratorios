<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function dashboard(){
        //Verificar sucursal
        $active = User::where('id', Auth::user()->id)->first()->sucs()->where('estatus', 'activa')->first();
        // Lista de sucursales que tiene el usuario
        $sucursales = User::where('id', Auth::user()->id)->first()->sucs()->orderBy('id', 'asc')->get();
        // Verificar y contar caja del usuario
        $caja = User::where('id', Auth::user()->id)->first()->caja()->where('estatus', 'abierta')->first();
        
        if(isset($caja)){

            // Verifica tiempo de caja
            $fecha_inicial = $caja->created_at;
            $fecha_final = $fecha_inicial->diffInDays(Carbon::now());

            // Notifico si paso de 24 horas
            if($fecha_final == 0){
                
                session()->flash('status', 'Caja activa, recuerde que se cierra cada 24 horas, o cuando usted cierre manualmente la caja.');
            
            }elseif($fecha_final > 0 ){
                // Cierra caja
                $new_caja = Caja::where('id', $caja->id)->update(['estatus' => 'cerrada']);
                session()->flash('status', 'Caja cerrada automáticamente...');

            }

        }else{

            session()->flash('status','Debes aperturar caja antes de empezar a trabajar.' );

        }

        return view('dashboard', [
                            'active'=>$active, 
                            'sucursales' => $sucursales, 
                            'caja' => $caja,
                        ]);
    }
}
