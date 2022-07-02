@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />

<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />

@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Analitos</li>
        
    </ol>
</nav>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <!-- Button trigger modal -->
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAnalito">
            Añadir analito
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Selecciona estudio</h4>
                <div class="mb-3">
                    <select id="selectEstudio" class="js-example-basic-multiple form-select" data-width="100%">
                    </select>
                </div>
                <div id='setAnalito' class="mb-3" style="display: none;">
                    <h4 class="card-title">Añade analito</h4>
                    <select id='selectAnalito' class="js-example-basic-multiple form-select" data-width="100%">
                    </select>
                </div>
                <div class="mb-5">
                    <h4 class="card-title">Estudios de perfil</h4>
                    <div class="table-responsive">
                        <table id="dataTablePerfiles" class="table">
                            <thead>
                                <tr>
                                    <th>Clave</th>
                                    <th>Descripcion</th>
                                    <th>Tipo</th>
                                    <th>Orden</th>
                                    <th>Imprimir</th>
                                </tr>
                            </thead>
                            <tbody id='values'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-md-block col-md-12 col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabla de analitos</h4>
                <div class="table-responsive">
                    <table id="dataTableAnalitos" class="table">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Descripcion</th>
                                <th>Tipo resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($analitos as $analito)
                            <tr>
                                <td>{{$analito->clave}}</td>
                                <td>{{$analito->descripcion}}</td>
                                <td>{{$analito->tipo_resultado}}</td>
                                
                            </tr>
                            @empty
                            <tr>
                                <td>
                                    No data allowed
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAnalito" data-bs-backdrop="static" tabindex="-1" aria-labelledby="mostrarModalAnalito" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear analito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id='regisAnalito' class="form-sample" action="{{ route('catalogo.store-analito') }}" method="POST">
                    {{-- action="{{ route('catalogo.store-analito') }}" method="POST" --}}
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Clave</label>
                                <input type="text" name='clave' class="form-control {{ $errors->has('clave') ? 'is-invalid' : '' }}" placeholder="Clave">
                                <x-jet-input-error for="clave"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-9">
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <input type="text" name="descripcion" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" placeholder="Descripción">
                                <x-jet-input-error for="descripcion"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Bitacora</label>
                                <input type="text" name="bitacora" class="form-control {{ $errors->has('bitacora') ? 'is-invalid' : '' }}" placeholder="Bitacora">
                                <x-jet-input-error for="bitacora"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-9">
                            <div class="mb-3">
                                <label class="form-label">Resultado por defecto</label>
                                <input type="text" name="defecto" class="form-control {{ $errors->has('defecto') ? 'is-invalid' : '' }}" placeholder="Resultado">
                                <x-jet-input-error for="defecto"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Unidad</label>
                                <input type="text" name="unidad" class="form-control {{ $errors->has('unidad') ? 'is-invalid' : '' }}" placeholder="Unidad">
                                <x-jet-input-error for="unidad"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Dígitos</label>
                                <input type="number" name="digito" min='0' class="form-control {{ $errors->has('digito') ? 'is-invalid' : '' }}" placeholder="Digitos">
                                <x-jet-input-error for="digito"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Tipo resultado</label>
                                <select id='tipo_resultado' onchange="displayValues()" name="tipo_resultado" class="js-example-basic-single form-select" data-width="100%">
                                    <option selected disabled>Seleccione</option>
                                    <option value="subtitulo">Subtitulo</option>
                                    <option value="texto">Texto</option>
                                    <option value="numerico">Númerico</option>
                                    <option value="documento">Documento</option>
                                    <option value="referencia">Valor referenciado</option>
                                    <option value="imagen">Imagen</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row" id="showReferencia" style="display: none;">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Referencia</label>
                                <input type="text" name="valor_referencia" class="form-control" placeholder="Referencia">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="showEstado" style="display: none;">
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" value="abierto" name='tipo_referencia' id="tipo_referencia1">
                                    <label name='tipo_referencia'class="form-check-label" for="radioInline">
                                        Abierto
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" value="restringido" name='tipo_referencia' id="tipo_Referencia2">
                                    <label class="form-check-label" for="radioInline1">
                                        Restringido
                                    </label>
                                </div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row" id="showTipoValidacion" style="display: none;">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Tipo validación</label>
                                <input type="text" name="tipo_validacion" class="form-control" placeholder="Tipo validación">
                            </div>
                        </div>
                    </div>
                    <div class="row" id='showNumerico' style="display: none;">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Número 1</label>
                                    <input type="number" name="numero_uno" min='0' class="form-control" placeholder="Número 1">
                                </div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label">Número 2</label>
                                <input type="number" name="numero_dos" min='0' class="form-control" placeholder="Número 2">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="showDocumento" style="display: none;">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Documento</label>
                                <input type="text" name="documento" class="form-control" placeholder="Documento">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary submit">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary">Guardar analito</button> --}}
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> --}}
            </div>
        </div>
    </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="modalReferencia" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalReferenciaLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReferenciaLabel">Valor referenciado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="referenciaAnalito" class="form-sample">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Edad inicial</label>
                                <input name='edad_inicial' type="number" class="form-control" placeholder="Edad inicial">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select name='tipo_inicial' class='js-example-basic-single form-select'id="">
                                    <option selected disabled>Seleccione</option>

                                    <option value="año">Año</option>
                                    <option value="mes">Mes</option>
                                    <option value="dia">Dias</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Edad final</label>
                                <input name='edad_final' type="number" class="form-control" placeholder="Edad final">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select name="tipo_final" class='js-example-basic-single form-select'id="">
                                    <option selected disabled>Seleccione</option>
                                    <option value="año">Año</option>
                                    <option value="mes">Mes</option>
                                    <option value="dia">Dias</option>
                                </select>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-4">
                                <div class="form-check form-check-inline">
                                    <input  type="radio" class="form-check-input" name='sexo' value='masculino' id="sexo1">
                                    <label class="form-check-label" for="radioInline">
                                        Masculino
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="sexo" value="femenino" id="sexo2">
                                    <label class="form-check-label" for="radioInline1">
                                        Femenino
                                    </label>
                                </div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="mb-3">
                                <label class="form-label">Referencia inicial</label>
                                <input name='referencia_inicial' type="number" class="form-control" placeholder="Referencia inicial">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-5">
                            <div class="mb-3">
                                <label class="form-label">Referencia final</label>
                                <input name="referencia_final" type="number" class="form-control" placeholder="Referencia final">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
                <div class="table-responsive">
                    <table id="dataTableAreas" class="table">
                        <thead>
                            <tr>
                                <th>Edad inicial</th>
                                <th>Tipo</th>
                                <th>Edad final</th>
                                <th>Tipo</th>
                                <th>Sexo</th>
                                <th>Ref. inicial</th>
                                <th>Ref. final</th>
                                <th>Dias ini</th>
                                <th>Dias fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="valoresReferencias">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('public/assets/js/axios.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('public/stevlab/catalogo/analitos/select2.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/analitos/dropzone.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/analitos/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/analitos/functions.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/analitos/form-validation.js') }}"></script>

@endpush
