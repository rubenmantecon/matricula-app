<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/water.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Alumnes</title>
    <script type="text/javascript">
    	$(document).ready(function(){
        $(document.body).on('click','#importB',function(e){
            getSelected(e);
        });
    	})
        function getSelected(){
        	var data={result:[]};
        	var tdData;
        	var name,email;
        	$('input:checkbox:checked').each(function(){
        		name=$(this).parent().next().text();
                email=$(this).parent().next().next().text();
        		
        		tdData={name:name,email:email};
        		data.result.push(tdData);
        	});
        	console.log(email);
        	loadData(importSucces,data);
        }
        function loadData(actionFunc,data){
        
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/admin/dashboard/alumnes/import',
            data:data,
            
        }).done(
            function(data){actionFunc(data)}
        ).fail(
            function(jqXHR,textStatus, errorThrown){
                    deleteMSG();
                    messages('error', "No s'ha importat correctament, potser que un usuari estigui a la base de dades");
                    errorFunction(textStatus,errorThrown);
                }
        )
   		 };
   		function importSucces(data){
            deleteMSG();
            messages('success', "Import dels cicles completat amb exit, en uns instants seras redirigit");
   			setTimeout(function() {window.location.replace('/admin/dashboard/alumnes');
          }, 2500);
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
        <h1 id="up">ALUMNES A IMPORTAR</h1>
        <div class="flex mb-5">
            <div class="flex-1" id="breadcrumb"> <!-- fil d'ariadna -->
                <a href="/">Inici</a> / <a href="/dashboard">Panell de control</a> / <a href="/admin/dashboard/alumnes">Alumnes</a> / <a><b>Importar</b></a>
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
        	<tbody>
	        <?php
		        $count=0;
		       	
		        foreach ($_POST as $alumnes => $alumne) {
		        	echo "<tr>";
		        	if ($count!=0) {
		        		echo "<td><input type='checkbox'></td>";
		        		$alumne=json_decode($alumne,true);
                        $name=$alumne["name"];
		        		$email=$alumne["email"];
		        		echo "<td>".$name. "</td>";
                        echo "<td>".$email. "</td>";   
	
		        	}
		        	echo "</tr>";
		        	$count ++;
		        	
		        }
	         ?>
	   		</tbody>
        </table>
       	<button  id="importB" onclick="window.location.href='#up'">Importar seleccionats</button> 
        
        
         
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>