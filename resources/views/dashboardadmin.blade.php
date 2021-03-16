<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<script src="{{ asset('js/app.js') }}"></script>
	<link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
	<script defer src="{{ asset('js/day_night.js') }}"></script>
	<title>Panell de control</title>
</head>

<body>
	<header>
		<div class="flex">
			<!-- LOG OUT -->
			<div class="flex-1">
				<img width="75px" src="{{ asset('/img/icon.png') }}">
			</div>
			<div class="flex-2">
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
					Tanca sessió
				</a>
				<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</header>
	<main>
		<H1>PANELL DE CONTROL</H1>
		<div class="flex">
			<div class="flex-1" id="breadcrumb">
				<!-- fil d'ariadna -->
				<a href="/">Inici</a> / <a href="/dashboard"><b>Panell de control</b></a>
			</div>
			<div class="theme-switcher-wrapper flex-2">
				<div class="theme-switcher">
					<label class="theme-switcher__switch" for="checkbox">
						<input type="checkbox" id="checkbox" />
						<div class="theme-switcher__slider"></div>
					</label>
				</div>
			</div>
		</div>
		<div class="mt-8">
			<a href="/admin/dashboard/cursos">
				<button>CURSOS</button>
			</a>
			<a href="/admin/dashboard/alumnes">
				<button>ALUMNES</button>
			</a>
			<a href="/admin/dashboard/cicles">
				<button>CICLES</button>
			</a>
		</div>
	</main>
	<footer class="flex items-center text-center">
		<div class="full">
			<p>© IES Esteve Terradas i Illa</p>
		</div>
	</footer>
</body>

</html>