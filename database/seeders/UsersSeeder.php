<?php

namespace Database\Seeders;

use App\Models\Analito;
use App\Models\Area;
use App\Models\Estudio;
use App\Models\Laboratory;
use App\Models\Metodo;
use App\Models\Muestra;
use App\Models\Recipiente;
use App\Models\Subsidiary;
use App\Models\Tecnica;
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
        
        // Data para los estudios

        Area::create([
            'descripcion'       =>'Hematología',
            'observaciones'     =>'Ninguna',
        ]);

        Metodo::create([
            'descripcion'       =>'Cromatología líquida de alta precisión',
            'observaciones'     =>'HPLC',
        ]);

        Recipiente::create([
            'descripcion'       =>'Tubo lila con LTA',
            'marca'             =>'Generico',
            'capacidad'         =>'4ml',
            'presentacion'      =>'generica',
            'unidad_medida'     =>'ml',
            'observaciones'     =>'ninguna',
        ]);

        Muestra::create([
            'descripcion'       =>'Sangre total',
            'observaciones'     =>'ST',
        ]);

        Tecnica::create([
            'descripcion'       =>'Muestreo multiple',
            'observaciones'     =>'ninguna',
        ]);

        DB::table('areas_has_laboratories')->insert([
            'laboratory_id'     =>'1',
            'area_id'           =>'1',
        ]);

        DB::table('metodos_has_laboratories')->insert([
            'laboratory_id'     =>'1',
            'metodo_id'         =>'1',
        ]);

        DB::table('recipientes_has_laboratories')->insert([
            'laboratory_id'     =>'1',
            'recipiente_id'     =>'1',

        ]);

        DB::table('muestras_has_laboratories')->insert([
            'laboratory_id'     =>'1',
            'muestra_id'        =>'1',
        ]);

        DB::table('tecnicas_has_laboratories')->insert([
            'laboratory_id'     =>'1',
            'tecnica_id'        =>'1',
        ]);
        

        // Crear estudio
        Estudio::create([
            'clave'             =>'DOC1',
            'codigo'            =>'8622',
            'descripcion'       =>'Hemoglobina Glucocilada',
            'condiciones'       =>'Ayuno entre 8-12 horas',
            'aplicaciones'      =>'Sospecha de diabetes',
            'dias_proceso'      => 2,
            'precio'            => 150,
        ]);

        DB::table('estudios_has_laboratories')->insert([
            'estudio_id'        =>'1',
            'laboratory_id'     =>'1',
            'sucursal_id'       =>'1',
            'area_id'           =>'1',
            'muestra_id'        =>'1',
            'recipiente_id'     =>'1',
            'metodo_id'         =>'1',
            'tecnica_id'        =>'1',
        ]);

        // Crear analito
        Analito::create([
            'clave'=>'AN01',
            'descripcion'=>'Hemoglobina glucocilada',
            'bitacora'=>'nd',
            'defecto'=>'1',
            'unidad'=>'%',
            'digito'=>'4',
            'tipo_resultado'=>'numerico',
            'valor_referencia'=>null,
            'tipo_referencia'=>null,
            'tipo_validacion'=>null,
            'numero_uno'=>'4',
            'numero_dos'=>'18',
            'documento'=>null,
        ]);

        Analito::create([
            'clave'=>'AN02',
            'descripcion'=>'Glucosa promedio',
            'bitacora'=>'nd',
            'defecto'=>'2',
            'unidad'=>'ml/dL',
            'digito'=>'4',
            'tipo_resultado'=>'numerico',
            'valor_referencia'=>null,
            'tipo_referencia'=>null,
            'tipo_validacion'=>null,
            'numero_uno'=>'70',
            'numero_dos'=>'110',
            'documento'=>null,
        ]);

        DB::table('analitos_has_laboratories')->insert([
            'analito_id'        =>'1',
            'laboratory_id'     =>'1',
        ]);

        DB::table('analitos_has_laboratories')->insert([
            'analito_id'        =>'2',
            'laboratory_id'     =>'1',
        ]);

        DB::table('analitos_has_estudios')->insert([
            'analito_id'=>'1',
            'estudio_id'=>'1',
            'orden'=>'1',
        ]);

        DB::table('analitos_has_estudios')->insert([
            'analito_id'=>'2',
            'estudio_id'=>'1',
            'orden'=>'2',
        ]);
    }
}
