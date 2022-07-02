@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="#">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Métodos</li>
        
    </ol>
</nav>

<div class="row">
    {{-- d-none d-md-block col-md-4 col-xl-3 left-wrapper --}}
    <div class="d-md-block col-md-12 col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <h6 class="card-title">Técnicas</h6>
                
                <form class="forms-sample" action="{{route('catalogo.store-tecnica')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name='descripcion' class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" autocomplete="off" placeholder="Descripción">
                        <x-jet-input-error for="descripcion"></x-jet-input-error>
                    </div>
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea name="observaciones" rows="3" class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}" placeholder="Observaciones"></textarea>
                        <x-jet-input-error for="observaciones"></x-jet-input-error>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    {{-- <button class="btn btn-secondary">Cancel</button> --}}
                </form>
                
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabla de técnicas</h4>
                <div class="table-responsive">
                    <table id="dataTableTecnicas" class="table">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tecnicas as $tecnica)
                                <tr>
                                    <td>{{$tecnica->descripcion}}</td>
                                    <td>{{$tecnica->observaciones}}</td>
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
<script src="{{ asset('public/stevlab/catalogo/tecnicas/data-table.js') }}"></script>

@endpush