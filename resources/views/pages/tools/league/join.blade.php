@extends('layouts.app')

@section('style')
	<style>
	.link {
		active: none;
	}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<!-- Navigation  -->
		<div class="row">
			<nav class="navbar navbar-primary navbar-inverse">
			  <div class="container-fluid">
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="#">Join</a></li>
			      <li><a href="/tools/league/{{$league->league_id}}">Standings</a></li>
			      <li><a href="/tools/league">Back to All</a></li> 
			    </ul>
			  </div>
			</nav>
		</div>	
		<!-- Join League  -->				
			<div class="row">
				<div class="col-xs-3">
					<h3>{{$league->name}}</h3>
					<h5>{{$league->start_date}} to {{$league->end_date}}</h5>
				</div>
				<div class="col-xs-3">
					<h5>
						<address>
							{{$league->gym}}
							<a class="link" target="_blank" href="https://www.lafitness.com/pages/clubhome.aspx?clubid=430&Carrollton-Texas"></a>
							LA | Fitness<br/>
					    	4220 Midway </br>
					    	Carrollton, TX 75007
					    </address>
					</h5>
				</div>
				<div class="col-xs-6">
					<h5> Weeks, Round Robin, one game to 11
					{{$league->description}}<h5>
				</div>
			</div>				
			</div>											
				<div class="row">
					<div class="col-xs-2">
						<div class="panel panel-success">			
							<div class="panel-heading">
								<b>Legaue Players({{count($players)}})</b>
							</div>
							<div class="panel-body">
								<table class="table">
									@foreach ($players as $p)
									<tr>
										<td class="player_name">{{ $p->last_name }}, {{ $p->first_name }} </td>							
									</tr>
									@endforeach
									@if (count($players) ==0)
										<tr><td><h5>No Players</h5></td></tr>
									@endif
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-10">
							{!! Form::model($league, array('route' => array('tools.league.join'), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'PUT')) !!}
							{!! Form::hidden ('_token', csrf_token()) !!}
							{!! Form::hidden ('league_id', $league->league_id) !!}
						
							<div class="form-group">
								<label class="label label-info col-xs-12"><h5>Already a Registered Player?</h5></label>
							</div>
							<div class="form-group">
								<label for="ddlPlayers" class="control-label col-xs-2">Search:</label>
								<div class="col-xs-6">
									{!! Form::select('player_id', $players_list, '', 
										    array('class' => 'player form-control', 
									       'style' => 'font-weight:300; font-size:10pt; width:300px',
									        )) !!}
								</div>
							</div>
							<div class="form-group">
								<label class="label label-info col-xs-12"><h5> Or Enter New Player Information </h5></label>
							</div>
							<div class="form-group">
								<label for="first_name" class="control-label col-xs-2">First Name:</label>
								<div class="col-xs-6">
									<input placeholder="First Name" name="first_name" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="last_name" class="control-label col-xs-2">Last Name:</label>
								<div class="col-xs-6">
									<input placeholder="Last Name" name="last_name" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="control-label col-xs-2">Email:</label>
								<div class="col-xs-6">
									<input placeholder="Email" name="email" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="control-label col-xs-2">Phone:</label>
								<div class="col-xs-6">
									<input placeholder="Phone" name="phone" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-6 col-xs-offset-3">
									{!!  Form::submit('Submit', array('class' => 'btn btn-success',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
									<button type="button" class="btn btn-warning" v-show="!error" @click ="cancelled">Cancel</button>
								</div>
							</div>
						</form>
	</div>
</div>
@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){           
	        $(".player").select2({
	        	placeholder: "Search Player",
	        	allowClear: true,    	 	
	        });	
	        $(".player").select2("val", "");

	        $(".player").on('change', function () {
	        		var id = this.value;
	        		var name = $(".player").select2('data')[0]['text'];
			        vm.addPlayer(id, name);
			      });
	    });
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,				
			},		
			ready: function() {
				//ajax functions
				//this.getLeagues();
            },								
			computed: {									
			},
			filters: {				
			},				
			methods: {			
			}
		});	
	</script>
@stop