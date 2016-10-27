@extends('pages.tools.layouts.referee')

@section('style')
	<style>
		.player {
			font-weight: 500;
			font-size: 14pt;
		}
		.player-sum {
			font-weight: 500;
			font-size: 12pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 9pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 9pt;
		}
		.score {
			font-weight: 500;
			font-size: 12pt;
			text-align: center;
		}
		.th-games {
			text-align: center;
			color: white;
		}
		.nopadding {
			padding: 0px !important;
		}
		td {
			padding: 2px !important;
		}
		.tr-games {
			font-weight: 300;
			font-size: 9pt;
		}
		.game-time{
			font-size: 8pt;
			color:white;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.purple {
			color:#7E43CB;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px 5px 5px;
		   padding-right: 5px;
		}
		h3  > *{
		   padding-top: 10px;
		   padding-bottom:  10px;
		}
		.lbl-team {
			font-weight: 700;
			font-size: 14pt;
		}
		.timer {
			text-align: center;
		}
		.timeout .modal-backdrop {
	    	background-color: yellow;
		}
		.winner .modal-backdrop {
	    	background-color: green;
		}	
		.btn-actions {
			margin-top: 150px;			
			margin-bottom: 10px;
		}
	</style>
@stop

@section('ref-content')

<div class="col-xs-12">
	<div id="myvue" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div id="setup" v-if="showSetup">
			<form class="form-inline" role="form">	
				<div class="row">			
					<div class="row">
						 <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Tournament:</label>				
							<select v-model="tournament" id="ddlTournaments" class="form-control">
							  	<option v-for="t in tournaments" v-bind:value="tournament">
							    	@{{ t.name }}
							  	</option>
							</select>	
						</div>
					</div>
					
			    	<div class="row">
					    <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Match Title:</label>
							<input class="form-control" id="title" placeholder="Enter Match Title" v-model="match_title">
					    </div>
					</div>
					<div class="row">
					    <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Referee:</label>
							<input class="form-control" id="referee" v-model="match.referee.name">
					    </div>
					</div>
					<div class="row">	
					    <div class="col-xs-12 col-sm-12 form-group">				    
							<label for="game_format" class="control-label lbl-team">Game Format: </label>
							<select v-model="game" id="game_format" class="form-control">
							  	<option v-for="game in game_formats" v-bind:value="game">
							    	@{{ game.name }}
							  	</option>
							</select>								
						</div>
					</div>
				</div>
				<div class="row">							
					<div class="row">
						<div class="col-xs-12 form-group">
							<label class="radio-inline">
						      	<input type="radio" id="singles" value="2" v-model="max_players">Singles
						    </label>
						    <label class="radio-inline">
						      	<input type="radio" id="doubles" value="4" v-model="max_players">Doubles
						    </label>
						</div>
					</div>
					<div class="row">			
						<div class="col-xs-12 col-sm-12  form-group">
							<label for="team1" class="control-label lbl-team ">@{{team[1].name}}:</label>
						    <input class="form-control" id="team1" v-model="players[1].name" v-bind="{'placeholder':team[1].placeholder[0]}">
						    <input class="form-control" v-model="players[2].name" v-bind="{'placeholder':team[1].placeholder[1]}" v-if="isDoubles == true">
						</div>				
						<div class="col-xs-12 col-sm-12  form-group">
						    <label for="team2" class="control-label lbl-team ">@{{team[2].name}}:</label>
						    <input class="form-control" id="team2" v-model="players[3].name" v-bind="{'placeholder':team[2].placeholder[0]}">
						    <input class="form-control" v-model="players[4].name" v-bind="{'placeholder':team[2].placeholder[1]}"  v-if="isDoubles == true">
						</div>	
					</div>	
					<div class="row">	
						<div class="col-xs-12 col-sm-12 form-group">
							<label for="server" class="control-label lbl-team">Starting Server: </label>
							<br>					
							<select id="server" v-model="server" class="form-control">
							  	<option v-for="player in players" v-bind:value="player.pos">
							    	@{{ player.name }}
							  	</option>
							</select>	
						</div>
					</div>
				</div>	
			</form>
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-3 col-xs-offset-1">
				    	<button class="btn btn-info" v-on:click="createMatch" v-bind:class="{'disabled':match_title == ''}">Save</button>
				    </div>
				    <div class="col-xs-3">
				    	<button class="btn btn-success" v-on:click="startMatch" v-bind:class="{'disabled':match_title == ''}">Start</button>
				    </div>		
				    <div class="col-xs-3">
				    	<button class="btn btn-danger" v-on:click="resetMatch">Reset</button>
				    </div>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
		</div>

		<!-- Match Table -->
		<div v-show="isStarted">	
			<div>
				<h4 class="text-left">
					<span class="text-primary">@{{ tournament.name }}</span>
					<div style="float:right">	
						<button v-on:click="editMatch" class="btn btn-info btn-xs" v-bind:class="isStarted? classEnabled : classDisabled">Edit Match</button>	
						<button v-on:click="confirmReset" class="btn btn-success btn-xs" v-bind:class="isStarted? classEnabled : classDisabled">New Match</button>	
					</div>
				</h4>
			</div>
			<div class="">			
				<table class="table col-xs-12">					
					<tr class="tr-games label-primary ">
						<th class="col-xs-9 th-games">@{{ match_title }}</th>
						<th class="col-xs- th-games"></th>
						<th class="col-xs- th-games"><span v-if="game_num >= 1">1</span></th>
						<th class="col-xs- th-games"><span v-if="game_num >= 2">2</span></th>
						<th class="col-xs- th-games"><span v-if="game_num >= 3">3</span></th>
						<th class="col-xs- th-games"><span v-if="game_num >= 4">4</span></th>
						<th class="col-xs- th-games"><span v-if="game_num >= 5">5</span></th>
					</tr>
					<tr>
						<td class="col-xs-9">
							<div class="player-sum">@{{ players[1].name }}								
								<i class="fa fa-circle fa-xs" 
									v-bind:class="[faults >= 1? classRed : classPurple]" 
									v-show="server == players[1].pos">
								</i> 
								<span class="player-sum" v-show="players[2].name != ''">&amp;</span>
								<span class="player-sum" v-show="players[2].name != ''">@{{ players[2].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[faults >= 1? classRed : classPurple]"  
										v-show="server == players[2].pos">
									</i>
								</span>
								<i v-show="isWinner == 1" class="fa fa-trophy text-warning"></i>
							</div>
							<div class="" v-show="isStarted">
								<button v-on:click="timeout(1)" data-toggle="modal" data-target="#timeoutModal1" class="btn btn-warning btn-xs" v-bind:class="isStarted && (team[1].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								  <span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[1].timeouts }}</span></button>
								<span class="" v-show="isStarted">
									<button v-on:click="appeal(1)" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[1].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[1].appeals  }}</span>
									</button>
								</span>
							</div>	
						</td>
						<td class="score">															
							<div class="" v-show="game_num > 1">								
								<span class="badge">@{{ team[1].wins }}</span>
							</div>
						</td>
						<td class="score" v-for="g in team[1].games" v-if="g.gm > 0" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">
							<span v-if="game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr>
						<td class="col-xs-9">
							<div class="player-sum">@{{ players[3].name }}
								<i class="fa fa-circle fa-xs" 
									v-bind:class="[faults >= 1? classRed : classPurple]" 
									v-show="server == players[3].pos ">
								</i>
								<span class="player-sum" v-show="players[4].name != ''">&amp;</span>
								<span class="player-sum" v-show="players[4].name != ''">@{{ players[4].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[faults >= 1? classRed : classPurple]" 
										v-show="server == players[4].pos ">
									</i>
								</span>
								<i v-show="isWinner == 2" class="fa fa-trophy text-warning"></i>
							</div>
							<div class="" v-show="isStarted">
								<button v-on:click="timeout(2)" data-toggle="modal" data-target="#timeoutModal2" class="btn btn-warning btn-xs" v-bind:class="isStarted && (team[2].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								<span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[2].timeouts }}</span></button>							
								<span class="col-xs" v-show="isStarted">
									<button v-on:click="appeal(2)" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[2].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[2].appeals  }}</span></button>
								</span>	
							</div>
						</td>
						<td class="score">
							<div class="col-xs" v-show="game_num > 1"><span class="badge">@{{ team[2].wins }}</span></div>
						</td>
						<td class="score" v-for="g in team[2].games"  v-if="g.gm > 0" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">
								<span v-if="game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr class="tr-games label-primary ">
						<td></td>
						<td class="th-games">&nbsp;</td>
						<td class="th-games game-time"><span class="" v-if="game_num >= 1" >@{{ timer.game[1] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="game_num >= 2" >@{{ timer.game[2] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="game_num >= 3" >@{{ timer.game[3] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="game_num >= 4" >@{{ timer.game[4] | secondsToTime }}</span></td>
						<td class=" th-games game-time"><span class="" v-if="game_num >= 5" >@{{ timer.game[5] | secondsToTime }}</span></td>						
					</tr>
					<tr class="tr-games label-info">
						<td colspan="5">&nbsp;</td>
						<td colspan="2" class=" th-games game-time"><span class="">@{{ timer.match | secondsToTime }}</span></td>
					</tr>
					<tr>
						<td colspan="7">
							<!-- Match Actions -->
							<div class="">
								<div class="btn-group col-xs-4">
									<a class="btn btn-default btn-xs" title="Edit Match" href="{{ route('scores.user.match', [$user->id]) }}">
										<i class="fa fa-step-backward"></i></a>

									<a class="btn btn-default btn-xs" v-bind:class="{'disabled': match.isComplete || match.isLive}" href="{{ route('scores.user.match', [$user->id]) }}">
									<i class="fa fa-play"></i></a>

									<a class="btn btn-default btn-xs" title="Pause Match" v-bind:class="{'disabled': match.isComplete || (!match.isLive && !match.isComplete) }" href="{{ route('scores.user.match', [$user->id]) }}">
									<i class="fa fa-pause"></i></a>
										
									<button class="btn btn-default btn-xs" title="Delete Match" v-on:click="confirmDelete(match)"><i class="fa fa-times"></i></button>
								</div>	
								<div class="btn-group col-xs-4">
									<sspan class="text-primary">Match is Live</span>
								</div>													
							</div>
							<!-- Modal Confirm Reset -->
							<div id="confirmDeleteModal" class="score modal fade" role="dialog">
							  <div class="modal-dialog">
							    <!-- Modal content-->
							    <div class="modal-content modal-success">
							      	<div class="modal-body">
								      	<div class="row">
											<center><h3>Are you sure you want to delete match @{{ delete_title }} ?</h3></center>
										</div>	
										<div class="row">
											<button type="button" v-on:click="deleteMatch(delete_id)" class="btn btn-success" data-dismiss="modal">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
										</div>
							      	</div>
							    </div>
							  </div>
							</div>
						</td>
					</tr>			
				</table>						
			</div>
			<div class="row">	
				<div class="col-xs-12">					
					<!-- div class="col-xs-3 text-center">
						<button v-on:click="endMatch" class="btn btn-danger btn-xs" v-bind:class="isStarted? classEnabled : classDisabled">Stop Match</button>
					</div -->
					<!-- div class="col-xs-4">
						<button v-on:click="resumeMatch" class="btn btn-warning btn-xs" v-bind:class="isStarted? classEnabled : classDisabled">Resume Match</button>
					</div -->					
				</div>	
			</div>
			<div class="row btn-actions">
				<div class="col-xs-6">		
					<button v-on:click="point" class="btn btn-block btn-success btn-lg" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-check"></i> Point</button>
					<button v-on:click="sideout" class="btn btn-block btn-danger btn-lg" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-refresh"></i> Out Serve</button>	
				</div>
				
				<div class="col-xs-6">	
					<button v-on:click="fault" class="btn btn-block btn-warning btn-lg" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-exclamation"></i> Fault</button>	
					<button v-on:click="undo" class="btn btn-block btn-default btn-lg" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-rotate-left"></i> Undo</button>					
				</div>
			</div>
			
	</div>

	<!-- Modal Team 1 Time out-->
	<div id="timeoutModal1" class="timeout modal fade" role="dialog">
	  <div class="modal-dialog alert-warning">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	       	 	<center>
		       	 	<h3 class="modal-title"><i class="fa fa-clock-o"></i> Time Out</h3>
		       	 	<h4>@{{ team[1].name}}</h4>
		       	 </center>
	      	</div>
	      <div class="modal-body alert-warning">
	        <center>
    	    	<h1><span class="timer"> @{{timer.team[1].timeout | timeoutToTime}}</h1></span>
            </center>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" v-on:click="timeout(1)" class="btn btn-default" data-dismiss="modal">Time In</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Team 2 Time out-->
	<div id="timeoutModal2" class="timeout modal fade" role="dialog">
	  <div class="modal-dialog alert-warning">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<center>
	      	 		<h3 class="modal-title"><i class="fa fa-clock-o"></i> Time Out</h3>
	      	 		<h4>@{{ team[2].name}}</h4>
	      	 	</center>
	      	</div>
	      <div class="modal-body alert-warning">
	        <center><h1><span class="timer"> @{{timer.team[2].timeout | timeoutToTime}}</h1></center>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" v-on:click="timeout(2)" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Welcome -->
	<div id="welcomeModal" class=" modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content alert-info">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h1><span class=""><i class="fa fa-circle purple"></i></span> Racquetball</h1></center>
					<center><h1><span class="">Referee <i class="fa fa-street-view text-info"></i></span></h1></center>
				</div>	
				<div class="row">
					<center><button type="button" class="btn btn-success" data-dismiss="modal">Get Started</button></center>
				</div>
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Intermission -->
	<div id="intermissionModal" class="intermission modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	 <h3 class="modal-title">Intermission</h3>
	      </div>
	      <div class="modal-body">
	        <center><h1><span class="label label-warning timer"> @{{timer.intermission[game_num - 1] | secondsToTime}}</h1></center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" v-on:click="intermission('stop')" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Score -->
	<div id="scoreModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-success">
		      	<div class="row">
					<center><h2>@{{ service  }} </h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Fault -->
	<div id="faultModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-warning">
		      	<div class="row">
					<center><h2>Fault</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Sideout/Handout -->
	<div id="sideoutModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-danger">
		      	<div class="row">
					<center><h2>@{{ sideout_type }}</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Undo -->
	<div id="undoModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-default">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h2>Undo @{{ last_step}}</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Winner-->
	<div id="winnerModal" class="winner modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body">
		      	<div class="row">
					<center>
						<h2><span class="text-warning"><i class="fa fa-trophy fa-3x"></i></span></h2>
						<h1> @{{ winner }}</h1>
					</center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Confirm Reset -->
	<div id="confirmResetModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h3>Are you sure you want to start a new match?</h3></center>
				</div>	
				<div class="row">
					<button type="button" v-on:click="resetMatch" class="btn btn-success" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
	      	</div>
	    </div>
	  </div>
	</div>

	<template id="player-template">
		<table>
			<tr>			
			</tr>
		</table>
	</template>
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

		var matchTimer;
		var gameTimer; //current game timer
		var injuryTimer; 
		var timeoutTimer;  //team timeouts
		var intermissionTimer; //timeout between games

		Vue.config.debug = true;
		Vue.config.devtools = true;

		Vue.component('my-player', {
			template:'#player-template',
			props: ['name', 'number'],
			data: function () {
				return {
					scores: [ 0, 0, 0, 0, 0],
					games: 0,
				}
			}
		});		

		var matchesRef = firebase.database().ref('matches');

		console.log(matchesRef);
		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: true,
				preview: false,
				classWin: 'win',
				classLoss: 'loss',
				classRed: 'red',
				classBlack: 'black',
				classPurple: 'purple',
				classEnabled: 'active',
				classDisabled: 'disabled',
				showSetup: true,
				isStarted: false,
				isLive: false,
				initServer: 1,
				server: 1,
				max_players: 4,
				score_steps: [],
				game_num: 1,
				tournaments: {id:0, name:''}, //[ {{ $tournaments}} ],
				tournament: {id:0, name:''},
				match_title: '',	
				delete_id: null,
				delete_title: '',			
				match: {
						id: 0,
						referee: {
									id: {{ $user->id}}, 
									name: '{{ $user->first_name}} {{ $user->last_name}}', 
								 },
						title: '',
						date: '',
						teams: [], 
						winner:'',
						isStarted: false,
						isComplete: false,
						completeDate: '',
						last_play: '',
						},
				sideout_type: 'Sideout',				
				service:'',
				last_step:'',
				timer: {
						match: 0 , 
						game: {
								1:0,
								2:0,
								3:0,
								4:0,
								5:0,
							},
						intermission: {
								1:0,
								2:0,
								3:0,
								4:0,
						},
						team: {
								1:{						
									timeout: 0, 
									injury: 0,
								},
								2:{						
									timeout: 0, 
									injury: 0,
								}
							}
				},
				faults: 0,
				score_max: 11,   // 11 or 15
				tiebreaker: 7,   // 7 or 11
				game_max: 2,     // 2 or 3
				total_games: 3,  // 3 or 5
				win_by: 1,       // 1 or 2
				winner: '',
				isWinner: 0,
				game: [],
				game_formats: [ 	
							{id: 0, name:''},
							{id: 1, name:'2 games to 11; Tie to 7',  
								games:3,  points:11, tie:7, win_by: 1, timeouts:2, timeout_secs:30, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:2},
							{id: 2, name:'2 games to 15; Tie to 11',  
								games:3,  points:15, tie:11, win_by: 1, timeouts:3, timeout_secs:30, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:2},
							{id: 3, name:'Best of 5 games to 11', 
								games:5,  points:11, tie:7, win_by: 2, timeouts:3, timeout_secs:60, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:3},
							{id: 4, name:'1 game to 11', games:1,  points:11, tie:0, win_by: 1, timeouts:1, timeout_secs:30, intermission_norm:0, intermission_tb:0, injury_secs:900, appeals:0},
							{id: 5, name:'1 game to 15', games:1,  points:15, tie:0, win_by: 1, timeouts:1, timeout_secs:30, intermission_norm:0, intermission_tb:0, injury_secs:900, appeals:0}
						],
				players: { 	1: {name:'', pos: 1 }, 
							2: {name:'', pos: 2 },  
							3: {name:'', pos: 3 }, 
							4: {name:'', pos: 4 }
						},			
				team: 	{
							1: 	
								{
									name: 'Team 1',
									placeholder: ['Enter Team Player 1', 'Enter Team Player 2'],
									serves:1,
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									games: {
										0: {score: 0, gm: 0 }, 
										1: {score: 0, gm: 1 }, 
										2: {score: 0, gm: 2 },
										3: {score: 0, gm: 3 },
										4: {score: 0, gm: 4 },
										5: {score: 0, gm: 5 },
									}
								},						
							2: 	
								{	
									name: 'Team 2',
									placeholder: ['Enter Team Player 1', 'Enter Team Player 2'],
									serves:1,
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									games: {
										0: {score: 0, gm: 0 },
										1: {score: 0, gm: 1 }, 
										2: {score: 0, gm: 2 },
										3: {score: 0, gm: 3 },
										4: {score: 0, gm: 4 },
										5: {score: 0, gm: 5 },
									}
								}
							}							
			},	
			mounted: function(){
				console.log('ready');
			},	
			firebase:{
				matches: matchesRef
			},						
			computed: {
				isDoubles: function(){		
					if(this.max_players == 2 ){
						this.team[1].name ="Player 1";
						this.team[2].name ="Player 2";
						this.team[1].placeholder[0] = "Enter Player 1";
						this.team[2].placeholder[0] = "Enter Player 2";
					}else {
						this.team[1].name ="Team 1";
						this.team[2].name ="Team 2";
						this.team[1].placeholder[0] = "Enter Team Player 1";
						this.team[2].placeholder[0] = "Enter Team Player 1";	
					}

					if (this.max_players == 4) {
						return true;
					}
					else {
						return false;
					}
				},
				isTiebreaker: function(){
					if(this.game_num == this.total_games) {
						this.score_max = this.game.tie;
						return true;
					}
					else {
						return false;				
					}
				}
			},
			filters: {
				secondsToTime: function(secs) {

					if (secs){
						secs = secs.toString();
						var date = new Date(null);
        				date.setSeconds(secs); // specify value for SECONDS here
        				return date.toISOString().substr(12, 7);
        			} else if (secs == 0)
        			{
        				return "";
        			}	

				},
				timeoutToTime: function(secs) {

					if (secs){
						secs = secs.toString();
						var date = new Date(null);
        				date.setSeconds(secs); // specify value for SECONDS here
        				return date.toISOString().substr(12, 7);
        			} else if (secs == 0)
        			{
        				return "Time is Up!";
        			}	

				}
			},				
			methods: {
				startMatch: function(event){
					this.isStarted = true;
					this.showSetup = false;
					this.startTimer('match');
					this.startTimer('game');

					this.match.isLive = true;
					this.updateMatchToDB();
				},
				createMatch: function(event){ 
					// enable point, sideout, fault, etc					
					
					this.total_games = this.game.games;
					this.score_max = this.game.points;

					//Team settings 
					if (this.isDoubles){
						if ((this.server == 1) || (this.server==2)){
							this.team[1].serves = 1;
						}
						else {
							this.team[2].serves = 2;
						}

						this.team[1].name = this.players[1].name + " & " + this.players[2].name;
						this.team[2].name = this.players[3].name + " & " + this.players[4].name;
					} else {
						this.team[1].name = this.players[1].name;
						this.team[2].name = this.players[3].name;
					}

					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;

					this.timer.team[1].injury = this.game.injury_secs;
					this.timer.team[2].injury = this.game.injury_secs;

					
					for (var i = 1; i <= this.total_games-1; i++) {
						if (i == this.total_games-1) {
							this.timer.intermission[i] = this.game.intermission_tb;
						}
						else{
							this.timer.intermission[i] = this.game.intermission_norm;
						}
					};

					this.match.date = new Date();
					this.addMatchToDB();
				
				},	
				addMatchToDB: function(){

					var newMatch = matchesRef; //firebase.database().ref('matches');
  					var newMatchKey = firebase.database().ref().child('matches').push().key;
					this.match.id = newMatchKey;

  					this.updateMatchToDB();

				},
				updateMatchToDB: function(){
					try{
						this.match.title = this.match_title;
						this.match.tournament = this.tournament;
						this.match.team = this.team;
						this.match.players = this.players;
						this.match.game_num = this.game_num;
						this.match.score_max = this.score_max;
						this.match.server = this.server;
						this.match.faults = this.faults;
						this.match.isWinner = this.isWinner;
						this.match.timer = this.timer;
						if (this.score_steps.length > 0) {
							this.match.last_step = this.score_steps[this.score_steps.length - 1];
						}
						var updates = {};
						updates['matches/'+ this.match.id] = this.match;
						return firebase.database().ref().update(updates);
					}
					catch (e){ 
						console.log('Error updateMatchToDB:' + err.message)
					}
				},
				confirmDelete: function(match){
					this.delete_id = match.id,
					this.delete_title = match.title;
					$('#confirmDeleteModal').modal('show');
				},
				deleteMatch: function(key){
					console.log('delete: ' + key);

					var ref = firebase.database().ref('matches').orderByChild("id").equalTo(key);
					console.log(ref);

					var updates = {};
					updates['matches/'+ key] = null;
					return firebase.database().ref().update(updates);
				},
				resumeMatch: function(match){

				},
				editMatch: function(){

				},
				confirmReset: function(){
					$('#confirmResetModal').modal('show');
				},			
				resetMatch: function(event){ 					
					this.endMatch();
					this.tournament = {id:0, name:''};
					this.match = {};

					this.match.referee = {
									id: {{ $user->id}}, 
									name: '{{ $user->first_name}} {{ $user->last_name}}', 
								 };

					// disable point, sideout, fault, etc
					this.isStarted = false;
					this.showSetup = true;
					this.players[1].name = '';
					this.players[2].name = '';
					this.players[3].name = '';
					this.players[4].name = '';		
		
					this.max_players = 4;		
					this.team[1].name ="Team 1";
					this.team[2].name ="Team 2";
					this.team[1].wins = 0;
					this.team[2].wins = 0;
					this.winner = '';
					this.isWinner = 0;
					this.game_num = 1;
					this.game = [];
					this.score_steps = [],
					this.match_title ='';
					this.service = '';
					this.server = 0;
					this.clearTimer('game');
					this.clearTimer('match');
					this.last_step = '';

					for (var i = 1; i <= 5; i++) {
						this.team[1].games[i].score = 0;
						this.team[2].games[i].score = 0;
					};					

				},	
				completeMatch: function(event){
					this.endMatch();

					this.match.isComplete = true;	
					this.match.isLive = false;
					this.match.completeDate = new Date();										
					
					this.updateMatchToDB();	
				},
				endMatch: function(event){
					this.match.isLive = false;
					this.score_steps.push('Matched Ended');

					this.stopTimer(gameTimer);
					this.stopTimer(matchTimer);

					this.updateMatchToDB();					
				},
				resumeMatch:function(event){
					this.starTimer(gameTimer);
					this.starTimer(matchTimer);
				},
				endGame: function(event){
					this.stopTimer(gameTimer);
					
					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;	
					this.updateMatchToDB();		
				},
				startTimer: function(name, teamNum){
					var that = this;			

					if (name == 'match') {
						matchTimer = setInterval(function(){
							that.timer.match +=1;
						}, 1000);
					}

					if (name == 'game') {
						gameTimer = setInterval(function(){
							that.timer.game[that.game_num] +=1;
						}, 1000);	
					}	

					if (name == 'timeout') {
						//reset timer
						that.timer.team[teamNum].timeout = that.game.timeout_secs;
						timeoutTimer = setInterval(function(){
							if (that.timer.team[teamNum].timeout > 0) {
								that.timer.team[teamNum].timeout -=1;
							}
						}, 1000);	
					}	

					if (name == 'injury') {						
						injuryTimer = setInterval(function(){
							that.timer.injury -=1;
						}, 1000);	
					}	

					if (name == 'intermission') {						
						intermissionTimer = setInterval(function(){
							if (that.timer.intermission[that.game_num-1] > 0) {
								that.timer.intermission[that.game_num-1] -=1;
							}
						}, 1000);	
					}				
				},
				stopTimer: function(timer){
					var that = this;
					clearInterval(timer);				
				},
				clearTimer: function(name){
					var that = this;
					if (name == 'match') {
						that.timer.match = 0;
					}	
					if (name == 'game') {
						that.timer.game[that.game_num] = 0;
					}	
					if (name == 'timeout') {
						that.timer.timeout = 0;
					}	
					if (name == 'injury') {
						that.timer.injury = 0;
					}			
				},
				countDownTimer: function (duration, display) {
					var that = this;
				    var timer = duration, minutes, seconds;
				    setInterval(function () {
				        minutes = parseInt(timer / 60, 10);
				        seconds = parseInt(timer % 60, 10);

				        minutes = minutes < 10 ? "0" + minutes : minutes;
				        seconds = seconds < 10 ? "0" + seconds : seconds;

				        display.textContent = minutes + ":" + seconds;

				        if (--timer < 0) {
				            timer = duration;
				        }
				    }, 1000);
				},
				totalPoints: function(team) {
					var total = 0;
					for (var i = 1; i <= this.game_num ; i++) {
						console.log('total points:' + total)
						total += team.games[i].score;
					};
					console.log('total points:' + total)
					return total;

				},
				changeInitServer: function(options){
					this.initServer = options.pos;
				},			
				point: function (event){
					this.faults = 0;
					this.score_steps.push('point');
					
					//Add point to serving team
					if (this.server < 3) {
						this.team[1].games[this.game_num].score +=1;
					}
					else {
						this.team[2].games[this.game_num].score +=1;
					}					

					//Did Team 1 win the game?
					if ((this.team[1].games[this.game_num].score >= this.score_max) && 
						((this.team[1].games[this.game_num].score - this.team[2].games[this.game_num].score) >= this.win_by))
					{
						//Game is over
						this.endGame();
						this.team[1].wins +=1;

						if (this.isMatchOver()) {
							return true;
						}else {							
							this.intermission('start');
							$('#intermissionModal').modal('show');
							
							this.game_num+=1;
							//Change serving Team start of next game
							this.changeServingTeam();
						}
					}
					else {
						this.showScore();
					}

					//Did Team 2 win the game?
					if ((this.team[2].games[this.game_num].score >= this.score_max) && 
						((this.team[2].games[this.game_num].score - this.team[1].games[this.game_num].score) >= this.win_by))
					{
						//Game is over
						this.endGame();
						this.team[2].wins += 1;

						if (this.isMatchOver()) {
							return true;
						}else {							
							this.intermission('start');
							$('#intermissionModal').modal('show');

							this.game_num+=1;
							//Change serving Team start of next game
							this.changeServingTeam();
						}
					}
					else {					
						this.showScore();
					}

					this.updateMatchToDB();
					
				},
				isMatchOver:function (event){
					console.log('team 1 wins:' + this.team[1].wins + ' needs: ' + this.game_max + " is:" +  (this.team[1].wins == this.game_max));
					if (this.team[1].wins == this.game_max) {
						console.log('show winner');
						this.winner = 'The winner is ' + this.team[1].name;
						this.isWinner=1;
						$('#winnerModal').modal('show');
						this.completeMatch();
						return true;					
					}
					if (this.team[2].wins == this.game_max) {
						this.winner = 'The winner is ' + this.team[2].name;
						this.isWinner=2;
						$('#winnerModal').modal('show');
						this.completeMatch();
						return true;					
					}

					return false;
				},
				undoPoint: function (event){
					//restore any faults
                    this.restoreFault();

                    //check if start of new game, but not the first game
                    if ((this.game_num > 1) && (this.team[1].games[this.game_num].score + this.team[2].games[this.game_num].score == 0 )) {
                    	this.game_num -= 1;
                    	//decrement team_game
                    	//team[1].wins -=1;
                    	//team[2].wins -=2;
                    	this.undoServingTeam();
                    }

                    //remove point
                    if (this.server < 3) {
						this.team[1].games[this.game_num].score -= 1;
					}
					else {
						this.team[2].games[this.game_num].score = 1;
					}
					this.showScore();
					this.updateMatchToDB();		
				},
				fault: function (event){

					this.faults +=1;

					if (this.faults == 2 ) {
					    this.score_steps.push('doublefault');
						this.sideout(event);
					}else {
					    this.score_steps.push('fault');
					    $('#faultModal').modal('show');	
					};					
					this.updateMatchToDB();		
				},
				undoFault: function (event){
					this.faults = 0;
					this.updateMatchToDB();		
				},
				restoreFault: function(event){ 
					//restore any faults
                    last_step = this.score_steps.pop();
                    if (last_step == 'fault'){
                    	this.faults = 1;
                    	this.score_steps.push(last_step);
                    }
                    if (last_step == 'doublefault'){
                    	this.faults = 1;
                    }
                    //this.score_steps.push(last_step);
				},
				sideout: function (event){
					
					this.sideout_type = 'Sideout';
					if ((this.server == 1) || this.server == 2){
						this.team[1].serves -=1;
						if (this.team[1].serves > 0) {
							if (this.server == 1) {
								this.server = 2;
								this.sideout_type = 'Handout';
							}
							else{
								this.server = 1;
							}
						}else { //Serve goes to Team 2
							if (this.isDoubles){
								this.team[1].serves = 2;
							}
							else {
								this.team[1].serves = 1;
							}
							this.server = 3;
						}
					}else{
						this.team[2].serves -=1;
						if (this.team[2].serves > 0) {
							if (this.server == 3) {
								this.server = 4;
								this.sideout_type = 'Handout';
							}
							else{
								this.server = 3;
							}
						}else { //Serve goes to Team 1
							if (this.isDoubles){
								this.team[2].serves = 2;
							}
							else {
								this.team[2].serves = 1;
							}
							this.server = 1;
						}
					}

					this.score_steps.push(this.sideout_type);
					this.faults = 0;
					$('#sideoutModal').modal('show');	
					this.showScore();
					this.updateMatchToDB();		
				},
				undoSideout: function (event){				
					this.restoreFault();

                    if (this.isDoubles) {
						if (this.server == 1 ) {
							this.server = 4;
						}
						else {
							this.server -= 1;
						}
					}
					else {
						if (this.server == 1) {
							this.server = 3;
						}
						else {
							this.server = 1;
						}
					};
					this.updateMatchToDB();		
				},
				timeout: function(teamNum) {

					if (timeoutTimer) {
						this.stopTimer(timeoutTimer);
						timeoutTimer = undefined;
					} else {
						if (this.team[teamNum].timeouts > 0 ){
							this.team[teamNum].timeouts-=1;
							this.startTimer('timeout', teamNum);
						}
						else {
							console.log('No more timeouts');
						}
					}	
					this.updateMatchToDB();		
				},
				intermission: function(action) {

					if (action =='stop') {
						this.stopTimer(intermissionTimer);
						intermissionTimer = undefined;
						this.startTimer('game');	
					} else {
						this.startTimer('intermission');						
					}	
					this.updateMatchToDB();		
				},
				undoTimeout: function(event){

				},
				appeal: function(teamNum) {
					this.team[teamNum].appeals-=1;					
				},
				undoAppeal: function(event){

				},
				changeServingTeam: function(event){
					//Change server start of next game					
					if (this.isTiebreaker) {
						//Team with most points previous game serves. and gets one service	
						if (this.totalPoints(this.team[1]) > this.totalPoints(this.team[2])) {
							console.log('team 1 serves tiebreaker');
							this.server  = 1;
							this.initServer = 1;
						}
						else{
							console.log('team 2 serves tiebreaker');
							this.server  = 3;
							this.initServer = 3;
						}											
					}
					else {
						//Alternate serving team
						if (this.initServer == 1) {
							this.server  = 3;
							this.initServer = 3;
						}
						else{
							this.server  = 1;
							this.initServer = 1;
						}
					}
					this.score_steps.push('changeServingTeam');
					this.updateMatchToDB();		
				},
				undoServingTeam: function(event){
					//Change server start of next game
					//tiebreaker
					//???				
					
					//Alternate serving team
					if (this.initServer == 1) {
						this.server  = 3;
						this.initServer = 3;
					}
					else{
						this.server  = 1;
						this.initServer = 1;
					}
					this.updateMatchToDB();		
				},				
				undo: function(){

					this.last_step = this.score_steps.pop();
					switch (this.last_step) {
						case "point":
							this.undoPoint();                            
							break;
						case "fault":
							this.undoFault();					
							break;
						case "doublefault":
							this.faults = 1;
							this.last_step = this.score_steps.pop();
                            if (this.last_step == 'changeServingTeam'){
                            	this.undoServingTeam();
                            }else if(this.last_step == 'sideout' || this.last_step == 'handout') {
                            	this.undoSideout();
                            }	
							break;
						case "sideout":
							this.undoSideout();
							break;
						case "undo":

							break;						
					}
					$('#undoModal').modal('show');	
					this.updateMatchToDB();		
				},
				showScore: function(event){
					console.log('show score');
					if (this.server < 3) {
						this.service = this.team[1].games[this.game_num].score + " - " + this.team[2].games[this.game_num].score;
					}
					else{
						this.service = this.team[2].games[this.game_num].score + " - " + this.team[1].games[this.game_num].score;
					}
					$('#scoreModal').modal('show');	
				},
			}
		});	
		window.vue = vm;
	</script>

	<script type="text/javascript">         //<![CDATA[
     window.addEventListener('load', function() {
          var maybePreventPullToRefresh = false;
          var lastTouchY = 0;
          var touchstartHandler = function(e) {
            if (e.touches.length != 1) return;
            lastTouchY = e.touches[0].clientY;
            // Pull-to-refresh will only trigger if the scroll begins when the
            // document's Y offset is zero.
            maybePreventPullToRefresh =
                window.pageYOffset == 0;
          }

          var touchmoveHandler = function(e) {
            var touchY = e.touches[0].clientY;
            var touchYDelta = touchY - lastTouchY;
            lastTouchY = touchY;

            if (maybePreventPullToRefresh) {
              // To suppress pull-to-refresh it is sufficient to preventDefault the
              // first overscrolling touchmove.
              maybePreventPullToRefresh = false;
              if (touchYDelta > 0) {
                e.preventDefault();
                return;
              }
            }
          }

          document.addEventListener('touchstart', touchstartHandler, false);
          document.addEventListener('touchmove', touchmoveHandler, false);      });
            //]]>    
    </script>
@stop