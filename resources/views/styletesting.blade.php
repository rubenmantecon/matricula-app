<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="shortcut icon" type="image/png" href="{{ asset('/img/icon.png') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/scripts.js') }}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Loooreeem Ipsuuuuum</title>
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
	<nav>
		<a href="#">Home</a>
		<a href="#">About</a>
		<a href="#">Clients</a>
		<a href="#">Contact Us</a>
	</nav>
	<h1>Testing of classless styling</h1>

	<div class="theme-switcher">
		<label class="theme-switcher__switch" for="checkbox">
			<input type="checkbox" id="checkbox" />
			<div class="theme-switcher__slider"></div>
		</label>
	</div>

	<h2>Kitchen Sink</h2>
	<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

	<h2>Header Level 2</h2>

	<ol>
		<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
		<li>Aliquam tincidunt mauris eu risus.</li>
	</ol>

	<blockquote>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p>
	</blockquote>

	<h3>Header Level 3</h3>

	<ul>
		<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
		<li>Aliquam tincidunt mauris eu risus.</li>
	</ul>

	<pre><code>
#header h1 a {
  display: block;
  width: 300px;
  height: 80px;
}
</code></pre>
	<h2>Form</h2>
	<form action="#" method="post">
		<div>
			<label for="name">Text Input:</label>
			<input type="text" name="name" id="name" value="" tabindex="1" />
		</div>

		<div>
			<h4>Radio Button Choice</h4>

			<label for="radio-choice-1">Choice 1</label>
			<input type="radio" name="radio-choice-1" id="radio-choice-1" tabindex="2" value="choice-1" />

			<label for="radio-choice-2">Choice 2</label>
			<input type="radio" name="radio-choice-2" id="radio-choice-2" tabindex="3" value="choice-2" />
		</div>

		<div>
			<label for="select-choice">Select Dropdown Choice:</label>
			<select name="select-choice" id="select-choice">
				<option value="Choice 1">Choice 1</option>
				<option value="Choice 2">Choice 2</option>
				<option value="Choice 3">Choice 3</option>
			</select>
		</div>

		<div>
			<label for="textarea">Textarea:</label>
			<textarea cols="44" rows="8" name="textarea" id="textarea"></textarea>
		</div>

		<div>
			<label for="checkbox">Checkbox:</label>
			<input type="checkbox" name="checkbox" id="checkbox" />
		</div>

		<div>
			<input type="submit" value="Submit" />
		</div>
	</form>
	<hr>
	<h1>Experimentation with Blade's capabilities and options</h1>
	<p>Here below, I'm <code>including</code> a Laravel Blade component via the <code>include</code>directive (not working much, for now)</p>

	<table>
		<thead>
			<th></th>
			<th>Nom</th>
			<th>Codi</th>
			<th>Descripció</th>
		</thead>
		<tbody>
			<script>
				//TODO: Abstract this into a refresh view function
				(async function() {
					let response = await ajaxCall('/api/test', 'POST', data = {action: 'Say Hi'});
					console.log(response)
				})();
			</script>
		</tbody>
		<tfoot>
		</tfoot>
	</table>
	<button id="createCareer" class="create">Afegeix un curs</button>
	<button class="getTest">Test GET</button>
	<button class="postTest">Test POST</button>
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
		<label class="hidden" for="submitButton">
			<button name="submitButton" class="material-icons upload-form__submit-button">file_upload</button>
		</label>
	</div>

</body>
<script>
	const toggleSwitch = document.querySelector('.theme-switcher__switch input[type="checkbox"]');
	
	function switchTheme(e) {
		if (e.target.checked) {
			document.documentElement.setAttribute('data-theme', 'dark');
		} else {
			document.documentElement.setAttribute('data-theme', 'light');
		}
	}

	toggleSwitch.addEventListener('change', switchTheme, false);

	/* Table buttons functionality */
	//Edit button
	$(document.body).on('click', '.edit', function() {
		$(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'true');
		$(this).siblings().removeClass('hidden');
	});

	//Cancel button
	$(document.body).on('click', '.cancel', function() {
		$(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
		$(this).siblings(':not(.edit)').addClass('hidden')
		$(this).addClass('hidden');
	});

	//Save changes button
	$(document.body).on('click', '.update', function() {
		$(this).parent().siblings('td[contenteditable]').prop('contenteditable', 'false');
		$(this).siblings(':not(.edit)').addClass('hidden')
		$(this).addClass('hidden');
		(async function() {
			let response = await ajaxCall('/api/test', 'POST');
			spawnRows(response);
		})();
	})

	//Delete row button
	$(document.body).on('click', '.delete', async function() {
		//Alert, pidiendo confirmación de borrado con botón
		let userDecision = confirm('Pero tú ya sabes lo que haces?')
		if (userDecision == true) {
			/* TODO: Lo que tiene que pasar:
			POST a un endpoint que recibe el nombre de la columna y el id
			El endpoint me devuelve una nueva vista (estando en la misma ruta aún): una página en blanco con un modal que me pida confirmación del texto de la columna previamente enviado por POST. Se guarda el id para posterior delete (?). Una vez introducido el nombre, desde ese modal se hace un HTTP DELETE al mismo endpoint, usando el id. Se redirige al mismo endpoint, por GET.
			*/
			/* let careerName = $(this).parent().parent().children().eq(1).text();
			let showModal = await ajaxCall('styletest', 'POST', {data: careerName})
			
			let userConfirmation = prompt('Introcuce el nombre del curso');

			if (userConfirmation == careerName) {
				var id = $(this).parent().parent().attr('id');
				ajaxPOST('/api/test');

			} */
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

</html>