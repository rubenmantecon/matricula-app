<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

	<link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<script defer src="{{ asset('js/day_night.js') }}"></script>
	<title>Alumnes</title>
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
		<H1>ALUMNES</H1>
		<div class="flex">
			<div class="flex-1" id="breadcrumb">
				<!-- fil d'ariadna -->
				<a href="/">Inici</a> / <a href="/dashboard">Panell de control</a> / <a href=""><b>Alumnes</b></a>
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
            <form>
                <label for="upload" class="hidden">
                    <input type="file" name="upload" id="fileUpload">
                </label>
                <label class="hidden" for="fileSubmit">
                    <input type="submit" value="fileSubmit">
                </label>
            </form>
            <label for="uploadButton">
                <button name="uploadButton" class="material-icons upload-form__upload-button">file_upload</button>
            </label>
        </div>
        <form style="display:none" method="POST" id="hiddenForm" action="{{route('importAlumnes')}}">
            @csrf
        </form>
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

    //Detecting when the file is uploaded so we can do the request
    $(document.body).on('change','#fileUpload',function(){
        $('#fileSubmit').trigger('click');
        loadData(importDone);

    })
  
    function loadData(actionFunc){
        var formData= new FormData();
        formData.append('file',$("input[type=file]")[0].files[0]);
        console.log(formData);

        //var formData= new FormData(document.getElementById("file"));
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/admin/dashboard/alumnes',
            //data: JSON.stringify(data),
            data:formData,
            contentType:false,
            processData:false,
        }).done(
            function(data){actionFunc(data)}
        ).fail(
            function(jqXHR,textStatus, errorThrown){
                    
                    errorFunction(textStatus,errorThrown);
                }
        )
    };
    function importDone(data){
        var input;
        var value;
        if (data.length>0) {
            for (var i = 1; i < data.length; i++) {
                $('#hiddenForm').append('<input type="hidden" name="data'+i+'">');
                value=JSON.stringify(data[i]);
                $('input[name="data'+i+'"]').val(value);
               
            }
            $('#hiddenForm').submit();
        }
    }
    function errorFunction (jqXHR,textStatus,errorThrown){
        alert("Algo ha ido mal : "+ textStatus + errorThrown);
    };

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