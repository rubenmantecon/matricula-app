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
    <title>Cursos</title>
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
        <H1>CURSOS</H1>
        <div id="breadcrumb"> <!-- fil d'ariadna -->
            <a href="/">Inici</a> / <a href="/dashboard">Panell de control</a> / <a><b>Cursos</b></a>
        </div>
        <div id="messages"></div>
        <table>
        <thead>
            <th></th>
            <th>Nom</th>
            <th>Codi</th>
            <th>Descripció</th>
        </thead>
        <tbody>
            
            @foreach ($careers as $career)
            <tr id=<?php echo $career->id;  ?>>
                <td><input type="checkbox"></td>
                <td id="name" contenteditable="false">{{ $career->name }}</td>
                <td contenteditable="false">{{$career->code}}</td>
                <td contenteditable="false">{{$career->description}}</td>
                <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                <td><button class="delete bg-red-400">Borra</button></td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
        </tfoot>
        
    </table>
    <tr id="createCareer">
                <button class="create">Afegeix un curs</button>
        </tr>
</body>
<script>
    var pulse = 0;
    var edit = 0;
    $(document.body).on('click','.edit',function() {
        deleteMSG()
        messages('info', "Estas editant un curs ");
        if ( edit == 0 ) {
            $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'true');
            $(this).siblings().removeClass('hidden')
            
            if (pulse == 0) {
                var name = $(this).parent().parent().children('#name').text();
                $('#breadcrumb').append( " <a id='added'>- <b>" + name + "</b></a>" );
            }
            pulse = 1;
            edit = 1;
        }
    });

    $(document.body).on('click','.create',function(){
        deleteMSG()
        messages('info', "Estas creant un curs nou");
        if($('#createRow').length){

        }else{
            $('tbody').append(`<tr id="createRow">
                            <td><input type="checkbox"></td>
                            <td  contenteditable="true">Nom</td>
                            <td contenteditable="true">Codi</td>
                            <td contenteditable="true">Descripcio</td>
                            <td><button class="saveCreate">Guarda</button></td>
                            <td><button class="cancelCreate">Cancela</button></td>
                        </tr>`)
        }
        
    });
    $(document.body).on('click','.cancelCreate',function(){
        deleteMSG()
        messages('warning', "S'ha cancelat la creació del curs ");
        $('#createRow').remove()
        $('#added').remove();
        pulse = 0;
        edit = 0;
    });
    $(document.body).on('click','.saveCreate',function(){
        deleteMSG()
        messages('success', "S'ha guardat el curs nou");
        $('#added').remove();
        pulse = 0;
        edit = 0;
        var name_career=$("#createRow>td").eq(1).text();
        var code_career=$("#createRow>td").eq(2).text();
        var description_career=$("#createRow>td").eq(3).text();
        console.log();
        $.post('/api/admin/dashboard/cursos', {
            action: 'create',
            result:[{name:name_career},{code:code_career},{description:description_career}] 
        });
        $('tbody').empty();
        $.getJSON('/api/admin/dashboard/cursos').done(response => {
            for (const jsonObject in response) {
                $('tbody').append(`
                        <tr id="${response[jsonObject]['id']}">
                            <td><input type="checkbox"></td>
                            <td id="name" contenteditable="false">${response[jsonObject]['name']}</td>
                            <td contenteditable="false">${response[jsonObject]['code']}</td>
                            <td contenteditable="false">${response[jsonObject]['description']}</td>
                            <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                        <td><button class="delete bg-red-400">Borra</button></td>
                        </tr>`)
            }
        });
    })

    $(document.body).on('click','.cancel',function() {
        deleteMSG();
        messages('warning', "No s'han guardat els canvis que s'estaven modificant");
        $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
        $(this).siblings(':not(.edit)').addClass('hidden')
        $(this).addClass('hidden');
        $('#added').remove();
        pulse = 0;
        edit = 0;
    });
    $(document.body).on('click','.update',function() {
        $('#added').remove();
        pulse = 0;
        edit = 0;
        $(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
        $(this).siblings(':not(.edit)').addClass('hidden')
        $(this).addClass('hidden');
        var id_career = $(this).parent().parent().attr('id');
        var name_career=$('#'+id_career +">td").eq(1).text();
        var code_career=$('#'+id_career +">td").eq(2).text();
        var description_career=$('#'+id_career +">td").eq(3).text();

        $.post('/api/admin/dashboard/cursos', {
            action: 'update',
            result:[{id:id_career},{name:name_career},{code:code_career},{description:description_career}] 
        });
        $('tbody').empty();
        $.getJSON('/api/admin/dashboard/cursos').done(response => {
            for (const jsonObject in response) {
                $('tbody').append(`
                        <tr id="${response[jsonObject]['id']}">
                            <td><input type="checkbox"></td>
                            <td id="name" contenteditable="false">${response[jsonObject]['name']}</td>
                            <td contenteditable="false">${response[jsonObject]['code']}</td>
                            <td contenteditable="false">${response[jsonObject]['description']}</td>
                            <td><button class="edit">Edita</button><button class="hidden cancel">Cancela</button><button class="hidden update">Guarda</button></td>
                        <td><button class="delete bg-red-400">Borra</button></td>
                        </tr>`)
            }
        });
        deleteMSG();
        messages('success', "S'han guardat els canvis correctament");
    })
    
    $(document.body).on('click','.delete',function() {
        var id_career = $(this).parent().parent().attr('id');
        var name_career=$('#'+id_career +">td").eq(1).text();
            //Send id via POST to trigger deletion
            $.post('/api/admin/dashboard/cursos', {
                action: 'delete',
                result: [{id:id_career},{name:name_career}]
            }).done(function(response) {
                    window.location.replace(response);
                
            });
        pulse = 0;
        edit = 0;
        deleteMSG();
        messages('success', "S'ha eliminat el curs correctament");
    });

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
</script>
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>