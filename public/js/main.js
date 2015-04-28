(function(){

	var app = angular.module("lisanApp",[
		'webcam'
	]);

	app.controller('AppCtrl', function( $scope )
	{
		$scope.onError = function (err) {
			console.log('onError',err);
		};
		$scope.onStream = function (stream) {
			console.log('onStream', stream);
		};
		$scope.onSuccess = function (){
			console.log('success')
		};

		$scope.myChannel = {
			// the fields below are all optional
			videoHeight: 600,
			videoWidth: 800,
			video: null // Will reference the video element on success
		};
	});
})();