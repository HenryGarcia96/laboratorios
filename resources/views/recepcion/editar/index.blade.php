@extends('layout.master')

@push('plugin-styles') 
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush


@section('content')
  {{-- Inicio breadcrumb caja --}}
  <nav class="page-breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">StevLab</a></li>
          <li class="breadcrumb-item"> <a href="{{route('recepcion.index')}}">Recepcion</a> </li>
          <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('recepcion.editar')}}">Editar solicitud</a> </li>
      </ol>
  </nav>
  {{-- Fin breadcrumb recepcion --}}
  {{-- Inicia panel's detalle --}}
  {{-- @dd(Auth::user()->first()) --}}
<!----------------------------------------------------------------------------------------------------->

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Solicitudes</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Ap. paterno</th>
                <th>Ap. materno</th>
                <th>Fecha nacimiento</th>
                <th>Empresa</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($recepcions as $recepcion)
              <tr>
                <td>{{$recepcion->folio}}</td>
                <td>{{$recepcion->pacientes->nombre}}</td>
                <td>{{$recepcion->pacientes->ap_paterno}}</td>
                <td>{{$recepcion->pacientes->ap_materno}}</td>
                <td>{{$recepcion->pacientes->fecha_nacimiento}}</td>
                <td>{{$recepcion->empresas->descripcion}}</td>

                <td>
                    <a class="btn btn-primary" href="{{route('recepcion.recepcion_editar',$recepcion->id)}}" ><i data-feather="edit"></i></a>
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

<!----------------------------------------------------------------------------------------------------->

@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('public/assets/js/data-table.js') }}"></script>
@endpush