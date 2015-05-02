// Put event listeners into place
window.addEventListener("DOMContentLoaded", function() {
	// Grab elements, create settings, etc.
	var canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		video = document.getElementById("video"),
		videoObj = { "video": true },
		errBack = function(error) {
			console.log("Video capture error: ", error.code);
		};

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

	// Trigger photo take
	document.getElementById("snap").addEventListener("click", function() {
		setTimeout(function(){
			var canvasObj = $('#canvas');
			var logo = $('#logo');
			var logoPosition = logo.position();
			var watermark = $('#lisan-logo');
			var watermarkPosition = watermark.position();

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

			var finalImage = convertCanvasToImage( canvas );
			$.post('/picture-generator',{
				'image': finalImage.src,
				'_token' : _token
			});
		}, 2000);
	});

}, false);

function convertCanvasToImage(canvas) {
	var image = new Image();
	image.src = canvas.toDataURL("image/png");
	return image;
}