@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Estudios</li>
        
    </ol>
</nav>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Estudios</h4>
                <form id="registro_estudios" action="{{route('catalogo.store-studio')}}" method="POST">
                    @csrf
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="clave" class="form-label">Clave</label>
                                <input type='text' class="form-control {{ $errors->has('clave') ? 'is-invalid' : '' }}" name="clave"  placeholder="Clave">
                                <x-jet-input-error for="clave"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" class="form-control {{ $errors->has('codigo') ? 'is-invalid' : '' }}" name="codigo"  placeholder="Código">
                                <x-jet-input-error for="codigo"></x-jet-input-error>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion</label>
                                <textarea class='form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}' name="descripcion" rows="3" placeholder="Descripción"></textarea>
                                <x-jet-input-error for="descripcion"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="area" class="form-label">Área</label>
                                <select class="form-select {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area">
                                    @forelse ($areas as $area)
                                        <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="area"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="muestra" class="form-label">Tipo muestra</label>
                                <select class="form-select {{ $errors->has('muestra') ? 'is-invalid' : '' }}" name="muestra">
                                    @forelse ($muestras as $muestra)
                                        <option value="{{$muestra->id}}">{{$muestra->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="muestra"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="recipiente" class="form-label">Recipiente</label>
                                <select class="form-select {{ $errors->has('recipiente') ? 'is-invalid' : '' }}" name="recipiente">
                                    @forelse ($recipientes as $recipiente)
                                        <option value="{{$recipiente->id}}"> {{$recipiente->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="recipiente"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="metodo" class="form-label">Método</label>
                                <select class="form-select {{ $errors->has('metodo') ? 'is-invalid' : '' }}" name="metodo">
                                    @forelse ($metodos as $metodo)
                                        <option value="{{$metodo->id}}"> {{$metodo->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="metodo"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="tecnica" class="form-label">Técnica</label>
                                <select class="form-select {{ $errors->has('tecnica') ? 'is-invalid' : '' }}" name="tecnica">
                                    @forelse ($tecnicas as $tecnica)
                                        <option value="{{$tecnica->id}}"> {{$tecnica->descripcion}}</option>
                                    @empty
                                    @endforelse
                                    
                                </select>
                                <x-jet-input-error for="tecnica"></x-jet-input-error>
                            </div>
                            {{-- <div class="mb-3 col-sm-6">
                                <label for="equipo" class="form-label">Equipo</label>
                                <select class="form-select {{ $errors->has('equipo') ? 'is-invalid' : '' }}" name="equipo" >
                                    @forelse ($equipos as $equipo)
                                        <option value="{{$equipo->id}}"> {{$equipo->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="equipo"></x-jet-input-error>
                            </div> --}}
                            <div class="mb-3 col-sm-12">
                                <label for="condiciones" class="form-label">Condiciones del paciente</label>
                                <textarea class='form-control {{ $errors->has('condiciones') ? 'is-invalid' : '' }}' name="condiciones" rows="3"placeholder='Condiciones'></textarea>
                                <x-jet-input-error for="condiciones"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <label for="aplicaciones" class="form-label">Aplicaciones</label>
                                <textarea class='form-control {{ $errors->has('aplicaciones') ? 'is-invalid' : '' }}' name="aplicaciones" rows="3"placeholder='Aplicaciones'></textarea>
                                <x-jet-input-error for="aplicaciones"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="dias_proceso" class="form-label">Días de proceso</label>
                                <input type="number" class="form-control {{ $errors->has('dias_proceso') ? 'is-invalid' : '' }}" name="dias_proceso" placeholder='Días de proceso'>
                                <x-jet-input-error for="dias_proceso"></x-jet-input-error>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Guardar">
                </form>
            </div>
        </div>
    </div>
    <div class="d-md-block col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabla de estudio</h4>
                <div class="table-responsive">
                    <table id="dataTableEstudios" class="table">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Cod</th>
                                <th>Descripcion</th>
                                <th>Condiciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($estudios as $estudio)
                                <tr>
                                    <td>{{$estudio->clave}}</td>
                                    <td>{{$estudio->codigo}}</td>
                                    <td>{{$estudio->descripcion}}</td>
                                    <td>{{$estudio->condiciones}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No data allowed</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.js') }}"></script>
@endpush

@push('custom-scripts')
{{-- <script src="{{ asset('public/stevlab/catalogo/estudios.js') }}"></script> --}}
<script src="{{ asset('public/stevlab/catalogo/estudios/data-table.js') }}"></script>

@endpush

{{-- 
<option value="41">Absorcion atomica</option>
<option value="96">Addis</option>
<option value="80">Aglutinacion</option>
<option value="1">Aglutinacion en placa</option>
<option value="49">Aglutinacion en tubo</option>
<option value="46">Analisis quimico</option>
<option value="21">Analisis quimico, Microscopia</option>
<option value="110">Analizador Coulter Act Diff</option>
<option value="112">Automatizada</option>
<option value="108">Automatizado Sysmex XS-1000i</option>
<option value="18">Barker</option>
<option value="17">Bencidina</option>
<option value="74">Campo obscuro</option>
<option value="61">Cinetica automatizada</option>
<option value="62">Cinetica colorimetrica</option>
<option value="35">Cinetico</option>
<option value="39">Cinetico UV</option>
<option value="92">Citometria de flujo</option>
<option value="87">Citotoxicidad</option>
<option value="105">Coagulometria</option>
<option value="45">Coagulometria (Coagulo de Rusell)</option>
<option value="9">Colorim., Cinet., Enzim., Micr.</option>
<option value="106">Colorim.,Cinet.,Enzim.,Micr.</option>
<option value="8">Colorimetria</option>
<option value="44">Colorimetrica automatizada</option>
<option value="33">Colorimetrico (BCG)</option>
<option value="37">Cromatografia bidimensional</option>
<option value="28">Cromatografia liquida</option>
<option value="4">Cuagulometria</option>
<option value="72">Cultivo de medios selectivos</option>
<option value="84">Cultivo en Lowestein con NaOH</option>
<option value="77">Degranulacion de basofilos</option>
<option value="31">Digestion de gel en placa</option>
<option value="93">Eia</option>
<option value="51">Electroforesis</option>
<option value="102">Electroforesis con Tincion de plata</option>
<option value="101">Electroforesis en acetato de celulosa</option>
<option value="24">Electroquimio-Luminiscencia</option>
<option value="22">Elisa</option>
<option value="40">Emit</option>
<option value="34">Enzimatica</option>
<option value="60">Enzimatico automatizado</option>
<option value="29">Enzimatico UV</option>
<option value="55">Enzimatico-Colorimetrico</option>
<option value="111">Equipo automatizado A15 Biosystems</option>
<option value="115">Espectrofotometria de reflectancia/Electrodo de ion selectivo</option>
<option value="113">Espectrofotometria de Reflectancia</option>
<option value="83">Faust</option>
<option value="95">Faust flotacion</option>
<option value="71">Fijacion de complemento</option>
<option value="103">Flamometria, Ion selectivo, Colorimetria</option>
<option value="5">Floculacion</option>
<option value="10">Fluorometria</option>
<option value="109">Fotoelectrico</option>
<option value="23">Fotometria</option>
<option value="30">Fpia</option>
<option value="97">Graham</option>
<option value="54">Gravimetria</option>
<option value="38">Gutherie</option>
<option value="100">Hamburguer</option>
<option value="68">Hemaglutinacion indirecta</option>
<option value="27">Hplc</option>
<option value="73">Hunner</option>
<option value="16">Indice</option>
<option value="2">Inhibicion en cianuro</option>
<option value="86">Inmuno Blot</option>
<option value="13">Inmuno fijacion</option>
<option value="70">Inmunodifusion</option>
<option value="42">Inmunodifusion radial</option>
<option value="90">Inmunoelectrotransferencia</option>
<option value="118">Inmunoensayo enzimatico (ELISA)</option>
<option value="78">Inmunoenzayo</option>
<option value="94">Inmunoenzimatica</option>
<option value="69">Inmunofluorescencia</option>
<option value="56">Intercambio ionico</option>
<option value="47">Intradermo-Reaccion</option>
<option value="57">Intradermoreaccion</option>
<option value="11">Ion selectivo</option>
<option value="52">Ionometria</option>
<option value="59">Jendrasik</option>
<option value="3">Lisis en tubo</option>
<option value="85">Medio Pplo</option>
<option value="53">Meia</option>
<option value="65">Metodo de claus</option>
<option value="64">Microscopia</option>
<option value="89">Nefelom. y T. de Mayer</option>
<option value="36">Nefelometria</option>
<option value="107">No asignado</option>
<option value="81">No. mas probable/Recuento en placa</option>
<option value="6">Osmometria</option>
<option value="98">Papel indicador</option>
<option value="75">Paul Bunnel</option>
<option value="12">Precipitacion</option>
<option value="58">Precipitacion con MgCI2</option>
<option value="48">Precipitacion selectiva colorimetrica</option>
<option value="114">Quimioluminiscencia</option>
<option value="25">Radioinmunoensayo</option>
<option value="91">Reaccion en cadena de polimerasa</option>
<option value="63">Recuento Electr./Microscopia</option>
<option value="79">Recuento electronico</option>
<option value="26">Ria</option>
<option value="76">Ria-Cinetica</option>
<option value="50">Rothera</option>
<option value="19">Serotipificacion</option>
<option value="66">Simpson y Mann</option>
<option value="88">Tecnica de Mayer</option>
<option value="82">Tincion Zhiel-Neelsen</option>
<option value="20">Tincion, Microscopia</option>
<option value="99">Tira reactiva/Microscopia</option>
<option value="7">Titrimetria</option>
<option value="117">Titulacion en placa</option>
<option value="104">Titulacion potenciometrica</option>
<option value="15">Topfer</option>
<option value="14">Turbidimetria</option>
<option value="116">Turbidimetria, Duke &amp; Ivy</option>
<option value="67">Wintrobe</option><option value="32">Varios</option> --}}