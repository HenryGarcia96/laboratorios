@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item"> <a href="#">Recepcion</a></li>
        <li class="breadcrumb-item active" aria-current="page">Captura de resultados</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 col-lg-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Busqueda de solicitudes</h6>
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Fecha inicial</label>
                            <div class="input-group date datepicker consultaEstudios" id="selectInicio">
                                <input type="text" class="form-control">
                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                
                            </div>
                        </div>
                    </div><!-- Col -->
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Fecha final</label>
                            <div class="input-group date datepicker consultaEstudios" id="selectFinal">
                                <input type="text" class="form-control">
                                <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                    </div><!-- Col -->
                </div><!-- Row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Sucursal</label>
                            <select class="form-select consultaEstudios" id="selectSucursal">
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{$sucursal->id}}">{{$sucursal->sucursal}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Estado del estudio</label>
                            <select class="form-select consultaEstudios" id="selectEstudio">
                                <option selected value="todos">Todos</option>
                                <option value="solicitudes">Solicitudes</option>
                                <option value="capturados">Capturados</option>
                                <option value="validados">Validados</option>
                                <option value="cancelados">Cancelados</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Area</label>
                            <select class="form-select" id="selectArea">
                                @foreach ($areas as $area)
                                    <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- Col -->
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="mb-3">
                            {{-- <a href="#" type="button" class='btn btn-primary submit'>Buscar</a> --}}
                            {{-- <button type="button" class="btn btn-primary submit ">Submit form</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Solicitudes</h4>
                <div class="table-responsive">
                    <table id="dataTableMetodos" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Nombre</th>
                                <th>Sucursal</th>
                                <th>Empresa</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="listEstudios">
                            @forelse($estudios as $estudio)
                                <tr>
                                    <td>{{$estudio->folio}}</td>
                                    <td>{{$estudio->paciente}}</td>
                                    <td>Sucursal</td>
                                    <td>{{$estudio->empresa}}</td>
                                    <td>{{$estudio->created_at}}</td>
                                </tr>
                            @empty
                            @endforelse 
                            {{-- @forelse ($metodos as $metodo)
                                <tr>
                                    <td>{{$metodo->descripcion}}</td>
                                    <td>{{$metodo->observaciones}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        No data allowed
                                    </td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('public/stevlab/recepcion/captura/datepicker.js') }}"></script>
    <script src="{{ asset('public/stevlab/recepcion/captura/functions.js') }}"></script>
@endpush