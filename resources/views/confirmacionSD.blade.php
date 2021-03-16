<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/water.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Cursos</title>
</head>
<script type="text/javascript">
    $(document).ready(function(){
        $(document.body).on('click','#deleteRegister > button',function(e){
            comprobarSD(e);
        });
        $('#deleteRegister > input').click(removeIncorrectChanges);
    });
    function comprobarSD(event){
        event.preventDefault();
        var careerName=$('#deleteRegister > input').attr("data-name");
        var careerInput=$('#deleteRegister > input').val();
        if (careerName==careerInput) {
            correctName();
        }else{
            incorrectName();
        }
    }
    function incorrectName(){
        deleteMSG();
        messages('error', 'Los nombres no coinciden')
    }
    function removeIncorrectChanges(){
        $('#deleteRegister > input').removeClass('error');
    }
    
    function correctName(){
        var url;
        var delete_id=$('#deleteRegister > input').attr('id');
        var page=$('#deleteRegister').data('register');
        if (page=='cursos') {
            url='/api/admin/dashboard/cursos/confirmacionSD';
        }else if (page=='cicles'){
            url='/api/admin/dashboard/cicles/confirmacionSD';
        }
        console.log(delete_id);
        data={id:delete_id};
        loadData(softDeleteDone,data,url)
    }
    function loadData(actionFunc,data,url){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url: url,
            data: data,
            
        }).done(
            function(response){actionFunc(data)}
        ).fail(
            function(jqXHR,textStatus, errorThrown){
                    
                    errorFunction(textStatus,errorThrown);
                }
        )
    };
    function softDeleteDone(data){
        deleteMSG();
        messages('success', "Curs eliminat correctament, en uns segons serà redirigit a la pagina de cursos")
        setTimeout(function() {
            var url;
            var page=$('#deleteRegister').data('register');
            if (page=='cursos') {
                url='/admin/dashboard/cursos';
            }else if (page=='cicles'){
                url='/admin/dashboard/cicles';
            }
            
            window.location.replace(url);
          }, 1000);
    }
    function errorFunction(text, error){
        deleteMSG();
        messages('error', "No ha sigut possible eliminar el curs ["+text+" "+error+"]")
    }

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
        <H1>CONFIRMACIÓ D'ESBORRAR</H1>
        <div id="messages"></div>
        <form id="deleteRegister" data-register="<?php echo $_GET['page']; ?>" >
            <label>El registre <b> <?php echo $_GET['name'];  ?> </b>serà <b>eliminat</b>, per a procedir torna a escriure el nom : </label>
            <br>
            <input id="<?php echo $_GET['id']; ?>" data-name="<?php echo $_GET['name'];  ?>" type="text" name="career">
            <button>Eliminar</button>
        </form>
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>