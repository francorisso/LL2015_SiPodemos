$(function(){
	var words = {
		top: "",
		bottom: ""
	};
	$(".patricia-face textarea.top").focus();
	
	$(".patricia-face textarea").on("keydown", function(e){
		e.preventDefault();

		var keycode = e.which;
		var letter = null;
		if(keycode==8){ 
			words.top = words.top.substring(0, words.top.length-1);
		} 
		else if(keycode==13){   
			words.top += "<br />";
		} 
		else if( keycode ){
			letter = String.fromCharCode( keycode );
			words.top += letter;
		}
		
		$(".patricia-face span.top").html( words.top );
	});

	$(".share-btn").click(function(e){
		e.preventDefault();
		checkLogin(function(response){
			$.ajax({
				type: "POST",
				url: baseUrl + '/auth/login-with-fb-id',
				data: { "userId" : response.authResponse.userID, "_token":_token }
			})
			.done(function( res ) {
				share();
			})
			.fail(function(res) {
				alert("Error with authentication. Please try again.");
			});
		});
	});

	function share(){
		//TODO: poner loading
		var text = words.top;
		$.ajax({
			type: "POST",
			url: baseUrl + '/phrases',
			data: { 
				"_token" : _token, 
				"text"   : text 
			}
		})
		.done(function( res ) {
			FB.ui(
			{
				method: 'share',
				href: baseUrl + '/phrases/' + res.phrase_id,
			},
			function(response) {
				if (response && !response.error_code) {
					alert('Posting completed.');
				} else {
					alert('Error while posting.');
				}
			});
		})
		.fail(function(res) {
			console.error(res);
		});
	}

	function checkLogin( fnc ){
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				fnc(response);
			}
			else {
				login( fnc );
			}
		});
	}

	function login( fnc ){
		FB.login(function(response){
			fnc(response);
		}, {scope: ''});
	}
});

/**
* Votes controller
*/
function initFbActions(){
	FB.Event.subscribe("edge.create", function(request_url){
		var url_tokens = request_url.split("/");
		var container = $("#list");
		var phrase_id = url_tokens[ url_tokens.length-1 ];
		$.ajax({
			type: "POST",
			url: baseUrl + '/phrases/votes',
			data: { 
				"_token" : _token, 
				"phrase_id"   : phrase_id
			}
		})
		.done(function( res ) {
			container.find('.row[data-id="'+ phrase_id +'"] .votes').html( res.votes );
		})
		.fail(function(res) {
		});
	});
};