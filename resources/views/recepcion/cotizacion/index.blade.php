@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@endpush


@section('content')
{{-- Inicio breadcrumb caja --}}
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
        <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('recepcion.cotizacion')}}">Cotizacion</a> </li>
    </ol>
</nav>
{{-- Fin breadcrumb recepcion --}}
{{-- Inicia panel's detalle --}}
{{-- @dd(Auth::user()->first()) --}}
<!----------------------------------------------------------------------------------------------------->
<style>
    input, label, button{
        font-size: 13px !important;
    }
</style>
<!----------------------------------------------------------------------------------------------------->
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form id='recogerDatos' class="form-sample" method="post" action="prue_pdf">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="row mb-3">
                                <div class="col-md-14">

                                    <label class="form-label">Nombre de solicitante:</label>
                                    <input  class="form-control @error('nombre') is-invalid @enderror" id='nombre' name="nombre" type="text" value="">
                                </div>
                            </div>                           
                            <div class="row mb-3">
                                <div class="col-md-14">                                   
                                    <div class="col-sm-12">
                                        <label class="form-label">Empresa:</label>
                                        
                                        <select class="js-example-basic-single js-states form-control" id='listEmpresas' name="listEmpresas">
                                            {{--
                                            <option selected disabled>Seleccione</option>
                                            @forelse ($empresas as $empresa)
                                            <option  value="{{$empresa->imagen}}">{{$empresa->descripcion}}</option>
                                            @empty
                                            @endforelse
                                             --}}    
                                        </select> 
                                                                          
                                    </div>
                                </div>                      
                            </div>                             
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="defaultconfig-4" class="form-label">Observaciones:</label>
                                    <textarea class="form-control" maxlength="500" rows="2" id="observaciones" name="observaciones"></textarea>
                                </div>  
                            </div>                                                                                   
                        </div>
                        <div class="col-md-6">
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
                                    <input disabled class="form-control mb-4 mb-md-0" name="num_total" type="text" placeholder="$00.00" readonly="readonly" id="num_total">
                                </div> <br>
                            </div>
                                
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success">Imprimir</button>
   
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
@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>

<script src="{{ asset('public/stevlab/recepcion/cotizacion/select2.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/functions.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/cotizacion/recep-date.js') }}"></script>

@endpush