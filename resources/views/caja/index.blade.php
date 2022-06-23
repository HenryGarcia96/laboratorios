@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    {{-- Inicio breadcrumb caja --}}
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('caja.index')}}">Caja</a> </li>
        </ol>
    </nav>
    {{-- Fin breadcrumb caja --}}
    {{-- Inicia panel's detalle --}}
    {{-- @dd(Auth::user()->first()) --}}
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-md-block col-md-4 col-xl-3 left-wrapper">
          <div class="card rounded">
            <div class="card-header">
              <div class="ms-2">
                <h6 class="card-title mb-0">Apertura de caja</h6>
              </div>
            </div>
            <div class="card-body">
              
              <form class="forms-sample" action="{{route('caja.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="monto" class="col-form-label">Monto de apertura</label>
                  <div class="col-sm-12">
                    <input type="number" min='0' class="form-control {{ $errors->has('monto') ? 'is-invalid' : '' }}" name="monto" placeholder="$" value="0">
                    <x-jet-input-error for="monto"></x-jet-input-error>
                    
                  </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Abrir Caja</button>
              </form>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <!-- left wrapper end -->
        
        
      </div>
    {{-- Fin panel's detalle --}}
    {{-- Inicia tablas --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Línea de tiempo: usuario</h6>
              {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Edo.</th>
                      <th>Apertura</th>
                      <th>Entradas</th>
                      <th>Salidas</th>
                      <th>Entrada Efectivo</th>
                      <th>Entrada Tarjeta</th>
                      <th>Entrada Transferencias</th>
                      <th>Salida Efectivo</th>
                      <th>Salida Tarjeta</th>
                      <th>Salida Transferencias</th>
                      <th>Total</th>
                      <th>Inicio</th>
                      <th>Cierre</th>
                      <th>Reportes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($cajas as $caja)
                    {{-- @dd($caja) --}}
                      <tr>
                        <td>{{$caja->id}}</td>
                        <td>{{$caja->estatus}}</td>
                        <td>{{$caja->apertura}}</td>
                        <td>{{$caja->entradas}}</td>
                        <td>{{$caja->salidas}}</td>
                        <td>{{$caja->ventas_efectivo}}</td>
                        <td>{{$caja->ventas_tarjeta}}</td>
                        <td>{{$caja->ventas_transferencia}}</td>
                        <td>{{$caja->salidas_efectivo}}</td>
                        <td>{{$caja->salidas_tarjeta}}</td>
                        <td>{{$caja->salidas_transferencia}}</td>
                        <td>{{$caja->total}}</td>
                        <td>{{$caja->estatus}}</td>
                      </tr>
                    @empty
                        <tr>
                          <td>No data allowed</td>
                        </tr>
                    @endforelse
                    
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Fin tabla --}}

      {{-- Inicia tablas --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Línea de tiempo: Administrador</h6>
              {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Edo.</th>
                      <th>Apertura</th>
                      <th>Entradas</th>
                      <th>Salidas</th>
                      <th>Entrada Efectivo</th>
                      <th>Entrada Tarjeta</th>
                      <th>Entrada Transferencias</th>
                      <th>Salida Efectivo</th>
                      <th>Salida Tarjeta</th>
                      <th>Salida Transferencias</th>
                      <th>Total</th>
                      <th>Inicio</th>
                      <th>Cierre</th>
                      <th>Reportes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($cajas as $caja)
                    {{-- @dd($caja) --}}
                      <tr>
                        <td>{{$caja->id}}</td>
                        <td>{{$caja->estatus}}</td>
                        <td>{{$caja->apertura}}</td>
                        <td>{{$caja->entradas}}</td>
                        <td>{{$caja->salidas}}</td>
                        <td>{{$caja->ventas_efectivo}}</td>
                        <td>{{$caja->ventas_tarjeta}}</td>
                        <td>{{$caja->ventas_transferencia}}</td>
                        <td>{{$caja->salidas_efectivo}}</td>
                        <td>{{$caja->salidas_tarjeta}}</td>
                        <td>{{$caja->salidas_transferencia}}</td>
                        <td>{{$caja->total}}</td>
                        <td>{{$caja->estatus}}</td>
                      </tr>
                    @empty
                        <tr>
                          <td>No data allowed</td>
                        </tr>
                    @endforelse
                    
                     
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- Fin tabla --}}
@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush