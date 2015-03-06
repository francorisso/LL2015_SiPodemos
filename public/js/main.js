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
		var text = words.top;
		if( text.indexOf('<br />')>0){
			text = text.split('<br />');
			text = text.join('::');
		}
		checkLogin(function(response){
			$.post(baseUrl + '/auth/login-with-fb-id',
				{ "userId" : response.authResponse.userID, "_token":_token }, 
				function(res){

				}
			);
		});
	});

	function share(){
		//TODO: poner loading
		var text = words.top;
		if( text.indexOf('<br />')>0){
			text = text.split('<br />');
			text = text.join('::');
		}
		var shareUrl = baseUrl + '/imageGenerator.php?text=' + text;
		var msg = 'Para MI, Patricia dice "'+ text.replace("::"," ") +'"';
		FB.api('/me/feed', 'post', {
			"message": msg,
			"link" : baseUrl + "?text=" + words.top,
			"picture" : shareUrl
		}, function(response){
			console.log(response);
			//TODO: avisar que se ha compartido exitosamente.
		});
	}

	function checkLogin( fnc ){
		FB.getLoginStatus(function(response) {
			fnc(response);
			/*if (response.status === 'connected') {
				share();
			}
			else {
				login();
			}*/
		});
	}

	function login(){
		FB.login(function(response){
			console.log(response);
			//share();
		}, {scope: 'publish_actions'});
	}
});