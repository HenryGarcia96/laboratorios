@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />


@endpush


@section('content')
{{-- Inicio breadcrumb caja --}}
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('recepcion.index')}}">Recepcion</a> </li>
    </ol>
</nav>
{{-- Fin breadcrumb recepcion --}}
{{-- Inicia panel's detalle --}}
{{-- @dd(Auth::user()->first()) --}}
<!----------------------------------------------------------------------------------------------------->
<?php
$z=  (random_int(100000000,999999999));
?>
<!---------------------------------------------------------------------------------------------------->
<div class="col-lg-6 col-12 mx-auto">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{Session::get('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
    </div>         
    @endif 
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form id='signupForm' class="form-sample">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Folio:</label>
                                    <input  class="form-control @error('folio') is-invalid @enderror" id='folio' name="folio" type="text" readonly="readonly" value="<?php echo $z;?>">
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">No. Orden:</label>
                                    <input class="form-control @error('numOrden') is-invalid @enderror" id='numOrden' name="numOrden" value="{{old('numOrden')}}" type="number">
                                    @error('numOrden')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label">No.registro</label>
                                    <input class="form-control @error('numRegistro') is-invalid @enderror" id="numRegistro" name="numRegistro" value="{{old('numRegistro')}}" type="number">
                                    @error('numRegistro')
                                    <span class="invalid-feedback">
                                        <strong>{{'Es necesario un Numero de registro'}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Nombre de paciente(modals):</label>
                                    <select class="js-example-basic-single js-states form-control @error('id_paciente') is-invalid @enderror" id='id_paciente' name="id_paciente" data-width="100%"">
                                        <option selected disabled>Seleccione</option>
                                        @forelse ($pacientes as $paciente)
                                        <option value="{{$paciente->id}}">{{$paciente->nombre}} {{$paciente->ap_paterno}} {{$paciente->ap_materno}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <label class="form-label">Empresa:</label>
                                    <select class="js-example-basic-single js-states form-control @error('id_empresa') is-invalid @enderror" id='id_empresa' name="id_empresa">
                                        <option selected disabled>Seleccione</option>
                                        @forelse ($empresas as $empresa)
                                        <option value="{{$empresa->id}}">{{$empresa->descripcion}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Servicio:</label>
                                    <select class="form-select" name="servicio" data-width="100%">
                                        <option selected disabled>Seleccione</option>
                                        <option value="TX">Empresa de publicidad</option>
                                        <option value="NY">Empresa particular</option>
                                    </select>
                                </div>
                                
                                <div class=" col-md-4">
                                    <label class="form-label">Tipo de paciente:</label>
                                    <select class="form-select" id='tipoPaciente' name="tipoPaciente" data-width="100%">
                                        <option selected disabled>Seleccione</option>
                                        <option value="TX">Empresa de publicidad</option>
                                        <option value="NY">Empresa particular</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Turno:</label>
                                    <select class="form-select" name="turno" data-width="100%">
                                        <option selected disabled>Seleccione</option>
                                        <option value="Matutino">Matutino</option>
                                        <option value="Vespertino">Vespertino</option>
                                        <option value="Nocturno">Nocturno</option>
                                        <option value="Fines de semana">Fines de semana</option>
                                    </select>
                                </div>                        
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Medico(modals):</label><br>
                                    <select class="js-example-basic-single js-states form-control @error('id_doctor') is-invalid @enderror" id='id_doctor' name="id_doctor">
                                        <option selected disabled>Seleccione</option>
                                        @forelse ($doctores as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->nombre}} {{$doctor->ap_paterno}} {{$doctor->ap_materno}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">No. Cama:</label>
                                    <input class="form-control @error('numCama') is-invalid @enderror" id='numCama' name="numCama" value="{{old('numCama')}}" type="number">
                                    @error('numCama')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Peso:</label>
                                    <input class="form-control @error('peso') is-invalid @enderror" id='peso' name="peso"value="{{old('peso')}}" type="text">
                                    @error('peso')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Talla:</label>
                                    <input class="form-control @error('talla') is-invalid @enderror" id="talla" name="talla"value="{{old('talla')}}" type="text">
                                    @error('talla')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">FUR:</label>
                                    <input class="form-control" id='fur' name="fur" type="text">
                                </div>
                            </div> 
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Medicamento:</label>
                                    <input class="form-control mb-1 mb-md-0 @error('medicamento') is-invalid @enderror" id="medicamento" name="medicamento"value="{{old('medicamento')}}" type="text">
                                    @error('medicamento')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row mb-3">
        
                                <div class="col-md-12">
                                    <label class="form-label">Diagnostico:</label>
                                    <input class="form-control mb-1 mb-md-0 @error('diagnostico') is-invalid @enderror" id="diagnostico" name="diagnostico"value="{{old('diagnostico')}}" type="text">
                                    @error('diagnostico')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-6">
    
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="defaultconfig-4" class="form-label">Observaciones:</label>
                                    <textarea id="maxlength-textarea" class="form-control" maxlength="500" rows="2" id="observaciones" name="observaciones"></textarea>
                                </div>   
                            </div>
                            <div class="row mb-3">
        
                                <div class="col-md-12">
                                    <label class="form-label">Estudios:</label>
                                    <select name="listEstudio" id="listEstudio" class="js-example-basic-single form-select" data-width="100%">

                                    </select>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
        
                                <!------------------------Tabla---------------------------------------------------------------------->
                                <style>
                                    th, td{
                                        text-align: center !important;
                                        font-size: 11px !important;
                                        padding: 0.2em !important; 
                                        
                                    }
                                    #num_total{
                                        font-size: 25px !important;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-20 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Clv</th>
                                                                <th>Descrip</th>
                                                                <th>Tip</th>
                                                                <th>Cost</th>
                                                                <th>Conforme</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id='listEstudios'>
                                                            {{-- <tr>
                                                                <th>00TP</th>
                                                                <td>T.P/TIEMPO DE PROTROMBINA</td>
                                                                <td>Estudios</td>
                                                                <td>$80.00</td>
                                                                <td>
                                                                    <div class="form-check mb-3">
                                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                        <label class="form-check-label" for="exampleCheck1"></label>
                                                                    </div>
                                                                </td>
                                                                <td><a href=""><i data-feather="delete"></i></a></td>
                                                            </tr> --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
        
                                <div class="col-md-12">
                                    <label class="form-label">Total:</label>
                                    <input disabled class="form-control mb-4 mb-md-0" name="tot_precio" type="text" placeholder="$00.00" readonly="readonly" id="num_total">
                                </div> <br>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button type="button" class="btn btn-danger">Borrar</button>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                </form>

            </div>
        </div>
        
    </div>
    
    
</div>

<!----------------------------------------------------------------------------------------------------->
@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/js/axios.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/form-validation.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/select2.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/functions.js') }}"></script>

@endpush

