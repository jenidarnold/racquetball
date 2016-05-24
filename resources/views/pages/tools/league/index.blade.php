@extends('layouts.app')

@section('style')
	<style>
		.txt-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-right: 15px;
		}
		.lbl-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-left: 15px;
		}
		.player {
			font-weight: 500;
			font-size: 12pt;
		}
		.player_name {
			font-weight: 500;
			font-size: 11pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 14pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 14pt;
		}
		.score {
			font-weight: 500;
			font-size: 14pt;
			text-align: center;
		}
		.rank {
			font-weight: 700;
			font-size: 12pt;
			text-align: center;
		}
		.tr-games {
			font-weight: 700;
			font-size: 12pt;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px;
		   padding-right: 5px;
		}
		h4  > *{
		   padding-top: 10px;
		   padding-bottom:  10px;
			background-color: green;
		}

		.match .week_num{
			font-weight: 200;
			font-size: 10pt;
			text-align: center;
			width: 80px;
		}
		.match .match_id {
			font-weight: 200;
			font-size: 10pt;
			text-align: center;
			width: 80px;
		}
		.match .rank {			
			font-weight: 200;
			font-size: 8pt;
		}
		.match .player_name {			
			font-weight: 200;
			font-size: 10pt;
			width: 200px;
		}
		.match .score {			
			font-weight: 400;
			font-size: 10pt;
		}
		.match .winner {			
			color:green;
			font-weight: 300;
		}
		.txt-score {
			width: 60px;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<!-- Setup League  -->
		<div class="panel panel-primary">			
			<div class="panel-heading"><h3>Leagues</h3></div>
			<div class="panel-body">
				<div>
					<table class="table">
						<thead>
							<th></th>
							<th></th>
							<th>League Name</th>
							<th>Start</th>
							<th>End</th>
							<th>Location</th>
							<th>Director</th>
							<th> # Players</th>
							<th>Format</th>
							<th>Description</th>
						</thead>
						@foreach ($leagues as $l)
							<tr>
								<td>
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-warning btn-sm" href="{{ route('tools.league.show', [$l->league_id]) }}"><i class="fa fa-search"></i></a>
								</td>
								<td>
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-success btn-sm" href="{{ route('tools.league.join', [$l->league_id]) }}">Join</i></a>
								</td>					
								<td>{{$l->name}}</td>
								<td>{{$l->start_date}}</td>
								<td>{{$l->end_date}}</td>
								<td>L.A. Fitness Hebron/Midway</td>
								<td><a href="">B. Zimmerman</a></td>
								<td>@{{ getPlayerCount($l->league_id) }}</td>
								<td>Round Robin: 1 game to 11</td>
								<td>Bring it! No Whining allowed</td>
							</tr>
						@endforeach
					</table>
					<div>
						{!! $leagues->render() !!}
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<a id="lnkLeagueAdd" class="btn btn-success btn-sm" href="{{ route('tools.league.create') }}"><i class="fa fa-plus"></i>Create</a>
			</div>
		</div>	
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>	
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
				getPlayerCount: function(league_id){
					var that = this;

					$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
				        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
				        if (token) {
				            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
				        }
				    });
                    $.ajax({
                        context: this,
                        type: "GET",
                        data: {
                        	league_id: league_id
                        },
                        url: "/tools/league/" + league_id +"/players/count",
                        success: function (result) {
                            
                            return result;
                        },
						error:function(x,e) {
							console.log("error getting league player count: " + e.message);
						}
                    });
					//this.players.push({"id": id, "name": name});
					//console.log('Add Player: ' + this.players);
				},		
			}
		});	
	</script>
	

@stop