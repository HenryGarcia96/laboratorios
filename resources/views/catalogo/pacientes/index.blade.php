@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
                  @error('sexo')
                  <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4">
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
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Celular</label>
                  <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Domicilio</label>
                  <input class="form-control" name="domicilio" value="{{old('domicilio')}}" type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Colonia</label>
                  <input type="text" class="form-control" name="colonia" value="{{old('colonia')}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-15">
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

<style>
.empre{
  width: 220px !important;
  height: 33px !important;
}
</style>

            <div class="row">
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="{{old('email')}}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Empresa</label>               
                  <select class="js-example-basic-single form-select form-control" name="id_empresa" data-width="100%" value="{{old('id_empresa')}}">
                    @forelse ($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->descripcion}}</option> 
                    @empty
                    @endforelse
                   </select>
                   <button type="button" class="btn btn-secondary empre" data-bs-toggle="modal" data-bs-target=".bd-example-modal-xl">Nueva empresa</button>           
                  </div>
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
    <br>

<!----------------------------Tabla--------------------------------------------------------------->
<style>
                  th, td{
                  text-align: center !important;
                  font-size: 13px !important;
                  padding: 0.6em !important; 
                  }
                  input, label, button{
                    font-size: 13px !important;
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
                          <button onclick='mostrarModal(this)' type="button" class="btn btn-success">
                            <i data-feather="edit"></i></a> 
                          </button>
                        </td> 
                        
                        <td>
                          <a class="btn btn-danger regis-eliminar"
                           href="{{route('catalogo.paciente_eliminar',$paciente->id)}}"><i data-feather="trash-2"></i></a>
        
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
                <select class="js-example-basic-single js-states form-control @error('id_empresa') is-invalid @enderror" name="id_empresa" 
                id="idEmpresa">
                  @forelse ($empresas as $empresa)
                  <option value="{{$empresa->id}}">{{$empresa->descripcion}}</option>
                  @empty
                  @endforelse
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

<!-- Modal empresa nueva -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Nueva empresa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      
      <div class="row">
        <div class="col-md-12 stretch-card">
          <div class="card">
            <div class="card-body">
    
                <form method="post" action="empresa_guardar">
                 @csrf 
    
                 <div class="row">
                    <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">Clave</label>
                          <input class="form-control @error('clave') is-invalid @enderror" name="clave" value=""type="text">
                          @error('clave')
                          <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">Usuario</label>
                          <input class="form-control @error('usuario') is-invalid @enderror" name="usuario" value=""type="text">
                          @error('usuario')
                          <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input class="form-control @error('password') is-invalid @enderror" name="password" value=""type="password">
                          @error('password')
                          <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">RFC</label>
                          <input class="form-control" name="rfc" value="" type="text">
                        </div>
                    </div>
                 </div>
    
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Descripcion</label>
                          </div>
                          <div class="col-lg-15">
                            <textarea id="maxlength-textarea" class="form-control" id="defaultconfig-4" maxlength="500" rows="1" name="descripcion"></textarea>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Calle</label>
                          <input class="form-control" name="calle" value="" type="text">
                        </div>
                      </div>
                  </div>
    
                  <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input class="form-control" name="email" value="" type="email">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                          <label class="form-label">Colonia</label>
                          <input type="text" class="form-control" name="colonia" value="">
                          </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label class="form-label">Ciudad</label>
                          <input type="text" class="form-control" name="ciudad" value="">
                        </div>
                      </div>
                </div>
    
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="">
                        @error('telefono')
                        <span class="invalid-feedback">
                          <strong>{{$message}}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                          <label class="form-label">Contacto</label>
                          <input type="text" class="form-control @error('contacto') is-invalid @enderror" name="contacto" value="">
                          @error('contacto')
                          <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
    
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label class="form-label">Descuento</label>
                          <input type="number" class="form-control @error('descuento') is-invalid @enderror" name="descuento" value="">
                          @error('descuento')
                          <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                          </span>
                          @enderror
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
<!---------------------------------------------------------------------------------------------->

  @endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/js/axios.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/select2/select2.min.js') }}"></script>


@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/pacientes/swee-alert.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/pacientes/functions.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/pacientes/datepicker.js') }}"></script>
<script src="{{ asset('public\stevlab\catalogo\pacientes\select2.js') }}"></script>
@endpush