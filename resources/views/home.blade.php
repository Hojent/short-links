<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel - get Short Link</title>
		<!-- Styles -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		
    </head>
    <body class="antialiased">
		<div class="container">
			<h2>Генератор коротких ссылок</h2>
			<form class="form">
				@csrf
				<div class="form-group">
					<label for="url-send">Ссылка</label>
					<input type="text" class="form-control" id="url-send" aria-describedby="urlHelp" placeholder="Введите ссылку" name="url-send">
					<small id="urlHelp" class="form-text text-muted">Введите ссылку вида https://...</small>
				</div>
				<button type="button" id="btn" class="btn btn-primary">Submit</button>
			</form>
			<br>
			<div id="links">
				@foreach($recentLinks as $link)
					<p>{{$link['source_url']}} : {{$link['short_url']}}</p>
				@endforeach
			</div>
		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="{{asset('assets/js/function.js')}}"></script>
    </body>
</html>
