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
        $(document.body).on('click','#deleteCareer > button',function(e){
            comprobarSD(e);
        });
        $('#deleteCareer > input').click(removeIncorrectChanges);
    });
    function comprobarSD(event){
        event.preventDefault();
        var careerName=$('#deleteCareer > input').attr("data-name");
        var careerInput=$('#deleteCareer > input').val();
        if (careerName==careerInput) {
            correctName();
        }else{
            incorrectName();
        }
    }
    function incorrectName(){
        $('#deleteCareer > input').addClass('error');
        $('<label class="errorMSG" id="error-MSG">Los nombre no coinciden</label>').insertBefore('#deleteCareer > input');
    }
    function removeIncorrectChanges(){
        $('#deleteCareer > input').removeClass('error');
        $('#error-MSG').remove();

    }
    function correctName(){
        var delete_id=$('#deleteCareer > input').attr('id');
        console.log(delete_id);
        data={id:delete_id};
        loadData(softDeleteDone,data)
    }
    function loadData(actionFunc,data){
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/api/admin/dashboard/cursos/confirmacionSD',
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
        alert("Curs eliminat correctament, en uns segons serà redirigit a la pagina de cursos");
        setTimeout(function() {
            
            window.location.replace('/admin/dashboard/cursos');
          }, 1000);
    }
    function errorFunction(text, error){
        alert("No ha sigut possible eliminar el curs ["+text+" "+error+"]");

    }

</script>
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
        
        <form id="deleteCareer" >
            <label>El curs <b> <?php echo $_GET['name'];  ?> </b>serà <b>eliminat</b>, per a procedir torna a escriure el nom : </label>
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