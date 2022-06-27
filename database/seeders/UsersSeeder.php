<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use App\Models\Subsidiary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Crea usuario
        User::create([
            'name' => "Pixel Art",
            'email' => "admin@gmail.com",
            'password' => bcrypt('contraseña')
        ]);

        // Crea laboratorio
        Laboratory::create([
            'nombre'        =>'docbook',
            'razon_social'  =>'LABORATORIOS DE MEXICO SA DE CV',
            'ciudad'        =>'Tamulte',
            'estado'        =>'Tabasco',
            'pais'          =>'Mexico',
            'cp'            => '86280',
            'email'         =>'docbook@gmail.com',
            'telefono'      =>'3141596',
            'rfc'           =>'GAOH961225390',
        ]);

        // Crea sucursal
        Subsidiary::create([
            'sucursal'=>'docbook - Matriz',
        ]);

        //Crea relación entre sucursales y laboratorios 
        DB::table('subsidiaries_has_laboratories')
            ->insert([
                'laboratorio_id'    => '1',
                'sucursal_id'       => '1',
            ]);

        // Crea relación entre usuarios, sucursales y el laboratorio.
        DB::table('users_has_laboratories')
            ->insert([
                'usuario_id'        =>'1',
                'laboratorio_id'    =>'1',
                'sucursal_id'       =>'1',
                'estatus'           =>'activa'

            ]);
        
        // Otra sucursal para el mismo usuario
        // Crea sucursal
        Subsidiary::create([
            'sucursal'=>'docbook - Centro',
        ]);

        //Crea relación entre sucursales y laboratorios 
        DB::table('subsidiaries_has_laboratories')
            ->insert([
                'laboratorio_id'    => '1',
                'sucursal_id'       => '2',
            ]);

        // Crea relación entre usuarios, sucursales y el laboratorio.
        DB::table('users_has_laboratories')
            ->insert([
                'usuario_id'        =>'1',
                'laboratorio_id'    =>'1',
                'sucursal_id'       =>'2',
                'estatus'           =>'inactiva'
            ]);
    }
}
