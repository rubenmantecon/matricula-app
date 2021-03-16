<!DOCTYPE html>
<html>
<head>
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
    <title>Cursos</title>
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
        	console.log(data);
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
                    
                    errorFunction(textStatus,errorThrown);
                }
        )
   		 };
   		function importSucces(data){
   			alert("Import dels alumnes completat amb exit, en uns instants seras redirigit");
   			setTimeout(function() {window.location.replace('/admin/dashboard/alumnes');
          }, 1000);
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
    	<table>
    		<thead>
				<th>alumnes a importar</th>	            
        	</thead>
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
       	<button id="importB">Importar seleccionats</button> 
        
        
         
    </main>
    <footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
</body>
</html>