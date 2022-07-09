@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="{{route('dashboard')}}" class="sidebar-brand">
      Stev<span>Lab</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Menú</li>
      {{-- <li class="nav-item {{ active_class(['/dashboard']) }}"> --}}
      <li class="nav-item ">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="activity"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        {{-- <a class="nav-link" data-bs-toggle="collapse" href="#advanced-ui" role="button" aria-expanded="{{ is_active_route(['advanced-ui/*']) }}" aria-controls="advanced-ui"> --}}
          <a class="nav-link" data-bs-toggle="collapse" href="#recepcion-menu" role="button" aria-expanded="" aria-controls="advanced-ui">
            <i class="link-icon" data-feather="clipboard"></i>
            <span class="link-title">Recepcion</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
        {{-- <div class="collapse {{ show_class(['advanced-ui/*']) }}" id="advanced-ui"> --}}
          <div class="collapse " id="recepcion-menu">
            <ul class="nav sub-menu">
              <li class="nav-item">
                {{-- <a href="{{ url('/advanced-ui/cropper') }}" class="nav-link {{ active_class(['advanced-ui/cropper']) }}">Cropper</a> --}}
                <a href="{{route('recepcion.index')}}" class="nav-link">Nuevo</a>
              </li>
              <li class="nav-item">
                {{-- <a href="{{ url('/advanced-ui/cropper') }}" class="nav-link {{ active_class(['advanced-ui/cropper']) }}">Cropper</a> --}}
                <a href="{{route('recepcion.captura')}}" class="nav-link">Captura de resultados</a>
              </li>
            </ul>
          </div>
      </li>
      <li class="nav-item">
        <a href="{{route('caja.index')}}" class="nav-link">
          <i class="link-icon" data-feather="server"></i>
          <span class="link-title">Caja</span>
        </a>
      </li>
      {{-- <li class="nav-item {{ active_class(['advanced-ui/*']) }}"> --}}
      <li class="nav-item">
        {{-- <a class="nav-link" data-bs-toggle="collapse" href="#advanced-ui" role="button" aria-expanded="{{ is_active_route(['advanced-ui/*']) }}" aria-controls="advanced-ui"> --}}
        <a class="nav-link" data-bs-toggle="collapse" href="#advanced-ui" role="button" aria-expanded="" aria-controls="advanced-ui">
          <i class="link-icon" data-feather="book-open"></i>
          <span class="link-title">Catálogo</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        {{-- <div class="collapse {{ show_class(['advanced-ui/*']) }}" id="advanced-ui"> --}}
        <div class="collapse " id="advanced-ui">
          <ul class="nav sub-menu">
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/cropper') }}" class="nav-link {{ active_class(['advanced-ui/cropper']) }}">Cropper</a> --}}
              <a href="{{route('catalogo.estudios')}}" class="nav-link">Estudios</a>
            </li>
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/owl-carousel') }}" class="nav-link {{ active_class(['advanced-ui/owl-carousel']) }}">Owl Carousel</a> --}}
              <a href="{{route('catalogo.areas')}}" class="nav-link ">Áreas de estudio</a>
            </li>
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/sortablejs') }}" class="nav-link {{ active_class(['advanced-ui/sortablejs']) }}">SortableJs</a> --}}
              <a href="{{route('catalogo.analitos')}}" disabled class="nav-link ">Analitos</a>
            </li>
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/sweet-alert') }}" class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweet Alert</a> --}}
              <a href="#" disabled class="nav-link">Perfiles</a>
            </li>
            
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/sweet-alert') }}" class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweet Alert</a> --}}
              <a href="{{route('catalogo.pacientes')}}" class="nav-link">Pacientes</a>
            </li>
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/sweet-alert') }}" class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweet Alert</a> --}}
              <a href="{{route('catalogo.precios')}}" class="nav-link">Lista de precios</a>
            </li>
            <li class="nav-item">
              {{-- <a href="{{ url('/advanced-ui/sweet-alert') }}" class="nav-link {{ active_class(['advanced-ui/sweet-alert']) }}">Sweet Alert</a> --}}
              <a href="{{route('catalogo.doctores')}}" class="nav-link">Doctores</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</nav>
