@if ($error)
	<p>{{$error}}</p>
@endif
@foreach($recentLinks as $link)
	<p>{{$link['source_url']}} : http://site.ru/{{$link['short_url']}}</p>
@endforeach
