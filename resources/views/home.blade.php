@extends("app")

@section("content")
<div class="container">
	<div class="jumbotron">
		<h1>¿Que dijo Patricia?</h1>
		<p>{{ Config::get("globals.siteDescription") }}</p>
		<p>Para vos, <strong>¿Qué dijo Patricia?</strong></p>
	</div>
	<div class="row" id="create">
		<div class="col-md-9 col-sm-12">
			<div class="patricia-face">
				<textarea class="top"></textarea>
				<span class="top">ESCRIBI ALGO...</span>
			</div>
		</div>
		<div class="col-md-3 col-sm-12 share">
			<h3>Ahora compartí:</h3>
			<button class="share-btn btn btn-primary">
				<i class="glyphicon glyphicon-send"></i>&nbsp;Compartí en Facebook
			</button>
		</div>
	</div>
</div>
<div class="container" id="list">
	<h2>Los mejores</h2>
	@foreach($phrasesTop as $position=>$phrase)
		<div class="row" data-id="{{ $phrase->id }}">
			<div class="col col-md-12">
				<img src="{{ "phrases/create-image/" . $phrase->id }}" width="500" class="thumbnail"/>
				<div class="right pull-left">
					<blockquote>
						<p>{{ nl2br(trim($phrase->phrase)) }}.</p>
					</blockquote>
					<p>
						<i class="glyphicon glyphicon-heart-empty"></i> <span class="votes">{{ $phrase->votes }}</span>
					</p>
					<div class="fb-like" data-href="{{ url("phrases/".$phrase->id) }}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" data-phrase-id="{{ $phrase->id }}"></div>
				</div>
			</div>
		</div>
	@endforeach
</div>
@stop