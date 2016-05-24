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
		<!-- Navigation  -->	
		<div class="row">
				<nav class="navbar navbar-primary navbar-inverse">
				  <div class="container-fluid">
				    <ul class="nav navbar-nav">
				      <li><a href="/tools/league/{{$league->league_id}}/join">Join</a></li>
				      <li class="active"><a href="#">Standings</a></li>
				      <li><a href="/tools/league">Back to All</a></li> 
				    </ul>
				  </div>
				</nav>
			</div>	
		<!-- Display League  -->	
		<div class="panel panel-primary">
			<div class="panel-heading">	
				<h4>Overall Standings for {{$league->name}}</h4>						
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<table class="table">
							<th>Rank</th>
							<th>Name</th>
							<th># Gms</th>
							<th>Total</th>
							<th>Avg</th>
							<th>Graph</th>
							<th>Actions</th>
							<tr v-for="player in player_results | orderBy 'avg' -1">
								<td class='rank'>@{{ player.rank }} </td>
								<td class="player_name">@{{ player.name }} </td>
								<td class="score">@{{ player.games }} </td>
								<td class="score">@{{ player.points }} </td>
								<td class="score">@{{ player.avg }} </td>
								<td>@{{ graphRank(league_id, player.id) }} </td>
								<td><button class="btn btn-danger btn-xs" v-on:click="disablelayer(player.id)">Disable</button></td>	
							</tr>
						</table>
					</div>
				</div>
			</div>			
		</div>
		<!-- Display Match Results  -->
		<div class="panel panel-primary" v-show="true">
		<div class="panel-heading">	
			<h4>Week by Week Match Results</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">

					<table class="table">
						<th>Week #</th>
						<th>Result</th>
						<th>Actions</th>
						@foreach ($matches as $m)
							<tr>
								<td class='week_num'>{{ $m->match_date }} </td>
								<td>
									<table class="match">
										<tr>
											<td class='rank'><sup>@{{ $m->p1_rank }}</sup></td>
											<td class="player_name">{{ $m->p1_last_name }}, {{ $m->p1_first_name }} </td>			
											@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score1 }}</td>
											@endforeach	
										</tr>
										<tr>
											<td class='rank'><sup>@{{  $m->p2_rank }}</sup></td>
											<td class="player_name">{{ $m->p2_last_name }}, {{ $m->p2_first_name }} </td>			
											@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score2 }}</td>
											@endforeach		
										</tr>										
									</table>
								</td>
								<td>
									<button class="btn btn-success btn-sm" v-on:click="addMatch()">Add</button>
									<button class="btn btn-warning btn-sm" v-on:click="editMatch(m.id)">Edit</button>
									<button class="btn btn-danger btn-sm" v-on:click="deleteMatch(m.id)">Delete</button>
								</td>
							</tr>
						@endforeach
						@if (count($m) ==0)
							<tr><td><h5>No Matches</h5></td></tr>
						@endif
						</table>
					{{-- <table class="table match">
						<th>Week #</th>
						<th>Match #</th>
						<th>Result</th>
						<th>Actions</th>
						<tr v-for="m in matches | orderBy 'id'">
							<td class='week_num'>@{{ m.week }} </td>
							<td class='match_id'>@{{ m.id }} </td>
							<td>
								<table class="match">
									<tr v-bind:class="{ 'winner': m.player1.points == 11 }">
										<td class='rank'><sup>@{{ m.player1.rank }}</sup></td>
										<td class="player_name">@{{ m.player1.name }} </td>
										<td class="score">@{{ m.player1.points }} </td>
									</tr>
									<tr v-bind:class="{ 'winner': m.player2.points == 11}">
										<td class='rank'><sup>@{{ m.player2.rank }}</sup></td>
										<td class="player_name">@{{ m.player2.name }} </td>
										<td class="score">@{{ m.player2.points }} </td>
									</tr>
								</table>
							</td>
							<td>
								<button class="btn btn-success btn-sm" v-on:click="addMatch()">Add</button>
								<button class="btn btn-warning btn-sm" v-on:click="editMatch(m.id)">Edit</button>
								<button class="btn btn-danger btn-sm" v-on:click="deleteMatch(m.id)">Delete</button>
							</td>
						</tr>
					</table> --}}
				</div>
			</div>
		</div>			
	</div>

	<!-- Display Add Match  -->
	<div class="panel panel-success" v-show="true">
		<div class="panel-heading">	
			<h4>Add New Match</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
				{!! Form::model($league, array('route' => array('tools.league.match.add'), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'PUT')) !!}
				{!! Form::hidden ('_token', csrf_token()) !!}
				{!! Form::hidden ('league_id', $league->league_id) !!}	
					<div class="form-group">
						<label for="match_date" class="control-label col-xs-1">Date:</label>
						<div class="col-xs-2">
							<div class="input-group date date-picker" data-provide="datepicker">						
							    <input type="text" class="form-control" name="match_date">
							    <div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
							    </div>
							</div>
						</div>
					</div>				
					<div class="form-group">						
						<label for="ddlMatchPlayer1" class="control-label col-xs-1">Player 1:</label>
						<div class="col-xs-3">
							{!! Form::select('ddlMatchPlayer1', $players_list, '', 
								    array('class' => 'player form-control', 'name' => 'player1_id')) !!}
						</div>
						<label for="p1_score" class="control-label col-xs-1">Score:</label>
						<div class="col-xs-1">
							<input name="p1_score" type="text" class="form-control">
						</div>						
					</div>
					<div class="form-group">
						<label for="ddlMatchPlayer2" class="control-label col-xs-1">Player 2:</label>
						<div class="col-xs-3">
							{!! Form::select('ddlMatchPlayer2', $players_list, '', 
								    array('class' => 'player form-control', 'name' => 'player2_id')) !!}
						</div>
						<label for="p2_score" class="control-label col-xs-1">Score:</label>
						<div class="col-xs-1">
							<input name="p2_score" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3">
				    		{!!  Form::submit('Submit', array('class' => 'btn btn-success btn-sm',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
							<button type="button" class="btn btn-warning btn-sm" v-show="!error" @click ="cancelled">Cancel</button>
				    	</div>						   
					</div>																
				{!! Form::close() !!}
				</div>
			</div>
		</div>	
	</div>	
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){           
	        $(".player").select2({
	        	placeholder: "Select a Player",
	        	allowClear: true,    	 	
	        });	
	        $(".player").select2("val", "");
	    });
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,
				preview: false,
				showSetup: true,
				showLeague: false,
				league_id: 1,
				league_title: '',
				isStarted: false,
				score_max: 11,
				games: [], 	
				players: [ 						
					],
				player_results: [
						{id: 236113, rank: 3, name: 'A Perez, Evelyn',    games: 5,  points: 30,  avg: 6  },
						{id: 9590,   rank: 2, name:  'Ackermann, Alex',    games: 10, points: 80,  avg: 8  },
						{id: 21772,  rank: 1, name: 'Ackermann, Krystal', games: 10, points: 100, avg: 10 },
					],	
				matches: [
					{id: 1, week: 1, player1: {id: 236113, rank:3, name: 'A Perez, Evelyn', points: 11},  player2: {id: 9590, rank:2, name: 'Ackermann, Alex', points: 4} },
					{id: 2, week: 1, player1: {id: 236113, rank:3, name: 'A Perez, Evelyn', points: 6},  player2: {id: 21772, rank:1, name: 'Ackermann, Krystal', points: 11} },
					{id: 3, week: 1, player1: {id: 21772, rank:1,  name: 'Ackermann, Krystal', points: 11},  player2: {id: 9590, rank:2, name: 'Ackermann, Alex', points: 8} },

					{id: 4, week: 2, player1: {id: 236113, rank:2, name: 'A Perez, Evelyn', points: 5},  player2: {id: 9590, rank:3, name: 'Ackermann, Alex', points: 11} },
					{id: 5, week: 2, player1: {id: 236113, rank:2, name: 'A Perez, Evelyn', points: 9},  player2: {id: 21772, rank:1, name: 'Ackermann, Krystal', points: 11} },
					{id: 6, week: 2, player1: {id: 21772, rank:1,  name: 'Ackermann, Krystal', points: 11},  player2: {id: 9590, rank:3, name: 'Ackermann, Alex', points: 4} },
				],				
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
				getLeagues: function(){

				},
				saveLeague: function(){					
					this.showLeague = true;
					this.showSetup = false;		
				},
				setupLeague: function(event){ 
					this.showLeague = true;
					this.showSetup = false;					
				},
				resetLeague: function(event){ 
					// disable point, sideout, fault, etc
					this.showLeague = false;
					this.showSetup = true;					
					this.players = [];	
					this.games = [];
				},	
				addPlayer: function(id, name){
					var that = this;

					$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
				        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
				        if (token) {
				            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
				        }
				    });
                    $.ajax({
                        context: this,
                        type: "POST",
                        data: {
                        	leage_id: this.league_id,
                        	player_id: this.player_id
                        },
                        url: "/tools/league/api/players/add",
                        success: function (result) {
                            this.$set("player_answers", result);
                            var players = result;

                            that.players = players;
                        },
						error:function(x,e) {
							console.log("error adding player: " + e.message);
						}
                    });
					//this.players.push({"id": id, "name": name});
					//console.log('Add Player: ' + this.players);
				},
				addMatch: function(id, name){
					this.players.push({"id": id, "name": name});
					console.log('Add Player: ' + this.players);
				},
				deletePlayer: function(player_id){
					
				},
				getGraphRank: function(player_id) {
					return "Show Graph here";
      //               $.ajax({
      //                   context: this,
      //                   url: "/tools/leauge/api/graphRank",
      //                   type: "POST",
      //                   data: {
      //                   	league_id: this.league_id,
      //                   	player_id: player_id
      //                   },
      //                   success: function (result) {
      //                       this.$set("player_answers", result);
      //                   },
						// error:function(x,e) {
						// 	console.log("error getting player graph rank: " + e.message);
						// }
      //               });
                },		
				enterScore: function(player_id, score){
				},
				getPlayerAnswers: function(player_id) {
                    $.ajax({
                        context: this,
                        url: "/tools/doublesmatcher/api/players/answers",
                        success: function (result) {
                            this.$set("player_answers", result);
                        },
						error:function(x,e) {
							console.log("error getting player answers: " + e.message);
						}
                    });
                },		
                savePlayers: function() {                	
                	$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
				        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
				        if (token) {
				            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
				        }
				    });
                    $.ajax({
                        context: this,
                        type: "POST",
                        data: {
                        	player_id: this.player_id,
                        	player_answers: this.score,
                        },
                        url: "/tools/doublesmatcher/api/players/answers/save",
                        success: function (result) {
                            this.$set("player_answers", result);
                        },
						error:function(x,e) {
							console.log("error saving player answers: " + e.message);
						}
                    });
                },		
			}
		});	
	</script>
@stop