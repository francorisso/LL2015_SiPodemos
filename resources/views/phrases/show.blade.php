@extends("app")

@section("extra_headers")

<meta property="og:type" content="og:article" />
<meta property="og:title" content="Patricia dice..." />
<meta property="og:image" content="{{ url('phrases/create-image/'.$phrase->id) }}" />
<meta property="og:description" content="{{ preg_replace("/<br.?\/\>/", " ", $phrase->phrase) }}. {{ Config::get("globals.siteDescription") }}" />

@stop

@section("content")
<div class="container">
	<div class="jumbotron">
		<h1>¿Que dijo Patricia?</h1>
		<p>{{ Config::get("globals.siteDescription") }}</p>
		<p>Para vos, <strong>¿Qué dijo Patricia?</strong></p>
	</div>
	<div class="row" id="create">
		<img src="{{ url('phrases/create-image/'.$phrase->id) }}" />
	</div>
</div>
@stop