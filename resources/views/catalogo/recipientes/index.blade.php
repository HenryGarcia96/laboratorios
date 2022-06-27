@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Recipientes</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Recipientes</h6>
                <form class="forms-sample" action="{{route('catalogo.store-recipiente')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Descripcion</label>
                                <input name='descripcion' type="text" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" placeholder="Descripción">
                                <x-jet-input-error for="descripcion"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Marca</label>
                                <input name='marca' type="text" class="form-control {{ $errors->has('marca') ? 'is-invalid' : '' }}" placeholder="Marca">
                                <x-jet-input-error for="marca"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Capacidad</label>
                                <input name='capacidad' type="text" class="form-control {{ $errors->has('capacidad') ? 'is-invalid' : '' }}" placeholder="Capacidad">
                                <x-jet-input-error for="capacidad"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Presentación</label>
                                <input name='presentacion' type="text" class="form-control {{ $errors->has('presentacion') ? 'is-invalid' : '' }}" placeholder="Presentación">
                                <x-jet-input-error for="presentacion"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Unidad medida</label>
                                <input name='unidad_medida' type="text" class="form-control {{ $errors->has('unidad_medida') ? 'is-invalid' : '' }}" placeholder="Unidad medida">
                                <x-jet-input-error for="unidad_medida"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Observaciones</label>
                                <textarea name="observaciones" class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" rows="3" placeholder="Observaciones"></textarea>
                            <x-jet-input-error for="observaciones"></x-jet-input-error>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary submit">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="d-none d-md-block col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabla de recipientes</h4>
                <div class="table-responsive">
                    <table id="dataTableRecipientes" class="table">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Observaciones</th>
                                <th>Capacidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recipientes as $recipiente)
                                <tr>
                                    <td>{{$recipiente->descripcion}}</td>
                                    <td>{{$recipiente->observaciones}}</td>
                                    <td>{{$recipiente->capacidad}}</td>
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
<script src="{{ asset('public/stevlab/catalogo/recipientes/data-table.js') }}"></script>
@endpush
