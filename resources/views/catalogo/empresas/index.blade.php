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
          <li class="breadcrumb-item active" aria-current="page"> <a href="">Empresas</a> </li>
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

            <form method="post" action="empresa_guardar">
             @csrf 

             <div class="row">
                <div class="col-sm-3">
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
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Usuario</label>
                      <input class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{old('usuario')}}"type="text">
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
                      <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}"type="password">
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
                      <input class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{old('rfc')}}" type="text">
                      @error('rfc')
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
                      <input class="form-control @error('calle') is-invalid @enderror" name="calle" value="{{old('calle')}}" type="text">
                      @error('calle')
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
                      <label class="form-label">Email</label>
                      <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" type="email">
                      @error('email')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-4">
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
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Ciudad</label>
                      <input type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{old('ciudad')}}">
                      @error('ciudad')
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
                      <label class="form-label">Contacto</label>
                      <input type="text" class="form-control @error('contacto') is-invalid @enderror" name="contacto" value="{{old('contacto')}}">
                      @error('contacto')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Lista de precios</label>
                      <select class="js-example-basic-single form-select @error('list_precios') is-invalid @enderror" name="list_precios" data-width="100%" value="{{old('list_precios')}}">
                        <option></option>
                        <option value="particular">Particular</option>
                        <option value="maquilla">Maquilla</option>
                      </select>
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
                  <th>Empresa</th>
                  <th>RFC</th>
                  <th>Editar</th>
                  <th>Eliminar</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($empresas as $empresa)
                <tr>
                  <td class="data">{{$empresa->clave}}</td>
                  <td>{{$empresa->descripcion}}</td>
                  <td>{{$empresa->rfc}}</td>
                  {{-- <td>
                    <a href="{{route('catalogo.doctor_editar', $doctor->id)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"><i data-feather="edit"></i></a>
                  </td> --}}
                  <td>
                    <button onclick='mostrarModal(this)' type="button" class="btn btn-primary">
                      <i data-feather="edit"></i></a>
                    </button>
                  </td>
                  
                  <td>
                    <a href="{{route('catalogo.empresa_eliminar',$empresa->id)}}"><i data-feather="trash-2"></i></a>

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
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Editar empresas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('catalogo.empresa_actualizar')}}" method="post">
          @csrf
          <input class="form-control" name="id" value="" type="hidden" id="id">
          
          <div class="row">
            <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">Clave</label>
                  <input class="form-control" name="clave" value=""type="text" id="clave">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">Usuario</label>
                  <input class="form-control" name="usuario" value="" type="text" id="usuario">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input class="form-control" name="password" value="" type="password" id="password">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mb-3">
                  <label class="form-label">RFC</label>
                  <input class="form-control" name="rfc" value="" type="text" id="rfc">
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
                    <textarea  class="form-control" id="descripcion" maxlength="500" rows="1" name="descripcion"></textarea>
                  </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                  <label class="form-label">Calle</label>
                  <input class="form-control" name="calle" value="" type="text" id="calle">
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input class="form-control" name="email" value="" type="email" id="email">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Colonia</label>
                  <input type="text" class="form-control" name="colonia" value="" id="colonia">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Ciudad</label>
                  <input type="text" class="form-control" name="ciudad" value="" id="ciudad">
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
                  <label class="form-label">Contacto</label>
                  <input type="text" class="form-control" name="contacto" value="" id="contacto">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="mb-3">
                  <label class="form-label">Lista de precios</label>
                  <select class="js-example-basic-single form-select" name="list_precios" data-width="100%" value="" id="list_precios">
                    <option></option>
                    <option value="particular">Particular</option>
                    <option value="maquilla">Maquilla</option>
                  </select>
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
<script src="{{ asset('public/stevlab/catalogo/empresas/functions.js') }}"></script>
@endpush