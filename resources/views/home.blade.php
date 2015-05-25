@extends("app")

@section("content")
<div class="container">
	<h1 id="fb-welcome"></h1>
	<div class="row" id="create">
		<div class="col-xs-12 text-center">
			<div class="camera-container">
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
					<div class="shotCounter">
						<div class="loader"></div>
						<div class="number">3</div>
					</div>
				</div>
				<div class="photo-shooter text-center">
					<button id="snap" class="btn btn-primary">
						<i class="fa fa-camera"></i>
					</button>
				</div>
				<a href="#" class="text-right text-danger">Cerrar</a>
			</div>
		</div>
	</div>
</div>

<canvas id="canvas" width="640" height="480"></canvas>

<div class="modal fade" id="shareModal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body clearfix">
        <div class="col-xs-12 preview">
					<img src="" id="preview-img" />
				</div>
				<div class="col-xs-12 text-center share-container">
		      <button id="fb-share" class="btn btn-primary">
						<i class="fa fa-facebook-official"></i>&nbsp; Compartir
					</button>
				</div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="mainLoader">
	<span class="fa fa-spin fa-spinner"></span>
	<h6>Aguantá un minuto, estamos guardando la imagen.</h6>
</div>

@if( !empty($pictures) )
<div class="container" id="list">
	<h2>Ellos creen que Si Podemos!</h2>
	@foreach($pictures as $picture)
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
@endif
@stop