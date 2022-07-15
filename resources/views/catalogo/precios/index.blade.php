@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('public/assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

@endpush

@section('content')

<div class="row">
    <div class=" col-sm-12 col-md-6 col-lg-4 grid-margin stretch-car">
        <div class="card">
            <div class="card-body">
                <form id='formList' action="{{route('catalogo.store-list')}}" method='post' class="forms-sample">
                    @csrf
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" autocomplete="off" placeholder="Descripción">
                    </div>
                    <div class="mb-3">
                        <label for="descuento" class="form-label">Descuento</label>
                        <input type="number" min="0" max="100" maxlength="3" id='descuento' name="descuento" class="form-control" placeholder="Descuento en %">
                    </div>
                    <div class="mb-3">
                        {{-- <p class="text-muted mb-3">Ordenamiento (Orden de impresión)</p> --}}
                        <label for="lista" class="form-label">Usar precios de lista: <span class="badge bg-primary">Opcional</span></label>
                        <select  class="form-control" name="lista" id="lista">
                            <option selected disabled>Seleccione</option>
                            @forelse ($listas as $lista)
                            <option value="{{$lista->id}}">{{$lista->descripcion}}</option>
                            @empty
                            
                            @endforelse
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                </form>
            </div>
        </div>
        
    </div>
    <div class="d-md-block col-sm-12 col-md-6 col-lg-6 grid-margin stretch-car">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de precios</h4>
                
                <div class="table-responsive">
                    
                    <table id="dataTablePrecios" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripcion</th>
                                <th>Descuento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id='listPrecios'>
                            @forelse ($listas as $lista)
                            <tr>
                                <th id="claveLista">{{$lista->id}}</th>
                                <th id="nombreLista">{{$lista->descripcion}}</th>
                                <th>{{$lista->descuento}} % </th>
                                <th>
                                    <a onclick='detailList(this, {{$lista->id}})' class="btn btn-primary btn-xs"><i class="mdi mdi-note-plus"></i></a>
                                </th>
                            </tr>
                            @empty
                            
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="detailList" tabindex="-1" aria-labelledby="detailListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailListLabel"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3" id="claveListaNew">
    
                    </div>
                    <div class="mb-3">
                        <label for="search" class="form-label">Buscar estudio</label>
                        <select class="js-example-basic-multiple form-select" name="searchEstudio" id="searchEstudio" data-width="100%">
                        </select>
                    </div>
                    <div class="mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Clave</td>
                                    <td>Descripcion</td>
                                    <td>costo</td>
                                </tr>
                            </thead>
                            <tbody id='listPreciosAnalitos'>

                            </tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <button onclick='saveAnalitos()' type="button" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">
                            <table id="listPreciosEstudios" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Clave</th>
                                        <th>Descripcion</th>
                                        <th>Costo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('public/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('public/assets/plugins/datatables-net-bs5/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('public/stevlab/catalogo/precios/form-validation.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/precios/functions.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/precios/data-table.js') }}"></script>
<script src="{{ asset('public/stevlab/catalogo/precios/select2.js') }}"></script>

@endpush