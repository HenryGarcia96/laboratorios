@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Registro de laboratorio (Paso 2)</h6>
                <form action="{{route('registro.regSucursal')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Nombre comercial</label>
                        <input name='nombre' type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="Nombre comercial">
                        <x-jet-input-error for="nombre"></x-jet-input-error>
                      </div>
                    </div><!-- Col -->
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Razón social</label>
                        <input name="razon_social" type="text" class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" placeholder="Razón social">
                        <x-jet-input-error for="razon_social"></x-jet-input-error>
                      </div>
                    </div><!-- Col -->
                  </div><!-- Row -->
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label class='form-label'>Dirección</label>
                            <textarea name="direccion" class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" rows="2" placeholder="Dirección"></textarea>
                        <x-jet-input-error for="direccion"></x-jet-input-error>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">País</label>
                          <select id='pais' name='pais' onchange="getStates()" class=" js-example-basic-single form-select {{ $errors->has('pais') ? 'is-invalid' : '' }}" >
                            <option selected disabled>Selecciona tu país</option>
                            @foreach ($paises as $pais)
                              <option value="{{$pais['country_name']}}">{{$pais['country_name']}}</option>
                            @endforeach
                          </select>
                          <x-jet-input-error for="pais"></x-jet-input-error>

                        </div>
                    </div><!-- Col -->
                    
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select id='estado' name='estado' onchange='getCity()' class="form-select {{ $errors->has('estado') ? 'is-invalid' : '' }}" >
                          <option selected disabled>Selecciona tu ciudad</option>
                        </select>
                        <x-jet-input-error for="estado"></x-jet-input-error>

                      </div>
                    </div><!-- Col -->
                    
                  </div><!-- Row -->
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Ciudad</label>
                            <select id='ciudad' name='ciudad' class="js-example-basic-single form-select {{ $errors->has('ciudad') ? 'is-invalid' : '' }}" >
                            </select>
                        <x-jet-input-error for="ciudad"></x-jet-input-error>

                        </div>
                    </div><!-- Col -->
                    <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Código postal</label>
                        <input type="text" name='cp' class="form-control {{ $errors->has('cp') ? 'is-invalid' : '' }}" placeholder="Código postal">
                        <x-jet-input-error for="cp"></x-jet-input-error>
                    </div>
                    </div><!-- Col -->

                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Correo electrónico">
                        <x-jet-input-error for="email"></x-jet-input-error>

                      </div>
                    </div><!-- Col -->
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Télefono</label>
                        <input type="number" name="telefono" class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" autocomplete="off" placeholder="Número telefonico">
                        <x-jet-input-error for="telefono"></x-jet-input-error>

                      </div>
                    </div><!-- Col -->
                  </div><!-- Row -->
                  <button type="submit" class="btn btn-primary submit">Crear Laboratorio</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      

</div>

@endsection


@push('custom-scripts')
    <script src="{{ asset('public/assets/js/axios.min.js') }}"></script>

    {{-- Registro --}}
    <script src="{{ asset('public/stevlab/functions.js')}}"></script>
    {{-- End registro --}}
@endpush