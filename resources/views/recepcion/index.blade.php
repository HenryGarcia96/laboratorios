@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
{{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
--}}

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
              <style>
                  input, label, button{
                    font-size: 13px !important;
                  }
            </style>
<!---------------------------------------------------------------------------------------------------->
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
                                <label class="form-label">Nombre de paciente:</label>
                                <div class="container body-content">
                                    <div class="row">
                                <div class="col-10">
                                    <select class="js-example-basic-single js-states form-control  @error('id_paciente') is-invalid @enderror" id='id_paciente' name="id_paciente" data-width="100%"">
                                        <option selected disabled>Seleccione</option>
                                        @forelse ($pacientes as $paciente)
                                        <option value="{{$paciente->id}}">{{$paciente->nombre}} {{$paciente->ap_paterno}} {{$paciente->ap_materno}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>    
                                  <div class="col-1 bos">
                                    <button type="button" class="btn btn-success boto" data-bs-toggle="modal" data-bs-target=".paciente">
                                        <i data-feather="user-plus"></i>
                                    </button>
                                 </div>
                                </div>
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
                                        <option value="Lab.Clinico">Lab. Clinico</option>
                                        <option value="Urgencias">Urgencias</option>
                                    </select>
                                </div>
                                
                                <div class=" col-md-4">
                                    <label class="form-label">Tipo de paciente:</label>
                                    <select class="form-select" id='tipoPaciente' name="tipoPaciente" data-width="100%">
                                        <option selected disabled>Seleccione</option>
                                        <option value="Lab.Clinico">Lab. Clinico</option>
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
                                <label class="form-label">Medico:</label><br>
                                <div class="container body-content">
                                    <div class="row">
                                        <div class="col-10">
                                    <select class="js-example-basic-single js-states form-control  @error('id_doctor') is-invalid @enderror" id='id_doctor' name="id_doctor">
                                        <option selected disabled>Seleccione</option>
                                        @forelse ($doctores as $doctor)
                                        <option value="{{$doctor->id}}">{{$doctor->nombre}} {{$doctor->ap_paterno}} {{$doctor->ap_materno}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    </div>
                                    <div class="col-1 bos">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target=".medico">
                                            <i data-feather="briefcase"></i>
                                        </button>
                                     </div>

                                </div>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">No. Cama:</label>
                                    <input class="form-control" id='numCama' name="numCama" value="{{old('numCama')}}" type="number">
                                  </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Peso:</label>
                                    <input class="form-control" id='peso' name="peso"value="" type="text">
                                </div>
                                
                                <div class="col-md-3">
                                    <label class="form-label">Talla:</label>
                                    <input class="form-control" id="talla" name="talla"value="" type="text">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">FUR:</label>
                                    <input class="form-control" id='fur' name="fur" type="text">
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label class="form-label">F. Flebotomia:</label>
                                    <div class="input-group date datepicker" id="datePickerExample">
                                      <input type="text" class="form-control" id="f_flebotomia" name="f_flebotomia">
                                      <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-5">
                                  <label class="form-label">H. Flebotomia:</label>
                                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3"/>
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o" data-feather="clock"></i></div>
                                    </div>
                                </div>
                              </div>
                                  --}}
  
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">No. vuelo:</label>
                                    <input type="text" class="form-control" id="num_vuelo" name="num_vuelo">
                                </div>
                                
                                <div class=" col-md-4">
                                    <label class="form-label">Pais Destino:</label>
                                    <input type="text" class="form-control" id="pais_destino" name="pais_destino">
                                </div>
                                <div class=" col-md-4">
                                    <label class="form-label">Aerolinea:</label>
                                    <input type="text" class="form-control" id="aerolinea" name="aerolinea">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Medicamento:</label>
                                    <input class="form-control mb-1 mb-md-0" id="medicamento" name="medicamento"value="" type="text">
                                </div>
                                
                            </div>
                            <div class="row mb-3">
        
                                <div class="col-md-12">
                                    <label class="form-label">Diagnostico:</label>
                                    <input class="form-control mb-1 mb-md-0" id="diagnostico" name="diagnostico"value="" type="text">
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
<!---------------------------------------------- NUEVO PACIENTE------------------------------------------------------>
<div class="modal fade paciente" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="modalPaciente">Nuevo pacientes</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
      
        <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
          
                  <form method="post" action="paciente_guardar">
                    @csrf
          
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre')}}"type="text">
                            @error('nombre')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Ap Paterno</label>
                            <input class="form-control @error('ap_paterno') is-invalid @enderror" name="ap_paterno" value="{{old('ap_paterno')}}" type="text">
                            @error('ap_paterno')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Ap Materno</label>
                            <input class="form-control @error('ap_materno') is-invalid @enderror" name="ap_materno" value="{{old('ap_materno')}}" type="text">
                            @error('ap_materno')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                      </div>
          
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select class="js-example-basic-single form-select @error('sexo') is-invalid @enderror" name="sexo" data-width="100%" value="{{old('sexo')}}">
                              <option></option>
                              <option value="masculino">Masculino</option>
                              <option value="femenino">Femenino</option>
                            </select>
                            @error('sexo')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Fecha Nacimiento</label>
                            <div class="input-group date datepicker" id="fecha-nacimiento">
                              <input type="text" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                              <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
          
                            @error('fecha_nacimiento')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Celular</label>
                            <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                          </div>
                        </div>
                      </div>
          
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Domicilio</label>
                            <input class="form-control" name="domicilio" value="{{old('domicilio')}}" type="text">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" name="colonia" value="{{old('colonia')}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                              <label class="form-label">No. Seguro popular</label>
                              <input type="text" class="form-control" name="seguro_popular" value="{{old('seguro_popular')}}">
                            </div>
                          </div>
                      </div>
     
         
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Vigencia inicio</label>
                          <div class="input-group date datepicker" id="vigencia-inicio">
                            <input type="text" class="form-control" name="vigencia_inicio" value="{{old('vigencia_inicio')}}">
                            <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                          </div>
                        </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Vigencia fin</label>
                            <div class="input-group date datepicker" id="vigencia-fin">
                              <input type="text" class="form-control" name="vigencia_fin" value="{{old('vigencia_fin')}}">
                              <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
                          </div>
                        </div>
                      </div>
     
 
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}">
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Empresa</label>               
                            <select class="js-example-basic-single form-select form-control" name="id_empresa" data-width="100%" value="{{old('id_empresa')}}">
                              @forelse ($empresas as $empresa)
                              <option value="{{$empresa->id}}">{{$empresa->descripcion}}</option> 
                              @empty
                              @endforelse
                             </select>
                          </div>
                      </div>
          
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="usuario" value="">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" readonly="readonly" value="{{$a}}">
                          </div>
                        </div>
                      </div>
          
                      <button type="submit" onclick="showSwal('mixin')" class="btn btn-primary">Guardar</button>
          
                  </form>
                </div>
              </div>

    </div>
  </div>
