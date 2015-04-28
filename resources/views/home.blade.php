@extends("app")

@section("content")
<div class="container">
	<div class="jumbotron">
		<h1>Si, Podemos</h1>
		<p>{{ Config::get("globals.siteDescription") }}</p>
	</div>
	<div class="row" id="create" ng-controller="AppCtrl">
		<div class="col-md-9 col-sm-12">
			<div id="video" style="position:relative; width:800px; height:600px;">
				<div style="position:absolute;top:0; left:0;"><webcam channel="myChannel"></webcam></div>
				<div style="position:absolute; width: 250px; height: 150px; background:#f00; bottom:20px; left: 50%; margin-left:-125px;">
					<h2 style="color:#fff; text-align:center;">Si, Podemos.</h2>
				</div>
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