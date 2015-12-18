@extends('layouts.app')

@section('style')
	<style>
	.player {
		font-weight: 500;
		font-size: 14pt;
	}
	.win{
		font-weight: 500;
		color: green;
		font-size: 14pt;
	}
	.loss{
		font-weight: 500;
		color: red;
		font-size: 14pt;
	}
	.score{
		font-weight: 500;
		font-size: 14pt;
		text-align: center;
	}

	.th-games {
		text-align: center;
	}
	.tr-games{
		font-weight: 700;
		font-size: 14pt;
	}

	.red{
		color:red;
	}

	.black{
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
	}
	.lbl-team {
		font-weight: 700;
		font-size: 14pt;
	}
	.timer {
		text-align: center;
	}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="panel panel-primary" v-show="showSetup">			
			<div class="panel-heading"><h3>Setup</h3></div>
			<div class="panel-body">	
				<form class="form-inline" role="form">
					<h4><i class="fa fa-clock-o"></i> Game Format: 
						<select v-model="game" class="form-control">
								  <option v-for="game in game_formats" v-bind:value="game">
								    @{{ game.name }}
								  </option>
						</select>
					 	<i class="fa fa-clock-o"></i> Time outs: @{{ game.timeouts }}
					 	<i class="fa fa-thumbs-down"></i> Appeals: @{{ game.appeals }}
					</h4>
					<h4><i class="fa fa-user-plus"></i> Players</h4>
					<div class="row">									
						<div class="col-xs-12 form-group">
							<label for="team1" class="control-label lbl-team indent">Team 1</label>
						    <input class="form-control" id="team1" placeholder="Player 1" v-model="player1_name">
						    <input class="form-control" placeholder="Player 2" v-model="player2_name">
						</div>				
						<div class="col-xs-12 form-group">
						    <label for="team2" class="control-label lbl-team indent">Team 2</label>
						    <input class="form-control" id="team2" placeholder="Player 1" v-model="player3_name">
						    <input class="form-control" placeholder="Player 2" v-model="player4_name">
						</div>						
					</div>
					<h4><i class="fa fa-circle"></i> Starting Server
						<select v-model="server" class="form-control">
								  <option v-for="player in players" v-bind:value="player.pos">
								    @{{ player.name }}
								  </option>
						</select>
					</h4>
					
				</form>
			</div>
			<div class="panel-footer">
			    <button class="btn btn-success" v-on:click="createMatch">Start</button>
			    <button class="btn btn-danger" v-on:click="resetMatch">Reset</button>
			    <input type="checkbox" id="chkPreview" v-model="preview">
				<label for="chkPreview">Preview</label>
			</div>
		</div>
		<div class="panel panel-primary" v-show="isStarted || preview">
			<div class="panel-heading">				
				<div class="row">
					<div class="col-xs-6 alert alert-success" v-if="winner !=''">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<h2>@{{ winner }}</h2>			
					</div>
				</div>	
			</div>
			<div class="panel-body">
				<div class="row">			
					<table class="table table-condensed col-md-12">
						<tr class="tr-games label-info ">
							<th></th>
							<th class="th-games"></th>
							<th class="col-xs-1 th-games">1</th>
							<th class="col-xs-1 th-games">2</th>
							<th class="col-xs-1 th-games">3</th>
							<th class="col-xs-1 th-games">4</th>
							<th class="col-xs-1 th-games">5</th>
							<th class="col-xs-1 th-games"></th>
						</tr>
						<tr>
							<td>								
								<div class="player col-md-4">
									@{{ player1_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player1_num">
									</i> 
								</div>
								<div class="player col-md-1"v-show="player2_name != ''">/</div>
								<div class="player col-md-4"v-show="player2_name != ''">
									@{{ player2_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player2_num">
									</i>
								</div>
							</td>							
							<td class="score">
								<div class="col-xs-4" v-show="isStarted">
									<button v-on:click="timeout(1)" data-toggle="modal" data-target="#timeoutModal1" class="btn btn-warning btn-xs" v-bind:class="isStarted && (team[1].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
									  <span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[1].timeouts }}</span>									  
									  </button>
									</div>
								<div class="col-xs-4" v-show="isStarted">
									<button v-on:click="appeal" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[1].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[1].appeals  }}</span></button>
								</div>								
								<div class="col-xs-1" v-show="game_num > 1">
									<span class="badge">@{{ team[1].wins }}</span>
								</div>
							</td>
							<td class="score" v-for="g in team[1]" v-if="game_num >= g.gm" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} 								
							</td>
						</tr>
						<tr>
							<td>								
								<div class="player col-md-4">
									@{{ player3_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player3_num ">
									</i>
								</div>
								<div class="player col-md-1"v-show="player4_name != ''">/</div>
								<div class="player col-md-4"v-show="player4_name != ''">
									@{{ player4_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player4_num ">
									</i>
								</div>
							</td>
							<td class="score">
								<div class="col-xs-4" v-show="isStarted">
									<button v-on:click="timeout(2)" data-toggle="modal" data-target="#timeoutModal2" class="btn btn-warning btn-xs" v-bind:class="isStarted && team[2].timeouts > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ team[2].timeouts }}</span>
									</button>
								</div>
								<div class="col-xs-4" v-show="isStarted">
									<button v-on:click="appeal" class="btn btn-danger btn-xs" v-bind:class="isStarted && team[2].appeals > 0? classEnabled : classDisabled"> <span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ team[2].appeals  }}</span></button>
								</div>								
								<div class="col-xs-1"v-show="game_num > 1"><span class="badge">@{{ team[2].wins }}</span></div>
							</td>
							<td class="score" v-for="g in team[2]" v-if="game_num >= g.gm" v-bind:class="[g.score < score_max && g.gm < game_num? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} </td>
						</tr>
						<tr class="tr-games label-info ">
							<th></th>
							<th class="th-games"></th>
							<th class="col-xs-1 th-games"><span class="label label-primary" v-if="game_num >= 1" >@{{ timer.game[1] | secondsToTime }}</span></th>
							<th class="col-xs-1 th-games"><span class="label label-primary" v-if="game_num >= 2" >@{{ timer.game[2] | secondsToTime }}</span></th>
							<th class="col-xs-1 th-games"><span class="label label-primary" v-if="game_num >= 3" >@{{ timer.game[3] | secondsToTime }}</span></th>
							<th class="col-xs-1 th-games"><span class="label label-primary" v-if="game_num >= 4" >@{{ timer.game[4] | secondsToTime }}</span></th>
							<th class="col-xs-1 th-games"><span class="label label-primary" v-if="game_num >= 5" >@{{ timer.game[5] | secondsToTime }}</span></th>
							<th class="col-xs-1 th-games"><span class="label label-success">@{{ timer.match | secondsToTime }}</span></th>
						</tr>
					</table>				
				</div>
			</div>
			<div class="panel-footer">			 
				<div class="row">
					<div class="col-xs-6">		
						<button v-on:click="point" class="btn btn-success" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-check"></i> Point</button>
						<button v-on:click="sideout" class="btn btn-danger" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-refresh"></i> Side Out</button>	
						<button v-on:click="fault" class="btn btn-warning" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-exclamation"></i> Fault</button>	
						<button v-on:click="undo" class="btn btn-default" v-bind:class="isStarted? classEnabled : classDisabled"><i class="fa fa-rotate-left"></i> Undo</button>					
					</div>
					<div class="col-xs-1 col-xs-offset-4">
						<button v-on:click="endMatch" class="btn btn-default" v-bind:class="isStarted? classEnabled : classDisabled">End</button>	
					</div>	
					<div class="col-xs-1">
						<button v-on:click="resetMatch" class="btn btn-default" v-bind:class="isStarted? classEnabled : classDisabled">New</button>	
					</div>	
				</div>			
		</div>
		<div class="panel">
			<div class="panel-body">				
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div id="timeoutModal1" class="modal fade" role="dialog">
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

	<!-- Modal -->
	<div id="timeoutModal2" class="modal fade" role="dialog">
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

	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row col-xs-12">
				<input type="checkbox" id="chkDebug" v-model="debug">
				<label for="chkDebug">Debug</label>
			</div>
			<div class="row" v-show = "debug">
			    @{{ players_list}}
				<pre>@{{ $data | json }} </pre> 

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
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>

		var matchTimer;
		var gameTimer; //current game timer
		var injuryTimer; 
		var timeoutTimer;  //team timeouts
		var intermissionTimer; //timeout between games

		Vue.config.debug = false;

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
				debug: false,
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
				timer: {
						match: 0 , 
						game: {
								1:0,
								2:0,
								3:0,
								4:0,
								5:0,
							},
						between: {
								normal: 120,
								tiebreaker: 300
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
				score_max: 11,  // 11 or 15
				tiebreaker: 7, // 7 or 11
				game_max: 2,  // 2 or 3
				total_games: 3,  // 3 or 5
				win_by: 1, // 1 or 2
				winner: '',
				game: [],
				game_formats: [ 	
							{id: 1, name:'11',  games:3,  points:11, tie:7, win_by: 1, timeouts:2, timeout_secs:5, injury_secs:10, appeals:3},
							{id: 2, name:'15',  games:3,  points:15, tie:7, win_by: 1, timeouts:3, timeout_secs:6, injury_secs:15, appeals:3},
							{id: 3, name:'Pro', games:5,  points:11, tie:7, win_by: 2, timeouts:3, timeout_secs:7, injury_secs:20, appeals:3},
							{id: 4, name:'Iron', games:3,  points:7, tie:7, win_by: 1, timeouts:1, timeout_secs:9, injury_secs:0, appeals:0}
						],
				players: [],
				player1_name: 'Player 1',
				player2_name: 'Player 2',
				player3_name: 'Player 3',
				player4_name: 'Player 4',
				player1_num: 1,
				player2_num: 2,
				player3_num: 3,
				player4_num: 4,
				team: 	{
							1: 	
								{
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									1: 	{
											score: 0, gm: 1, min: 0
										}, 
									2: {
											score: 0, gm: 2, min: 0
										},
									3: {
											score: 0, gm: 3, min: 0
										},
									4: {
											score: 0, gm: 4, min: 0
										},
									5: {
											score: 0, gm: 5, min: 0
										},
								},						
							2: 	
								{
									wins: 0,
									timeouts: 0,
									appeals: 0,
									injury: 0,
									1: 	{
											score: 0, gm: 1, min: 0
										}, 
									2: {
											score: 0, gm: 2, min: 0
										},
									3: {
											score: 0, gm: 3, min: 0
										},
									4: {
											score: 0, gm: 4, min: 0
										},
									5: {
											score: 0, gm: 5, min: 0
										},
								}
							}							
			},								
			computed: {
				players_list: function() {
					this.max_players = 0;
					this.players = [ { pos:1, name:''}, { pos:2, name:''}, { pos:3, name:''}, { pos:4, name:''}];
				
					if (this.player1_name != ''){
						this.max_players+=1; 
						this.players[0].name = this.player1_name;
					}
					if (this.player2_name != ''){
						this.max_players+=1; 
						this.players[1].name = this.player2_name;
					}
					if (this.player3_name != ''){
						this.max_players+=1; 
						this.players[2].name = this.player3_name;
					}
					if (this.player4_name != ''){
						this.max_players+=1; 
						this.players[3].name = this.player4_name;
					}
				},				
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
        				return "Time has expired";
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

					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;

					this.timer.team[1].injury = this.game.injury_secs;
					this.timer.team[2].injury = this.game.injury_secs;
				},
				resetMatch: function(event){ 
					// disable point, sideout, fault, etc
					this.isStarted = false;
					this.showSetup = true;
					this.player1_name = '';
					this.player2_name = '';
					this.player3_name = '';
					this.player4_name = '';
					this.max_players = 0;
					this.players= [];					

					this.team[1].timeouts = game.timeouts;
					this.team[1].appeals = game.appeals;
					this.team[2].timeouts = game.timeouts;
					this.team[2].appeals = game.appeals;

					this.endMatch();
				},	
				endMatch: function(event){
					this.stopTimer(gameTimer);
					this.stopTimer(matchTimer);
				},
				endGame: function(event){
					this.stopTimer(gameTimer);

					this.startTimer('game');	
					this.team[1].timeouts = this.game.timeouts;
					this.team[1].appeals = this.game.appeals;
					this.team[2].timeouts = this.game.timeouts;
					this.team[2].appeals = this.game.appeals;
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

							that.timer.team[teamNum].timeout -=1;

							//timeout is over
							if (that.timer.team[teamNum].timeout < 0) {
								that.timer.team[teamNum].timeout = 0;
								//that.stopTimer(timeoutTimer);
							}
						}, 1000);	
					}	

					if (name == 'injury') {						
						injuryTimer = setInterval(function(){
							that.timer.injury -=1;
							//injury timeout is over
							if (that.timer.team[teamNum].timeout == 0) {

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
						this.team[1][this.game_num].score +=1;
					}
					else {
						this.team[2][this.game_num].score +=1;
					}					

					if ((this.team[1][this.game_num].score >= this.score_max) && 
						((this.team[1][this.game_num].score - this.team[2][this.game_num].score) >= this.win_by))
					{
						//Game is over
						this.endGame();
						this.game_num+=1;
						this.team[1].wins +=1;

						//Change serving Team start of next game
						this.changeServingTeam();
					}
					if ((this.team[2][this.game_num].score >= this.score_max) && 
						((this.team[2][this.game_num].score - this.team[1][this.game_num].score) >= this.win_by))
					{
						this.game_num+= 1;
						this.team[2].wins += 1;

						this.changeServingTeam();
					}

					if (this.team[1].wins == this.game_max) {
						this.winner = 'The winner is ' + this.player1_name + ' ' + this.player2_name;
					}

					if (this.team[2].wins == this.game_max) {
						this.winner = 'The winner is ' + this.player3_name + ' ' + this.player4_name;
					}
				},
				undoPoint: function (event){
					//restore any faults
                    this.restoreFault();

                    //check if start of new game, but not the first game
                    if ((this.game_num > 1) && (this.team[1][this.game_num].score + this.team[2][this.game_num].score == 0 )) {
                    	this.game_num -= 1;
                    	//decrement team_game
                    	//team[1].wins -=1;
                    	//team[2].wins -=2;
                    	this.undoServingTeam();
                    }

                    //remove point
                    if (this.server < 3) {
						this.team[1][this.game_num].score -= 1;
					}
					else {
						this.team[2][this.game_num].score = 1;
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
					if (this.isDoubles) {
						if (this.server == 4 ) {
							this.server = 1;
						}
						else {
							this.server += 1;
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
				undoTimeout: function(event){

				},
				appeal: function(event) {

				},
				undoAppeal: function(event){

				},
				changeServingTeam: function(event){
					//Change server start of next game
					//tiebreaker							
					for (var i in this.team[2])
					{
						//alert(i);
						t1+= this.team[2][i].score;
						//alert(t1);
					}

					if(this.game_num == this.total_games) {
						var t1;
						var t2;

						for (var i in this.team[2])
						{
							t1+= this.team[2][i].score;
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