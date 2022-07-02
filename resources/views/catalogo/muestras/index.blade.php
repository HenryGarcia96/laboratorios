@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Muestras</li>
    </ol>
</nav>

<div class="row">
    <div class="d-md-block col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <h6 class="card-title">Muestras</h6>
                
                <form class="forms-sample" action="{{route('catalogo.store-muestra')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="descripcion" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                            <input type="text" name='descripcion' class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" placeholder="Descripción">
                            <x-jet-input-error for="descripcion"></x-jet-input-error>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                        <div class="col-sm-9">
                            <input type="text" name='observaciones' class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" placeholder="Observaciones">
                            <x-jet-input-error for="observaciones"></x-jet-input-error>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabla de muestras</h4>
                <div class="table-responsive">
                    <table id="dataTableMuestras" class="table">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($muestras as $muestra)
                                <tr>
                                    <td>{{$muestra->descripcion}}</td>
                                    <td>{{$muestra->observaciones}}</td>
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
@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('public/stevlab/catalogo/muestras/data-table.js') }}"></script>
@endpush