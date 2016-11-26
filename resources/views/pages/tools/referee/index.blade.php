@extends('pages.tools.layouts.referee')

@section('style')
	<style>
		.fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {
    width: 100% !important;
    }
    .buttons{
      width: 290px !important;
      font-family:  Helvetica, Arial, sans-serif;
      font-weight: bold;
    }
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
	   			<div class="col-xs-10 col-xs-offset-1">
		   			<a href="{{ url('/scores/0/live') }}" class="btn btn-info  buttons">View Live Scores</a>
		   		</div>
		    </div>
        <br>
        <div class="row">         
          <div class="fb-login-button fb_iframe_widget col-xs-10 col-xs-offset-1" data-max-rows="1" data-size="xlarge" 
            login_text="Login with Facebook" 
            scope="public_profile, publish_actions, email,user_friends, user_about_me" data-show-faces="false" data-auto-logout-link="true">        
         </div>
        </div> 
        <br>
        <div class="row">
          <div class="col-xs-10 col-xs-offset-1">            
            <a href="{{ url('/auth/register') }}" class="btn btn-default buttons"><i class="fa fa-envelope-o text-center"></i> Sign up using Email</a>
          </div>
        </div>  
		    <br>
		   	<div class="row">
		   		<div class="col-xs-10 col-xs-offset-1 text-center">
		   			<h5> Have an Account? <a href="{{ url('/auth/login') }}" class="text-primary bold"> Login </a></h5>
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
     //var access_token =   FB.getAuthResponse()['accessToken'];
      //getFBUserInfo(access_token);
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' +
      //  'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' +
      //  'into Facebook.';
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

    //After being logged in, redirect to match page
  	FB.Event.subscribe('auth.login', function(resp) {
      // console.log(resp);
      //  window.location = '/auth/fb?id='+resp.id;
      var access_token =   FB.getAuthResponse()['accessToken'];
      getFBUserInfo(access_token);
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
  function getFBUserInfo(access_token) {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=id,name,email', function(response) {
        //console.log(response);
        //window.location = '/auth/fb?id='+response.id + '&name=' + response.name + '&email=' + response.email + '&token=' + access_token; 

        $.post("/auth/fb",
        {
            _token: '{{ csrf_token() }}',
            id: response.id,
            name: response.name,
            email: response.email, 
            access_token: access_token
        },
        function(data, status){
          console.log(data);
          window.location = data;
        });
      });    
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