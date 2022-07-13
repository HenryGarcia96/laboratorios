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
          <li class="breadcrumb-item active" aria-current="page"> <a href="">Doctores</a> </li>
      </ol>
  </nav>

  {{-- Fin breadcrumb recepcion --}}
  {{-- Inicia panel's detalle --}}
  {{-- @dd(Auth::user()->first()) --}}

<!------------------------------------------------------------------------------------------------>

<div class="row">
    <div class="col-md-12 stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="col-lg-6 col-12 mx-auto">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{Session::get('success')}}</strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
            </div>         
              @endif
            </div>

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
                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old('telefono')}}">
                    @error('telefono')
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
                  <div class="col-sm-4">
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
              </div>

              <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
      </div> 
    </div>
  </div>

<!----------------------------Tabla--------------------------------------------------------------->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table id="dataTableExample" class="table">
              <thead>
                <tr>
                  <th>Clave</th>
                  <th>Nombre</th>
                  <th>Ap Paterno</th>
                  <th>Ap Materno</th>
                  <th>Editar</th>
                  <th>Eliminar</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($doctores as $doctor)
                <tr>
                  <td class="data">{{$doctor->clave}}</td>
                  <td>{{$doctor->nombre}}</td>
                  <td>{{$doctor->ap_paterno}}</td>
                  <td>{{$doctor->ap_materno}}</td>
                  {{-- <td>
                    <a href="{{route('catalogo.doctor_editar', $doctor->id)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i data-feather="edit"></i></a>
                  </td> --}}
                  <td>
                    {{--<button class="btn btn-primary btnEditar" data-toggle="modal" data-target="#modalEditar"> 

                      Editar <i data-feather="edit"></i>
                    </button>--}}
                    <button onclick='mostrarModal(this)' type="button" class="btn btn-primary">
                      Editar
                    </button>
                </td>

                  <td>
                    <a class="btn btn-primary" href="{{ route('catalogo.doctor_eliminar',$doctor->id) }}"><i data-feather="trash-2"></i></a>

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
  <!-----------modal------------------------------------------------------------------------------>
<!-- Button trigger modal -->

<!-- Modal editar-->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar doctores</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('catalogo.doctor_actualizar')}}" method="post">
          @csrf

          <div class="row">
            <div class="col-sm-2">
                <input class="form-control" id='id' name="id" value="" type="hidden">
              <div class="mb-4">
                <label class="form-label">Clave</label>
                <input class="form-control" id='clave' name="clave" value="" type="text">
              </div>
            </div>
            <div class="col-sm-5">
              <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" name="usuario" value="" type="text" id="usuario">
              </div>
            </div>
            <div class="col-sm-5">
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input class="form-control" name="password" value="" type="password" id="password">
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" name="nombre" value="" type="text" id="nombre">
              </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Ap. Paterno</label>
                  <input type="text" class="form-control" name="ap_paterno" value="" id="ap_paterno">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Ap. Materno</label>
                  <input type="text" class="form-control" name="ap_materno" value="" id="ap_materno">
                </div>
              </div>
        </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="mb-3">
                <label class="form-label">Telefono</label>
                <input type="number" class="form-control" name="telefono" value="" id="telefono">
              </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Celular</label>
                  <input type="number" class="form-control" name="celular" value="" id="celular">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="" id="email">
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
<!------------------------------------------------------------------------------------------------>
@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/js/axios.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/doctores/functions.js') }}"></script>

@endpush





