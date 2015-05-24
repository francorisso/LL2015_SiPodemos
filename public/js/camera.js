var llCameraClass = (function(){
	var instance = this;
	// Grab elements, create settings, etc.
	this.canvas 	= document.getElementById("canvas");
	this.context 	= canvas.getContext("2d"),
	this.video 		= document.getElementById("video"),
	this.videoObj = { "video": true },

	this.shotCounter  = 0;
	this.shotTimer		= 0;

	this.errBack = function(error) {
		console.log("Video capture error: ", error.code);
	};

	this.init = function(){
		var videoObj 	= instance.videoObj;
		var errBack 	= instance.errBack;

		// Put video listeners into place
		if(navigator.getUserMedia) { // Standard
			navigator.getUserMedia(videoObj, function(stream) {
				video.src = stream;
				video.play();
			}, errBack);
		} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
			navigator.webkitGetUserMedia(videoObj, function(stream){
				video.src = window.URL.createObjectURL(stream);
				video.play();
			}, errBack);
		}
		else if(navigator.mozGetUserMedia) { // Firefox-prefixed
			navigator.mozGetUserMedia(videoObj, function(stream){
				video.src = window.URL.createObjectURL(stream);
				video.play();
			}, errBack);
		}

		instance.setEvents();
	};

	this.setEvents = function(){
		$(document).on('click', '#snap', function(e){
			e.preventDefault();
			instance.shotCounter = 3;
			$('#create .shotCounter').fadeTo(0.9, 1);
			instance.takePhoto();
		});
	};

	// Trigger photo take
	this.takePhoto = function(){
		if( instance.shotTimer ){
			clearTimeout(instance.shotTimer);
		}

		if(instance.shotCounter > 0){
			$('#create .shotCounter .number').html( instance.shotCounter );
			instance.shotCounter--;
			$('#create .shotCounter').fadeTo(100, 0.7, function(){
				$('#create .shotCounter').fadeTo(1, 0.9);
				instance.shotTimer = setTimeout(instance.takePhoto, 1000);
			});
			return;
		}
		$('#create .shotCounter .number').html('');
		$('#create .shotCounter')
			.fadeTo(500,0);

		var canvasObj = $('#canvas');
		var logo = $('#logo');
		var logoPosition = logo.position();
		var watermark = $('#lisan-logo');
		var watermarkPosition = watermark.position();
		var context = instance.context;
		var video = instance.video;

		context.drawImage(video, 0, 0, canvasObj.width(), canvasObj.height());
		context.drawImage(
			logo.find('img')[0],
			logoPosition.left + parseInt( logo.css('marginLeft') ),
			logoPosition.top,
			logo.width(),
			logo.height()
		);
		context.drawImage(
			watermark.find('img')[0],
			watermarkPosition.left,
			watermarkPosition.top,
			watermark.width(),
			watermark.height()
		);

		context.beginPath();
		context.moveTo(7.5,10);
		context.strokeStyle = "#FFFFFF";
		context.lineWidth = 5;
		context.lineTo(canvasObj.width() - 10, 10);
		context.lineTo(canvasObj.width() - 10, canvasObj.height()-10);
		context.lineTo(10, canvasObj.height()-10);
		context.lineTo(10, 10);
		context.stroke();

		var finalImage = instance.convertCanvasToImage( canvas );
		$.post('/picture-generator',{
			'image': finalImage.src,
			'_token' : _token
		}).done(function(data){
			console.log(data);
			FB.ui(
			{
			  method: 'share',
			  href: 'http://lisandrolicari2015.francorisso.com.ar/'
			}, function(response){});
		});
	};

	this.convertCanvasToImage = function(canvas) {
		var image = new Image();
		image.src = canvas.toDataURL("image/png");
		return image;
	}
});

$(function(){
	var camera = new llCameraClass();
	camera.init();
});