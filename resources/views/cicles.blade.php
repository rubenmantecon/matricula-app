<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/water.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <title>Cicles</title>
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
        <H1>CICLES</H1>
        <div> <!-- fil d'ariadna -->
            <a href="/">Inici</a> / <a href="/dashboard">Panell de control</a> / <a href=""><b>Cicles</b></a>
        </div>
        <table>
        <thead>
            <th></th>
            <th>Data inici</th>
            <th>Data fi</th>
            <th>Nom</th>
            <th>Descripció</th>
        </thead>
        <tbody>
            @foreach ($terms as $term)
            <tr id=<?php echo $term->id;  ?>>
                <td><input type="checkbox"></td>
                <td contenteditable="false">{{ $term->start }}</td>
                <td contenteditable="false">{{$term->end}}</td>
                <td contenteditable="false">{{$term->name}}</td>
                <td contenteditable="false">{{$term->description}}</td>
                <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                <td><button class="delete bg-red-400">Borra</button></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
        
    </table>
    <tr id="createTerm">
        <button class="create">Afegeix un curs</button>
    </tr>
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
		<label class="hidden" for="submitButton">
			<button name="submitButton" class="material-icons upload-form__submit-button">file_upload</button>
		</label>
	</div>
</body>
<script>
    $(document.body).on('click','.edit',function() {
        $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'true');
        $(this).siblings().removeClass('hidden');
    });

    $(document.body).on('click','.create',function(){
        if($('#createRow').length){

        }else{
            $('tbody').append(`<tr id="createRow">
                            <td><input type="checkbox"></td>
                            <td contenteditable="true"><input /></td>
                            <td contenteditable="true">Data fi</td>
                            <td contenteditable="true">Nom</td>
                            <td contenteditable="true">Descripcio</td>
                            <td><button class="saveCreate">Guarda</button></td>
                            <td><button class="cancelCreate">Cancela</button></td>
                        </tr>`)
        }
    });

    $(document.body).on('click','.cancelCreate',function(){
        $('#createRow').remove()
    });
    
    $(document.body).on('click','.saveCreate',function(){
        var start_term=$("#createRow>td").eq(1).text();
        var end_term=$("#createRow>td").eq(2).text();
        var name_term=$("#createRow>td").eq(3).text();
        var description_term=$("#createRow>td").eq(4).text();
        console.log();
        $.post('/api/admin/dashboard/cicles', {
            action: 'create',
            result:[{start:start_term},{end:end_term},{name:name_term},{description:description_term}] 
        });
        $('tbody').empty();
        $.getJSON('/api/admin/dashboard/cicles').done(response => {
            for (const jsonObject in response) {
                $('tbody').append(`
                        <tr id="${response[jsonObject]['id']}">
                            <td><input type="checkbox"></td>
                            <td contenteditable="false">${response[jsonObject]['start']}</td>
                            <td contenteditable="false">${response[jsonObject]['end']}</td>
                            <td contenteditable="false">${response[jsonObject]['name']}</td>
                            <td contenteditable="false">${response[jsonObject]['description']}</td>
                            <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                        <td><button class="delete bg-red-400">Borra</button></td>
                        </tr>`)
            }
        });
    })

    $(document.body).on('click','.cancel',function() {
        $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
        $(this).siblings(':not(.edit)').addClass('hidden')
        $(this).addClass('hidden');
    });


    $(document.body).on('click','.update',function() {
        $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
        $(this).siblings(':not(.edit)').addClass('hidden')
        $(this).addClass('hidden');
        var id_term = $(this).parent().parent().attr('id');
        var start_term=$('#'+id_term +">td").eq(1).text();
        var end_term=$('#'+id_term +">td").eq(2).text();
        var name_term=$('#'+id_term +">td").eq(3).text();
        var description_term=$('#'+id_term +">td").eq(4).text();

        $.post('/api/admin/dashboard/cicles', {
            action: 'update',
                result:[{id:id_term},{start:start_term},{end:end_term},{name:name_term},{description:description_term}] 
        });
        $('tbody').empty();
        $.getJSON('/api/admin/dashboard/cicles').done(response => {
            for (const jsonObject in response) {
                $('tbody').append(`
                        <tr id="${response[jsonObject]['id']}">
                            <td><input type="checkbox"></td>
                            <td contenteditable="false">${response[jsonObject]['start']}</td>
                            <td contenteditable="false">${response[jsonObject]['end']}</td>
                            <td contenteditable="false">${response[jsonObject]['name']}</td>
                            <td contenteditable="false">${response[jsonObject]['description']}</td>
                            <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                            <td><button class="delete bg-red-400">Borra</button></td>
                        </tr>`)
            }
        });
    })
    
    $(document.body).on('click','.delete',function() {
        //Alert, pidiendo confirmación de borrado con botón
        let userDecision = confirm('Pero tú ya sabes lo que haces?')
        if (userDecision == true) {
            let userConfirmation = prompt('Introcuce el nombre del curso');

            if (userConfirmation == $(this).parent().parent().children().eq(3).text()) {
                var id = $(this).parent().parent().attr('id');

                //Send id via POST to trigger deletion
                $.post('/api/admin/dashboard/cicles', {
                    action: 'delete',
                    id: id
                });
                //Refresh view after deletion
                $('tbody').empty();
                $.getJSON('/api/admin/dashboard/cicles').done(response => {
                    for (const jsonObject in response) {
                        //Empty the whole tbody
                        //Repopulate tbody with data via GET
                        $('tbody').append(`
                        <tr id="${response[jsonObject]['id']}">
                            <td><input type="checkbox"></td>
                            <td contenteditable="false">${response[jsonObject]['start']}</td>
                            <td contenteditable="false">${response[jsonObject]['end']}</td>
                            <td contenteditable="false">${response[jsonObject]['name']}</td>
                            <td contenteditable="false">${response[jsonObject]['description']}</td>
                            <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                        <td><button class="delete bg-red-400">Borra</button></td>
                        </tr>`)
                    }
                });
            }
        }
    });

    /* Upload process' buttons functionality */
	//Upload file button
	$(document.body).on('click', '.upload-form__upload-button', function() {
		$('#fileUpload').click();
		$('label[for="submitButton"]').removeClass('hidden')
	});

	//Submit file button
	$(document.body).on('click', 'label[for="submitButton"]', function() {
		$('#fileSubmit').click();
		$('label[for="submitButton"]').addClass('hidden');
		/* TODO: Añadir comportamiento (redirects, controllers, ajax, etc) */
	});
</script>
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>