@extends('layouts.app')

@section('style')
	<style>
		th {
			text-align: center
		}
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
			width: 250px;
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
			text-align: center;
		}
		.match .player_name {			
			font-weight: 200;
			font-size: 10pt;
			width: 200px;
		}
		.match .score {			
			font-weight: 400;
			font-size: 10pt;
			text-align: center;
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
		<div class="panel panel-primary" v-if="showStandings">
			<div class="panel-heading">	
				<div class="row">
					<div class="col-xs-12 col-md-62">
						<h4>{{$league->name}} Standings as of {{date('M d, y')}} </h4>
						<h6>League runs {{date('M d, y', strtotime($league->start_date))}} to {{date('M d, y', strtotime($league->end_date))}}</h6>
						
					</div>										
				</div>				
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<table class="table">
							<th class="col-xs-1">Rank</th>
							<th class="col-xs-2">Name</th>
							<th class="col-xs-1" title="Total games won">W</th>
							<th class="col-xs-1" title="Total games lost">L</th>
							<th class="col-xs-1" title="Percent Won">PCT</th>
							<th class="col-xs-1" title="Win or Loss Streak">Strk</th>
							<th class="col-xs-1" title="Total number of games played"># Gms</th>
							<th class="col-xs-1">Total Pts</th>
							<th class="col-xs-1">Avg Pts</th>
							@if($i=1)@endif
							@foreach ($standings as $s)
								<tr>									
									<td class='rank'>{{ $i++}} </td>
									<td class="player_name">{{ $s->first_name}}  {{$s->last_name }} </td>									
									<td class="score">5</td>
									<td class="score">2</td>
									<td class="score">80%</td>
									<td class="score">W3 | L3 </td>
									<td class="score">{{ $s->games }} </td>
									<td class="score">{{ $s->points }} </td>
									<td class="score">{{ $s->avg }} </td>
								</tr>
							@endforeach
							@if (count($matches) == 0)
								<tr><td colspan="5" class ="score"><h4>No Matches</h4></td></tr>
							@endif
						</table>
						<div>
						{!! $standings->render() !!}
					</div>
					</div>
				</div>
			</div>			
		</div>
		<!-- Display Match Results  -->
		<div class="panel panel-primary" v-if="showResults">
		<div class="panel-heading">	
			<h4>Week by Week Match Results</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					{!! HTML::linkRoute('tools.league.match.create', 'Add', array($league->league_id), array('class' => 'btn btn-success btn-sm')) !!} 
				</div>
			</div>
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
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p1_first_name }} {{ $m->p1_last_name }} </td>			
											@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score1 }}</td>
											@endforeach	
										</tr>
										<tr>
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p2_first_name }} {{ $m->p2_last_name }} </td>			
											@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score2 }}</td>
											@endforeach		
										</tr>										
									</table>
								</td>
								<td>
					                {!! Form::close() !!}
									{!! Form::open(array('route' => array('tools.league.match.edit',  $league->league_id, $m->match_id), 'class' => 'pull-left')) !!}
					                    {!! Form::hidden('_method', 'GET') !!}
					                    {!! Form::submit('Edit', array('class' => 'btn btn-warning btn-sm')) !!}
					                {!! Form::close() !!}
									{!! Form::open(array('route' => array('tools.league.match.delete', $league->league_id, $m->match_id), 'class' => 'pull-left')) !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::hidden ('league_id', $league->league_id) !!}	
										{!! Form::hidden ('match_id', $m->match_id) !!}	
					                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) !!}
					                {!! Form::close() !!}
								</td>
							</tr>
						@endforeach
						@if (count($matches) == 0)
							<tr><td colspan="3" class ="score"><h4>No Matches</h4></td></tr>
						@endif
						</table>					
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
	        $("#player1_id").select2("val", "");
	        $("#player2_id").select2("val", "");
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
				showStandings: true,
				showResults: true,
				showAddMatch: false,
				league_id: 1,
				league_title: '',
				isStarted: false,
				score_max: 11,		
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
				toggleShowAddMatch: function(bool){
					this.showAddMatch = bool;
					this.showResults = ! bool;
					this.showStandings = ! bool;
				},
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