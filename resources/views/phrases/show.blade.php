@extends("app")

@section("extra_headers")
<?php 

$text 		= rawurldecode( $_GET["text"] );
if(!empty($text)){
	$article 	= [
		"title"			=> 'Patricia dice...',
		"description" 	=> "Para MI, Patricia dice: " . $text . ". " . $siteDescription,
		"img" 			=> $baseUrl . "/imageGenerator.php?text=" . $text,
		"url"			=> $baseUrl . "?text=" . rawurlencode( $text ),
	];
}

?>

<meta property="og:type" content="og:article" />
<meta property="og:title" content="<?php echo $article["title"]; ?>" />
<meta property="og:image" content="<?php echo $article["img"]; ?>" />
<meta property="og:description" content="<?php echo $article["description"]; ?>" />
<meta property="og:url" content="<?php echo $article["url"]; ?>" />

@stop

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