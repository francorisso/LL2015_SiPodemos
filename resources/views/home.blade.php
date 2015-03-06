@extends("app")

@section("content")
<div class="container">
	<div class="jumbotron">
		<h1>¿Que dijo Patricia?</h1>
		<p>{{ Config::get("globals.siteDescription") }}</p>
		<p>Para vos, <strong>¿Qué dijo Patricia?</strong></p>
	</div>
	<div class="row" id="create">
		<div class="patricia-face">
			<textarea class="top"></textarea>
			<span class="top"></span>
		</div>
		<div class="share">
			<button class="share-btn">Share</button>
		</div>
	</div>
</div>
@stop