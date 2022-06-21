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
      <li class="nav-item nav-category">Main</li>
      {{-- <li class="nav-item {{ active_class(['/dashboard']) }}"> --}}
      <li class="nav-item ">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="activity"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('caja.index')}}" class="nav-link">
          <i class="link-icon" data-feather="server"></i>
          <span class="link-title">Caja</span>
        </a>
      </li>
      
    </ul>
  </div>
</nav>
