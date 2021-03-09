<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/water.css') }}">
	<script src="{{ asset('js/app.js') }}"></script>
	<title>Loooreeem Ipsuuuuum </title>
</head>

<body>
	<header>
		<nav>
			<a href="#">Home</a>
			<a href="#">About</a>
			<a href="#">Clients</a>
			<a href="#">Contact Us</a>
		</nav>
	</header>
	<main>

		<h1>Testing of classless styling</h1>
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
				<th>Nom</th>
				<th>Correu electrònic</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{$user->email}}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot></tfoot>
		</table>
	</main>
	<footer class="flex items-center text-center">
        <div class="full">
            <p>© IES Esteve Terradas i Illa</p>
        </div>
    </footer>
	<script>
		//Make any table editable
		$('table').editableTableWidget();
		//Beware! CORS must be configured at the web server engine level for AJAX to work
		//Below is a simple jQuery AJAX call to prove it works
		$('table td').change(function(event, value) {
			$.ajax({
				type: 'GET',
				url: `https://www.pokeapi.co/api/v2/pokemon/${value}`,
				})
				.done(function(data) {
					//Do something with the response
				})
		});
	</script>
	
</body>

</html>