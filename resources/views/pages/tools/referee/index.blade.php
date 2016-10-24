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
		   			<a href="{{ url('/auth/login') }}" class="btn btn-success btn-block">Login In </a>
		   		</div>
		   	</div>
		   	<br>
		   	<div class="row">
	   			<div class="col-xs-10 col-xs-offset-2">
		   			<a href="{{ url('/scores/live') }}" class="btn btn-info btn-block">View Live Scores</a>
		   		</div>
		   </div>
		</div>	

			
	</div>
</div>

@stop

@section('script')
	<!--script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
	<!-- Firebase --> 
    <!--script src="https://www.gstatic.com/firebasejs/3.5.1/firebase.js"></script -->
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