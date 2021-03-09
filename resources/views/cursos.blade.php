<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
	<script src="{{ asset('js/app.js') }}"></script>
    <title>Cursos</title>
</head>
<body>
    <header>
        <div class="flex flex-row-reverse"> <!-- LOG OUT -->
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                Tanca sessió
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </header>
    <main>
        <H1>CURSOS</H1>
        <div> <!-- fil d'ariadna -->
            <a href="/">Inici</a> / <a href="/dashboard">Panell de controll</a> / <a href=""><b>Cursos</b></a>
        </div>
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>