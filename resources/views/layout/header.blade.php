<nav class="navbar">
	<a href="#" class="sidebar-toggler">
		<i data-feather="menu"></i>
	</a>
	<div class="navbar-content">
		<form class="search-form">
			<div class="input-group">
				<div class="input-group-text">
					<i data-feather="search"></i>
				</div>
				<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
			</div>
		</form>
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="mdi mdi-reload mt-1" title="Sucursal actual"></i> <span class="ms-1 me-1 d-none d-md-inline-block">{{$active->sucursal}}</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="languageDropdown">
					@foreach ($sucursales as $sucursal)
					<a href="javascript:;" class="dropdown-item py-2"><i class="mdi mdi-medical-bag" title="Sucursal" ></i> <span class="ms-1"> {{$sucursal->sucursal}} </span></a>
					@endforeach
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i data-feather="bell"></i>
					{{-- Indicador notificación --}}
					<div class="indicator">
						<div class="circle"></div>
					</div>
					{{-- Indicador fin notificación --}}
				</a>
				<div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
					<div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
						<p>6 New Notifications</p>
						<a href="javascript:;" class="text-muted">Clear all</a>
					</div>
					<div class="p-1">
						<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
							<div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
								<i class="icon-sm text-white" data-feather="gift"></i>
							</div>
							<div class="flex-grow-1 me-2">
								<p>New Order Recieved</p>
								<p class="tx-12 text-muted">30 min ago</p>
							</div>	
						</a>
						<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
							<div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
								<i class="icon-sm text-white" data-feather="alert-circle"></i>
							</div>
							<div class="flex-grow-1 me-2">
								<p>Server Limit Reached!</p>
								<p class="tx-12 text-muted">1 hrs ago</p>
							</div>	
						</a>
						<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
							<div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
								<img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="userr">
							</div>
							<div class="flex-grow-1 me-2">
								<p>New customer registered</p>
								<p class="tx-12 text-muted">2 sec ago</p>
							</div>	
						</a>
						<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
							<div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
								<i class="icon-sm text-white" data-feather="layers"></i>
							</div>
							<div class="flex-grow-1 me-2">
								<p>Apps are ready for update</p>
								<p class="tx-12 text-muted">5 hrs ago</p>
							</div>	
						</a>
						<a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
							<div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
								<i class="icon-sm text-white" data-feather="download"></i>
							</div>
							<div class="flex-grow-1 me-2">
								<p>Download completed</p>
								<p class="tx-12 text-muted">6 hrs ago</p>
							</div>	
						</a>
					</div>
					<div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
						<a href="javascript:;">View all</a>
					</div>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="wd-30 ht-30 rounded-circle" src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
				</a>
				<div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
					<div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
						<div class="mb-3">
							<img class="wd-80 ht-80 rounded-circle" src="{{ url('https://via.placeholder.com/80x80') }}" alt="">
						</div>
						<div class="text-center">
							<p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
							<p class="tx-12 text-muted">{{Auth::user()->email}}</p>
						</div>
					</div>
					<ul class="list-unstyled p-1">
						<li class="dropdown-item py-2">
							<a href="{{route('profile.show')}}" class="text-body ms-0">
								<i class="me-2 icon-md" data-feather="user"></i>
								<span>Perfil</span>
							</a>
						</li>
						<li class="dropdown-item py-2">
							<a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-body ms-0">
								<i class="me-2 icon-md" data-feather="log-out"></i>
								<span>Log Out</span>
							</a>
							<form method="POST" id="logout-form" action="{{ route('logout') }}">
								@csrf
							</form>
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</nav>