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
                                        <option>{{$area->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="area"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="muestra" class="form-label">Tipo muestra</label>
                                <select class="form-select {{ $errors->has('muestra') ? 'is-invalid' : '' }}" name="muestra">
                                    @forelse ($muestras as $muestra)
                                        <option>{{$muestra->descripcion}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-jet-input-error for="muestra"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="recipiente" class="form-label">Recipiente</label>
                                <select class="form-select {{ $errors->has('recipiente') ? 'is-invalid' : '' }}" name="recipiente">
                                    @forelse ($recipientes as $recipiente)
                                        <option> {{$recipiente->descripcion}}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                <x-jet-input-error for="recipiente"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="metodo" class="form-label">Método</label>
                                <select class="form-select {{ $errors->has('metodo') ? 'is-invalid' : '' }}" name="metodo">
                                    <option>Frasco de orina</option>
                                    <option>Tubo amarillo</option>
                                    <option>Tubo negro</option>
                                </select>
                                <x-jet-input-error for="metodo"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="tecnica" class="form-label">Técnica</label>
                                <select class="form-select {{ $errors->has('tecnica') ? 'is-invalid' : '' }}" name="tecnica">
                                    <option>Absorción atomica</option>
                                    <option>Aglutinación</option>
                                    <option>Bencidina</option>
                                    <option>Cinetico Uv</option>
                                </select>
                                <x-jet-input-error for="tecnica"></x-jet-input-error>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label for="equipo" class="form-label">Equipo</label>
                                <select class="form-select {{ $errors->has('equipo') ? 'is-invalid' : '' }}" name="equipo" >
                                    <option>COBAS</option>
                                    <option>INMUNO MAQUILA</option>
                                    <option>CLINEK</option>
                                </select>
                                <x-jet-input-error for="equipo"></x-jet-input-error>
                            </div>
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
    <div class="d-none d-md-block col-lg-6 grid-margin stretch-card">
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