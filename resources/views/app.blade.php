<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Patricia dice...</title>
	
	@section('extra_headers')
	@show

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
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
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">Patricia Dice</a>
			</div>
			<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{ url('/') }}#create">Crear</a></li>
				<li ><a href="{{ url('/') }}#list">Los mejores</a></li>
			</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	@yield('content')

	<footer class="footer container">
		<div class="row">
			<div class="pull-right col-md-4 madeby">
				Creado por <a href="http://www.toptal.com/resume/franco-risso">Franco Risso</a>
			</div>
		</div>
	</footer>

	<!-- Scripts -->
	
	<!-- Facebook js SDK -->
	<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '660407057439433',
			xfbml      : true,
			version    : 'v2.1'
		});

		initFbActions();
	};

	(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "//connect.facebook.net/es_LA/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	 }(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src="vendor/jquery-cookie/src/jquery.cookie.js"></script>
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
