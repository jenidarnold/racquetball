@extends('layouts.app')

@section('style')
	<style>
		.player {
			font-weight: 500;
			font-size: 14pt;
		}
		.player-sum {
			font-weight: 200;
			font-size: 10pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 8pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 8pt;
		}
		.score {
			font-weight: 500;
			font-size: 8pt;
			text-align: center;
		}
		.th-games {
			text-align: center;
		}
		.tr-games {
			font-weight: 300;
			font-size: 8pt;
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
	    	background-color: red;
		}
		.winner .modal-backdrop {
	    	background-color: green;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="panel panel-primary" v-show="showSetup">			
			<div class="panel-heading"><h3>Score Keeper</h3></div>
			<div class="panel-body">	
				<form class="form-inline1" role="form">	
					<div class="row">			
				    	<h3>1. Setup Match Format</h3>
					    <div class="col-xs-12 col-sm-4 form-group">
							<label for="title" class="control-label lbl-team">Match Title:</label>
							<input class="form-control" id="title" placeholder="Enter Match Title" v-model="match_title">
					    </div>
					    <div class="col-xs-12 col-sm-4 form-group">				    
							<label for="game_format" class="control-label lbl-team">Game Format: </label>
							<select v-model="game" id="game_format" class="form-control">
									  <option v-for="game in game_formats" v-bind:value="game">
									    @{{ game.name }}
									  </option>
							</select>					
						 	<i class="fa fa-clock-o"></i> Time outs: @{{ game.timeouts }}
						 	<i class="fa fa-thumbs-down"></i> Appeals: @{{ game.appeals }}
						</div>
					</div>
					<div class="row">
						<h3>2. Setup Players</h3>				
						<div class="col-xs-12  col-sm-4 form-group">
							<label for="team1" class="control-label lbl-team ">Team 1:</label>
						    <input class="form-control" id="team1" v-model="players[1].name">
						    <input class="form-control" v-model="players[2].name">
						</div>				
						<div class="col-xs-12  col-sm-4 form-group">
						    <label for="team2" class="control-label lbl-team ">Team 2:</label>
						    <input class="form-control" id="team2" v-model="players[3].name">
						    <input class="form-control" v-model="players[4].name">
						</div>						
					</div>
					<div class="row">	
						<h3>3. Select Starting Server</h3>
						<div class="col-xs-12 col-sm-4 form-group">
							<select v-model="server" class="form-control col-xs-12 col-sm-12">
							  	<option v-for="player in players" v-bind:value="player.pos">
							    	@{{ player.name }}
							  	</option>
							</select>	
						</div>
					</div>	
				</form>
			</div>
			<div class="panel-footer">
			    <button class="btn btn-success" v-on:click="createMatch">Start</button>
			    <button class="btn btn-danger" v-on:click="resetMatch">Reset</button>
			</div>
		</div>
		<div class="panel panel-primary" v-show="isStarted">
			<div class="panel-heading">	
				<h3> 
					@{{ match_title }}
				</h3>
			</div>
			<div class="panel-body">
				<table class="table col-xs-12">
					<tr class="tr-games label-info ">
						<th class="col-xs-9 th-games"></th>
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
									v-bind:class="[faults >= 1? classRed : classBlack]" 
									v-show="server == players[1].pos">
								</i> 
								<span class="player-sum" v-show="players[2].name != ''">/</span>
								<span class="player-sum" v-show="players[2].name != ''">@{{ players[2].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == players[2].pos">
									</i>
								</span>
							</div>
							<div class="" v-show="isStarted">
								<button v-on:click="timeout(1)" data-toggle="modal" data-target="#timeoutModal1" class="btn btn-warning btn-xs" v-bind:class="isStarted && (team[1].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								  <span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[1].timeouts }}</span></button>
								<span class="" v-show="isStarted">
									<button v-on:click="appeal" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[1].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[1].appeals  }}</span>
									</button>
								</span>
							</div>	
						</td>
						<td class="score">															
							<div class="" v-show="game_num > 1">
								<span class="badge">@{{ team[1].wins }}</span>
							</div>
						</td>
						<td class="score" v-for="g in team[1].games" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">
								<span v-if="game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr>
						<td class="col-xs-9">
							<div class="player-sum">@{{ players[3].name }}
								<i class="fa fa-circle fa-xs" 
									v-bind:class="[faults >= 1? classRed : classBlack]" 
									v-show="server == players[3].pos ">
								</i>
								<span class="player-sum" v-show="players[4].name != ''">/</span>
								<span class="player-sum" v-show="players[4].name != ''">@{{ players[4].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == players[4].pos ">
									</i>
								</span>
							</div>
							<div class="" v-show="isStarted">
								<button v-on:click="timeout(2)" data-toggle="modal" data-target="#timeoutModal1" class="btn btn-warning btn-xs" v-bind:class="isStarted && (team[2].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								<span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[2].timeouts }}</span></button>							
								<span class="col-xs" v-show="isStarted">
									<button v-on:click="appeal" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[2].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[2].appeals  }}</span></button>
								</span>	
							</div>
						</td>
						<td class="score">
							<div class="col-xs" v-show="game_num > 1"><span class="badge">@{{ team[2].wins }}</span></div>
						</td>
						<td class="score" v-for="g in team[2].games" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">
								<span v-if="game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr class="tr-games label-info ">
						<td></td>
						<td class="th-games"></td>
						<td class=" th-games"><span class="label label-primary" v-if="game_num >= 1" >@{{ timer.game[1] | secondsToTime }}</span></td>
						<td class=" th-games"><span class="label label-primary" v-if="game_num >= 2" >@{{ timer.game[2] | secondsToTime }}</span></td>
						<td class=" th-games"><span class="label label-primary" v-if="game_num >= 3" >@{{ timer.game[3] | secondsToTime }}</span></td>
						<div class=" th-games"><span class="label label-primary" v-if="game_num >= 4" >@{{ timer.game[4] | secondsToTime }}</span></td>
						<td class=" th-games"><span class="" v-if="game_num >= 5" >@{{ timer.game[5] | secondsToTime }}</span></td>
						<td class=" th-games"><span class="label label-success">@{{ timer.match | secondsToTime }}</span></td>
					</tr>
				</table>						
				
				<div class="">
					<div class="col-xs-12">		
						<button v-on:click="point" class="btn btn-success btn-sm" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-check"></i> Point</button>
						<button v-on:click="sideout" class="btn btn-danger btn-sm" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-refresh"></i> Side Out</button>	
						<button v-on:click="fault" class="btn btn-warning btn-sm" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-exclamation"></i> Fault</button>							
					</div>
				</div>
				<div class="">	
					<div class="col-xs-12 col-sm-offset-4">
						<button v-on:click="undo" class="btn btn-default btn-sm" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-rotate-left"></i> Undo</button>	
						<button v-on:click="endMatch" class="btn btn-default btn-sm" v-bind:class="isStarted? classEnabled : classDisabled">End</button>	
						<button v-on:click="resetMatch" class="btn btn-default btn-sm" v-bind:class="isStarted? classEnabled : classDisabled">New</button>	
					</div>	
				</div>	
			</div>
	</div>

	<!-- Modal Team 1 Time out-->
	<div id="timeoutModal1" class="timeout modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	       	<h3 class="modal-title">Team 1 Time Out!</h3>
	      </div>
	      <div class="modal-body">
	        <center>
    	    	<h1><span class="label label-warning timer"> @{{timer.team[1].timeout | secondsToTime}}</h1></span>
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
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	 <h3 class="modal-title">Team 2 Time Out!</h3>
	      </div>
	      <div class="modal-body">
	        <center><h1><span class="label label-warning timer"> @{{timer.team[2].timeout | secondsToTime}}</h1></center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" v-on:click="timeout(2)" class="btn btn-default" data-dismiss="modal">Close</button>
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

	<!-- Modal Winner-->
	<div id="winnerModal" class="winner modal fade" role="dialog" v-if="winnner != ''">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h2>@{{ winner }}</h2></center>
				</div>	
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" v-on:click="timeout(2)" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
	  </div>
	</div>

	<div>
     @{{ debug| json }}
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
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>

		var matchTimer;
		var gameTimer; //current game timer
		var injuryTimer; 
		var timeoutTimer;  //team timeouts
		var intermissionTimer; //timeout between games

		Vue.config.debug = true;

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

		new Vue({
			el: '#myvue',
			data: {	
				debug: true,
				preview: false,
				classWin: 'win',
				classLoss: 'loss',
				classRed: 'red',
				classBlack: 'black',
				classEnabled: 'active',
				classDisabled: 'disabled',
				showSetup: true,
				isStarted: false,
				initServer: 1,
				server: 1,
				score_steps: [],
				game_num: 1,
				match_title: '',
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
				game: [],
				game_formats: [ 	
							{id: 1, name:'Two games to 11; Tie to 7',  games:3,  points:11, tie:7, win_by: 1, timeouts:2, timeout_secs:5, intermission_norm:10, intermission_tb:15, injury_secs:10, appeals:3},
							{id: 2, name:'Two games to 15; Tie to 11',  games:3,  points:15, tie:11, win_by: 1, timeouts:3, timeout_secs:6, intermission_norm:10, intermission_tb:15, injury_secs:15, appeals:3},
							{id: 3, name:'Best of 5 games to 11', games:5,  points:11, tie:7, win_by: 2, timeouts:3, timeout_secs:7, intermission_norm:10, intermission_tb:15, injury_secs:20, appeals:3},
							{id: 4, name:'One game to 11', games:1,  points:11, tie:0, win_by: 1, timeouts:1, timeout_secs:9, intermission_norm:10, intermission_tb:15, injury_secs:0, appeals:0},
							{id: 5, name:'One game to 15', games:1,  points:15, tie:0, win_by: 1, timeouts:1, timeout_secs:9, intermission_norm:10, intermission_tb:15, injury_secs:0, appeals:0}
						],
				players: { 	1: {name:'Player 1', pos: 1 }, 
							2: {name:'Player 2', pos: 2 },  
							3: {name:'Player 3', pos: 3 }, 
							4: {name:'Player 4', pos: 4 }
						},			
				team: 	{
							1: 	
								{
									serves:1,
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									games: {
										1: 	{
												score: 0, gm: 1
											}, 
										2: {
												score: 0, gm: 2
											},
										3: {
												score: 0, gm: 3, 
											},
										4: {
												score: 0, gm: 4, 
											},
										5: {
												score: 0, gm: 5, 
											},
										}
								},						
							2: 	
								{
									serves:1,
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									games: {
										1: 	{
												score: 0, gm: 1
											}, 
										2: {
												score: 0, gm: 2
											},
										3: {
												score: 0, gm: 3, 
											},
										4: {
												score: 0, gm: 4, 
											},
										5: {
												score: 0, gm: 5, 
											},
										}
								}
							}							
			},								
			computed: {
				isDoubles: function(){	
									
					if (this.max_players == 4) {
						return true;
					}
					else {
						return false;
					}
				},
				isTiebreaker: function(){
					if(this.game_num == this.total_games) {
						this.score_max = this.tiebreaker;
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
        				return date.toISOString().substr(11, 8);
        			} else if (secs == 0)
        			{
        				return "";
        			}	

				}
			},				
			methods: {
				createMatch: function(event){ 
					// enable point, sideout, fault, etc
					this.isStarted = true;
					this.showSetup = false;
					this.initServer = this.server;
					this.startTimer('match');
					this.startTimer('game');

					//Set # of players
					this.max_players = 0;
					if (this.players[1].name != ''){
						this.max_players+=1; 
					}
					if (this.players[2].name != ''){
						this.max_players+=1; 
					}
					if (this.players[3].name != ''){
						this.max_players+=1; 
					}
					if (this.players[4].name != ''){
						this.max_players+=1; 
					}	


					this.total_games = this.game.games;

					//Team settings 
					if (this.isDoubles){
						if ((this.server == 1) || (this.server==2)){
							this.team[1].serves = 1;
						}
						else {
							this.team[2].serves = 2;
						}
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

				},
				resetMatch: function(event){ 
					// disable point, sideout, fault, etc
					this.isStarted = false;
					this.showSetup = true;
					this.players[0].name = 'Player 1';
					this.players[1].name = 'Player 2';
					this.players[2].name = 'Player 3';
					this.players[3].name = 'Player 4';
					this.max_players = 0;		
					this.winner = '';
					this.game_num = 1;


					this.team[1].serves = 1;
					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].serves = 1;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;

					this.endMatch();
					$('#winnerModal').modal('show');
				},	
				endMatch: function(event){
					this.stopTimer(gameTimer);
					this.stopTimer(matchTimer);
				},
				endGame: function(event){
					this.stopTimer(gameTimer);
					
					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;

					if (this.game_num < this.total_games){
						this.intermission('start');
						$('#intermissionModal').modal('show');
					}
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
				changeInitServer: function(options){
					this.initServer = options.pos;
				},			
				point: function (event){
					this.faults = 0;
					this.score_steps.push('point');

					if (this.isTiebreaker){

					}

					if (this.server < 3) {
						this.team[1].games[this.game_num].score +=1;
					}
					else {
						this.team[2].games[this.game_num].score +=1;
					}					

					if ((this.team[1].games[this.game_num].score >= this.score_max) && 
						((this.team[1].games[this.game_num].score - this.team[2].games[this.game_num].score) >= this.win_by))
					{
						//Game is over
						this.endGame();
						this.game_num+=1;
						this.team[1].wins +=1;

						//Change serving Team start of next game
						this.changeServingTeam();
					}
					if ((this.team[2].games[this.game_num].score >= this.score_max) && 
						((this.team[2].games[this.game_num].score - this.team[1].games[this.game_num].score) >= this.win_by))
					{
						this.game_num+= 1;
						this.team[2].wins += 1;

						this.changeServingTeam();
					}

					if (this.team[1].wins == this.game_max) {
						this.winner = 'The winner is ' + this.players[0].name + ' & ' + this.players[1].name;
						$('#winnerModal').modal('show');
					}

					if (this.team[2].wins == this.game_max) {
						this.winner = 'The winner is ' + this.players[2].name + ' & ' + this.players[3].name;
						$('#winnerModal').modal('show');
					}
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
				},
				fault: function (event){
					this.faults +=1;

					if (this.faults == 2 ) {
					    this.score_steps.push('doublefault');
						this.sideout(event);
					}else {
					    this.score_steps.push('fault');
					};
				},
				undoFault: function (event){
					this.faults = 0;
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
					this.score_steps.push('sideout');
					this.faults = 0;

					if ((this.server == 1) || this.server == 2){
						this.team[1].serves -=1;
						if (this.team[1].serves > 0) {
							if (this.server == 1) {
								this.server = 2;
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
							alert('No more timeouts');
						}
					}	
				},
				intermission: function(action) {

					if (action =='stop') {
						this.stopTimer(intermissionTimer);
						intermissionTimer = undefined;
						this.startTimer('game');	
					} else {
						this.startTimer('intermission');						
					}	
				},
				undoTimeout: function(event){

				},
				appeal: function(event) {

				},
				undoAppeal: function(event){

				},
				changeServingTeam: function(event){
					//Change server start of next game
					//tiebreaker							
					for (var i in this.team[2].games)
					{
						//alert(i);
						t1+= this.team[2].games[i].score;
						//alert(t1);
					}

					if(this.game_num == this.total_games) {
						var t1;
						var t2;

						for (var i in this.team[2].games)
						{
							t1+= this.team[2].games[i].score;
						}						
					}
					//Alternate serving team
					if (this.initServer == 1) {
						this.server  = 3;
						this.initServer = 3;
					}
					else{
						this.server  = 1;
						this.initServer = 1;
					}
					this.score_steps.push('changeServingTeam');
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
				},
				undo: function(){

					var last_step = this.score_steps.pop();
					switch (last_step) {
						case "point":
							this.undoPoint();                            
							break;
						case "fault":
							this.undoFault();					
							break;
						case "doublefault":
							this.faults = 1;
							last_step = this.score_steps.pop();
                            if (last_step == 'changeServingTeam'){
                            	this.undoServingTeam();
                            }else if(last_step == 'sideout') {
                            	this.undoSideout();
                            }	
							break;
						case "sideout":
							this.undoSideout();
							break;
						case "undo":

							break;						
					}
				}
			}
		});	
	</script>
@stop