</div>
  </div>
</div>

  <!---------------------------------------------- NUEVO MEDICO------------------------------------------------------>
  

  <div class="modal fade medico" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalPaciente">Nuevo medico</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>

        <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
        
                    <form method="post" action="doctores_guardar">
                     @csrf  
        
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Clave</label>
                            <input class="form-control @error('clave') is-invalid @enderror" name="clave" value="{{old('clave')}}"type="text">
                            @error('clave')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{old('usuario')}}" type="text">
                            @error('usuario')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                              <label class="form-label">Password</label>
                              <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" type="password">
                              @error('password')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                              @enderror
                            </div>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre')}}" type="text">
                            @error('nombre')
                            <span class="invalid-feedback">
                              <strong>{{$message}}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                              <label class="form-label">Ap. Paterno</label>
                              <input type="text" class="form-control @error('ap_paterno') is-invalid @enderror" name="ap_paterno" value="{{old('ap_paterno')}}">
                              @error('ap_paterno')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label class="form-label">Ap. Materno</label>
                              <input type="text" class="form-control @error('ap_materno') is-invalid @enderror" name="ap_materno" value="{{old('ap_materno')}}">
                              @error('ap_materno')
                              <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                              </span>
                              @enderror
                            </div>
                          </div>
                    </div>
        
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Telefono</label>
                            <input type="number" class="form-control" name="telefono" value="{{old('telefono')}}">
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                              <label class="form-label">Celular</label>
                              <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                          </div>
                      </div>
        
                      <button type="submit" onclick="showSwal('mixin')" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
              </div> 
            </div>
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
<script src="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
--}}

@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/form-validation.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/select2.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/functions.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/datepicker.js') }}"></script>
<script src="{{ asset('public/stevlab/recepcion/registro/timepicker.js') }}"></script>

@endpush

