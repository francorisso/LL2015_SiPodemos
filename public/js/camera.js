var llCameraClass = (function(){
	var instance = this;
	// Grab elements, create settings, etc.
	this.canvas 	= document.getElementById("canvas");
	this.context 	= canvas.getContext("2d");
	this.video 		= document.getElementById("video");
	this.videoObj = { "video": true };
	this.mainLoader = $('#mainLoader');

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

		$(document).on('click', '.close-modal', function(e){
			e.preventDefault();
			$('#shareModal').modal('hide');
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
		$('#create .shotCounter .number').html('<i class="fa fa-smile-o"></i>');
		$('#create .shotCounter')
			.fadeTo(1000,0,function(){
				$('#create .shotCounter .number').html('');
			});

		var canvasObj = $('#canvas');
		var logo = $('#logo');
		var logoPosition = logo.position();
		var watermark = $('#lisan-logo');
		var watermarkPosition = watermark.position();
		var context = instance.context;
		var video = instance.video;
		var offset = {
			'x' : (canvasObj.width()  - video.videoWidth)/2
			'y' : (canvasObj.height() - video.videoWidth)/2
		};
		console.log(video.videoWidth, video.videoHeight);
		context.drawImage(video, offset.x, offset.y, video.videoWidth, video.videoHeight);
		context.drawImage(
			logo.find('img')[0],
			logoPosition.left + parseInt( logo.css('marginLeft') ) + offset.x,
			logoPosition.top + offset.y,
			logo.width(),
			logo.height()
		);
		context.drawImage(
			watermark.find('img')[0],
			watermarkPosition.left + offset.x,
			watermarkPosition.top + offset.y,
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
		instance.mainLoader.fadeIn(500);
		$.post('/picture-generator',{
			'image': finalImage.src,
			'_token' : _token
		})
		.done(function(data){
			var originalText = $('#main-loader h6').html();
			instance.mainLoader.find('h6').html("Listo!");
			instance.mainLoader.fadeOut(500,function(){
				instance.mainLoader.find('h6').html(originalText);
			});
			$('#preview-img').attr('src', data.imageUrl);
			$('#preview-img').attr('width',640);
			$('#shareModal').modal('show');
			$('#fb-share').unbind('click').click(function(e){
				FB.ui(
				{
				  method: 'share',
				  href: 'http://sipodemos.lisandrolicari2015.com.ar/' + data.picture.id
				}, function(response){
					$.ajax({
					  url   : '/picture-generator/'+data.picture.id,
					  type  : 'put',
					  data  : {
							'action' : 'confirm',
							'_token' : _token
						}
					});
				});
			});
		});
	};

	this.convertCanvasToImage = function(canvas) {
		var image = new Image();
		image.src = canvas.toDataURL("image/jpeg",0.6);
		return image;
	}
});

$(function(){
	var camera = new llCameraClass();
	camera.init();
});