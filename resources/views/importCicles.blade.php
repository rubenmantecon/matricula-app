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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/water.css') }}">
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
        	var name,code,desc,iniDate,endDate;
        	$('input:checkbox:checked').each(function(){
        		name=$(this).parent().next().text();
        		code=$(this).parent().next().data("code");
        		desc=$(this).parent().next().data("desc");
        		iniDate=$(this).parent().next().data("ini");
        		endDate=$(this).parent().next().data("end");
        		tdData={name:name,code:code,desc:desc,iniDate:iniDate,endDate:endDate};
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
            url:'/admin/dashboard/cicles/import',
            //data: JSON.stringify(data),
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
   			alert("Import dels cicles completat amb exit, en uns instants seras redirigit");
   			setTimeout(function() {//window.location.replace('/admin/dashboard/cicles');
          }, 3000);
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
				<th>Cicles a importar</th>	            
        	</thead>
        	<tbody>
	        <?php
		        $count=0;
		       	

		        foreach ($_POST as $terms => $term) {
		        	echo "<tr>";
		        	if ($count!=0) {
		        		echo "<td><input type='checkbox'></td>";
		        		$term=json_decode($term,true);
		        		$code=$term["code"];

		        		echo "<td data-code='".$code."' data-desc='".$term["desc"]."' data-ini='".$term["iniDate"]."' data-end='".$term["endDate"]."'>".$term["name"]. "</td>";	

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