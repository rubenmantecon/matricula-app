<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
	<script src="{{ asset('js/app.js') }}"></script>
    <title>Alumnes</title>
</head>
<body>
    <header>
        <div class="flex"> <!-- LOG OUT -->
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
        <H1>ALUMNES</H1>
        <div> <!-- fil d'ariadna -->
            <a href="/">Inici</a> / <a href="/dashboard">Panell de control</a> / <a href=""><b>Alumnes</b></a>
        </div>
        <div id="messages"></div>
        <table>
            <tr>   
                <th>Nom</th>
                <th>Correu electrònic</th>
            </tr>
            @foreach ($alumnes as $alumne)
                <tr>   
                    @if ($alumne->role == "user")
                    <td>{{$alumne->name}}</td>
                    <td>{{$alumne->email}}</td>
                    @endif
                </tr>
            @endforeach
        </table>
        <div class="">
            {!! $alumnes->links() !!}
        </div>
        <!-- Brief explanation of this whole bunch of buttons -->
        <!-- Input buttons are really hard to style. So we put the input buttons, hide them, and show some easily stylable buttons. These buttons receive clicks, and when receiving them, through jQuery, simulate a click on the inputs. -->
        <div class="upload-form">
            <label for="upload" class="hidden">
                <input type="file" name="upload" id="fileUpload">
            </label>
            <label class="hidden" for="fileSubmit">
                <input type="submit" value="fileSubmit">
            </label>
            <label for="uploadButton">
                <button name="uploadButton" class="material-icons upload-form__upload-button">file_upload</button>
            </label>
        </div>
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
<script>
    /* Upload process' buttons functionality */
	//Upload file button
	$(document.body).on('click', '.upload-form__upload-button', function() {
		$('#fileUpload').click();
	});

    var page = getUrlParameter('page');
    var totalPages = {{ $alumnes->lastPage() }};
    if (page > totalPages) {
        window.onload = messages('error', 'No se están mostrando estudiantes, vuelva a la pagina correcta');
    }
    window.onload = messages('info', 'Página '+ page + ' mostrant 20 estudiants');
    function messages(code, message) {
        var structure = $("#messages");
        if ($('#messages').children().length == 0) {
            if (code == "success") {
                structure.addClass("mt-5 mb-5 success");
                structure.append("<p><b>ÉXIT! | " + message + "</b></p>")
            } else if (code == "error") {
                structure.addClass("mt-5 mb-5 errorMSG");
                structure.append("<p><b>ERROR! | " + message + "</b></p>")
            } else if (code == "info") {
                structure.addClass("mt-5 mb-5 info");
                structure.append("<p><b>INFO! | " + message + "</b></p>")
            } else if (code == "warning") {
                structure.addClass("mt-5 mb-5 warning");
                structure.append("<p><b>ADVERTÈNCIA! | " + message + "</b></p>")
            }
        }
    }

    function deleteMSG() {
        $("#messages").children().remove();
        $("#messages").removeClass();
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

</script>
</html>