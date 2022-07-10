@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush


@section('content') 
  {{-- Inicio breadcrumb caja --}}
  <nav class="page-breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
          <li class="breadcrumb-item active" aria-current="page"> <a href="">Catalogo</a> </li>
          <li class="breadcrumb-item active" aria-current="page"> <a href="">Pacientes</a> </li>
      </ol>
  </nav>

  {{-- Fin breadcrumb recepcion --}}
  {{-- Inicia panel's detalle --}}
  {{-- @dd(Auth::user()->first()) --}}

  <!------------------------------------------------------------------------------------------------>
        <div class="col-lg-6 col-12 mx-auto">
          @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
          </div>         
            @endif
          </div>
<!------------------------------------------------------------------------------------------------>
<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <form method="post" action="paciente_guardar">
          @csrf

            <div class="row">
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Sexo</label>
                  <select class="js-example-basic-single form-select @error('sexo') is-invalid @enderror" name="sexo" data-width="100%" value="{{old('sexo')}}">
                    <option></option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Fecha Nacimiento</label>
                  <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                  @error('fecha_nacimiento')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Celular</label>
                  <input type="number" class="form-control @error('celular') is-invalid @enderror" name="celular" value="{{old('celular')}}">
                  @error('celular')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Domicilio</label>
                  <input class="form-control @error('domicilio') is-invalid @enderror" name="domicilio" value="{{old('domicilio')}}" type="text">
                  @error('domicilio')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Colonia</label>
                  <input type="text" class="form-control @error('colonia') is-invalid @enderror" name="colonia" value="{{old('colonia')}}">
                  @error('colonia')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-15">
                <div class="mb-3">
                  <label class="form-label">No. Seguro popular</label>
                  <input type="text" class="form-control @error('seguro_popular') is-invalid @enderror" name="seguro_popular" value="{{old('seguro_popular')}}">
                  @error('seguro_popular')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Vigencia inicio</label>
                  <input type="date" class="form-control @error('vigencia_inicio') is-invalid @enderror" name="vigencia_inicio" value="{{old('vigencia_inicio')}}">
                  @error('vigencia_inicio')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Vigencia fin</label>
                  <input type="date" class="form-control @error('vigencia_fin') is-invalid @enderror" name="vigencia_fin" value="{{old('vigencia_fin')}}">
                  @error('vigencia_fin')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                  @error('email')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Empresa</label>
                  <select class="js-example-basic-single form-select @error('empresa') is-invalid @enderror" name="empresa" data-width="100%" value="{{old('empresa')}}">
                    <option></option>
                    <option value="publicidad">Empresa de publicidad</option>
                    <option value="particular">Particular</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Usuario</label>
                  <input type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{old('usuario')}}">
                  @error('usuario')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
                  @error('password')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>

        </form>
      </div>
    </div>
<!----------------------------Tabla--------------------------------------------------------------->
<style>
                  th, td{
                  text-align: center !important;
                  font-size: 14px !important;
                  padding: 0.6em !important; 

                }
</style>

  <div class="col-lg-19">
    <div class="card">

        <div class="row">
          <div class="col-md-18 grid-margin stretch-card">

              <div class="card-body">
                  <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Fecha de nacimiento</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($pacientes as $paciente)
                      <tr>
                        <td>{{$paciente->nombre}}<br>{{$paciente->ap_paterno}} {{$paciente->ap_materno}}</td>
                        <td class="data">{{$paciente->fecha_nacimiento}}</td>
                        <td>
                          <button onclick='mostrarModal(this)' type="button" class="btn btn-primary">
                            <i data-feather="edit"></i></a> 
                          </button>
                        </td> 
                        
                        <td>
                          <a href="{{route('catalogo.paciente_eliminar',$paciente->id)}}"><i data-feather="trash-2"></i></a>
        
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 
</div>
<!-----------modal------------------------------------------------------------------------------>
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar pacientes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('catalogo.paciente_actualizar')}}" method="post">
          @csrf
          <input class="form-control" name="id" value="" type="hidden" id="id">
          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" name="nombre" value="" type="text" id="nombre">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Ap Paterno</label>
                <input class="form-control" name="ap_paterno" value="" type="text" id="ap_paterno">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Ap Materno</label>
                <input class="form-control" name="ap_materno" value="" type="text" id="ap_materno">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Sexo</label>
                <select class="js-example-basic-single form-select" name="sexo" data-width="100%" value="" id="sexo">
                  <option></option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="" id="fecha_nacimiento">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Celular</label>
                <input type="number" class="form-control" name="celular" value="" id="celular">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Domicilio</label>
                <input class="form-control" name="domicilio" value="" type="text" id="domicilio">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Colonia</label>
                <input type="text" class="form-control" name="colonia" value="" id="colonia">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-15">
              <div class="mb-3">
                <label class="form-label">No. Seguro popular</label>
                <input type="text" class="form-control" name="seguro_popular" value="" id="seguro_popular">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Vigencia inicio</label>
                <input type="date" class="form-control" name="vigencia_inicio" value="" id="vigencia_inicio">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Vigencia fin</label>
                <input type="date" class="form-control" name="vigencia_fin" value="" id="vigencia_fin">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="" id="email">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="mb-3">
                <label class="form-label">Empresa</label>
                <select class="js-example-basic-single form-select" name="empresa" data-width="100%" value="" id="empresa">
                  <option></option>
                  <option value="publicidad">Empresa de publicidad</option>
                  <option value="particular">Particular</option>
                </select>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success">Actualizar</button>
      </div>
      
    </form>
    </div>
  </div>
</div>
<!---------------------------------------------------------------------------------------------->

  @endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/js/axios.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/pacientes/functions.js') }}"></script>
@endpush