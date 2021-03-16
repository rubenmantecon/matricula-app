<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<script src="{{ asset('js/app.js') }}"></script>
	<link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
	<title>Matricula-app</title>
</head>

<body>
	<header>
	</header>
	<main class="flex items-center text-center">
		<div class="center full">
			<div class="center">
				<h1>IES ESTEVE TERRADAS I ILLA</h1>
			</div>
			<div class="mt-10">
				<h3>Benvinguts a la plataforma per fer la matriculació del centre INS Esteve Terradas i Illa.</h3>
				<img src="{{ asset('/img/icon.png') }}">
			</div>
			<div class="mt-10">
				<a href="login" accesskey="i"><button><u>I</u>nicia sessió</button></a>
				<a href="" accesskey="r"><button>Deshabilitat</button></a>
			</div>
		</div>
	</main>
	<footer class="flex items-center text-center">
		<div class="full">
			<p>© IES Esteve Terradas i Illa</p>
		</div>
	</footer>
</body>

</html>