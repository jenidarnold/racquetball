@extends('pages.tools.layouts.referee')

@section('style')
	<style>
		
	</style>
	@parent	
@stop

@section('ref-content')

<div class="col-xs-12">
	<div id="myvue" class="">
		<div class="jumbotron">
		  <h3>Racquetball Auto-Referee</h3>
		  	<p>Automated scorekeeping and match management system.
		     All you do is click the action, so you can pay attention to the action!
		     Live scores are available as the match is being played for fans to follow.
		   	</p>
	   	 	<div class="row">
	   			<div class="col-xs-10 col-xs-offset-2">
		   			<a href="{{ url('/scores/0/live') }}" class="btn btn-info btn-block">View Live Scores</a>
		   		</div>
		    </div>
		    <br>
		   	<div class="row">
		   		<div class="col-xs-10 col-xs-offset-2">
		   			<a href="{{ url('/auth/login') }}" class="btn btn-success btn-block">Login In with Email</a>
		   		</div>
		   	</div>
		    <br>
		   	<div class="row">		   		
				<div class="fb-login-button col-xs-10 col-xs-offset-2" data-max-rows="1" data-size="large" 
				scope="public_profile,publish_actions, email,user_friends" data-show-faces="true" data-auto-logout-link="true">				
			</div>
		</div>	
	</div>
</div>

<div id="status">
</div>

@stop

@section('script')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=707155052773927";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

// This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });    
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '707155052773927',
      xfbml      : true,
      version    : 'v2.8'
    });

    FB.getLoginStatus(function(response) {
    	statusChangeCallback(response);
  	});

  	FB.Event.subscribe('auth.login', function(resp) {
        window.location = '/auth/login/';
    });
  };


// Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Hey, Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
    FB.api('/me/feed', 'post', {message: 'Jennifer Arnold, this is a test'}, function(response) {
	  if (!response || response.error) {
	    alert('Error occured');
	  } else {
	    alert('Post ID: ' + response.id);
	  }
	});

     //window.location = '/auth/login/';

  }
</script>
    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyDOYjrE7msWmi09Qw6YHH5K_7OX6DJpHzk",
        authDomain: "racquetballhub.firebaseapp.com",
        databaseURL: "https://racquetballhub.firebaseio.com",
        storageBucket: "racquetballhub.appspot.com",
        messagingSenderId: "67100105837"
      };
      firebase.initializeApp(config);
    </script>    
	<script>
		
		Vue.config.debug = true;
		Vue.config.devtools = true;	

		var matchesRef = firebase.database().ref('matches');

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: true,
										
			},	
			mounted: function(){
				console.log('ready');
				$('#welcomeModal').modal('show');
			},	
			firebase:{
				matches: matchesRef
			},						
			computed: {
			
			},
			filters: {
				
			},				
			methods: {
				
			}
		});	
		window.vue = vm;
	</script>

	
@stop