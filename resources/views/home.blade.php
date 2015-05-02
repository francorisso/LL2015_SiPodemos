@extends("app")

@section("content")
<div class="container">
	<h1 id="fb-welcome"></h1>
	<div class="row" id="create" ng-controller="AppCtrl">
		<div class="col-sm-7">
			<div class="video-container">
				<div class="video-box">
					<video id="video" width="640" height="480" autoplay></video>
				</div>
				<div class="border-decorator"></div>
				<div class="lisan-logo" id="lisan-logo">
					<img src="/images/lisandrolicari_50h.png" alt="logo" />
				</div>
				<div class="si-podemos-logo" id="logo">
					<img src="/images/si_podemos_150.jpg" alt="logo" />
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<button id="snap">Snap Photo</button>
		</div>
		<div class="col-sm-7">
			<canvas id="canvas" width="640" height="480"></canvas>
		</div>
	</div>
</div>
<div class="container" id="list">
	<h2>Ellos creen en el cambio:</h2>
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