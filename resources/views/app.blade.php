<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" id="mViewport" content="width=device-width, initial-scale=1">
	<title>Si, Podemos! - Lisandro Licari 2015</title>

	@section('extra_headers')
	@show

	@if(!empty($ogtags))
		@foreach ( $ogtags as $key => $value )
		  <meta property="og:{{ $key }}" content="{{{ $value }}}" />
		@endforeach
	@endif

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<link href="{{ asset('/css/main.css?v=1.0.1') }}" rel="stylesheet">
	<link href="{{ asset('/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<script type="text/javascript">
		var baseUrl = "{{ Config::get('app.url') }}";
		var _token = "{{ csrf_token() }}";
	</script>
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Archivo+Black' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<div class="row" style="background:#fff; float:left; width:100%; height:900px; z-index:9999999999;" id="facebook-overlay">
			<div class="col-xs-12" style="text-align:center;">
				<h2>Para tomar la foto sigue las instrucciones:</h2>

				<h4>1. Haz click en la esquina superior derecha, en los 3 puntitos</h4>
				<img src="/images/tuto-1.png" style="width:70%" />

				<h4>2. Haz click en abrir en Chrome dentro de las opciones</h4>
				<img src="/images/tuto-2.png" style="width:70%" />
			</div>
		</div>
	</div>

	@yield('content')

	<!-- Scripts -->
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '828448763892191',
	      xfbml      : true,
	      version    : 'v2.3'
	    });
		};

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
	<script src="{{ asset('js/camera.js?v=1.0.2') }}"></script>
</body>
</html>
