@extends('layouts.app')

@section('style')
	<style>

	</style>
@stop

@section('content')

<div class="col-xs-12">
	<div id="myvue" class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
		<h3>@{{ message }}  @{{matches.length}}</h3>
		<ul id="example-1">
		  <li v-for="m in matches">
		    Match: @{{ m | json}}
		  </li>
		</ul>
	</div>
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
	<!-- Firebase --> 
    <script src="https://www.gstatic.com/firebasejs/3.5.1/firebase.js"></script>
    <!-- VueFire -->
	<script src="https://cdn.jsdelivr.net/vuefire/1.0.0/vuefire.min.js"></script>

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
				message: 'List of Live Matches',
				matches: [],
			},
			firebase: {
				matches: matchesRef
			},	
			mounted: function(){
				console.log('ready');

				// Retrieve new posts as they are added to our database
				matchesRef.on("child_added", function(snapshot, prevChildKey) {
				  var match = snapshot.val();
				  this.matches = match;
				  console.log(match);
				});

				//this.matches = matchesRef;
			},				
		});	
	</script>
@stop