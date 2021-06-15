
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="{{url('/')}}">Coffeenesia</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>
		
		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				
				<li class="nav-item cta cta-colored"><a href="{{ url('/belanja') }}" class="nav-link">Shop</a></li> 
				<li class="nav-item cta cta-colored"><a href="{{ url('/cart') }}" class="nav-link"><span class="icon-shopping_cart"></span>2</a></li>
								
			</ul>
		</div>
		<div class="collapse navbar-collapse">
			<div class="col-md-6 d-flex align-items-center">

				<form action="#" class="subscribe-form">  	
					<div class="form-group d-flex">
						<input type="text" class="form-control" placeholder="cari produk">
						<input type="submit" value="Cari" class="submit px-3">
					</div>
				</form>
				
			</div>
			<ul class="navbar-nav ml-auto">
				
				@guest
				<li class="nav-item">
					<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
				@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
				@endif
				@else
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						{{ Auth::user()->name }} <span class="caret"></span>
					</a>
					
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
						</a>
					
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@if (Auth::user()->hasAnyRole('admin'))
					<li class="nav-item">
						<a class="nav-link" href="{{ route('users.index') }}">{{ __('Manage') }}</a>
					</li>
				@endif
			@endguest
		</ul>
		
	</div>
</div>
</nav>