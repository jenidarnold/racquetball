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
	.team { 
		font-size: :14pt;
	}
	.form-inline > * {
	   margin:5px 5px;
	}
	.lbl-team {
		font-weight: 700;
		font-size: 14pt;
	}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="panel panel-primary" v-show="showSetup">			
			<div class="panel-heading">Setup</div>
			<div class="panel-body">	
				<form class="form-inline" role="form">
					<div class="row">									
						<div class="col-xs-12 form-group">
							<label for="team1" class="control-label lbl-team">Team 1</label>
						    <input class="form-control" id="team1" placeholder="Player 1" v-model="player1_name">
						    <input class="form-control" placeholder="Player 2" v-model="player2_name">
						</div>				
						<div class="col-xs-12 form-group">
						    <label for="team2" class="control-label lbl-team">Team 2</label>
						    <input class="form-control" id="team2" placeholder="Player 1" v-model="player3_name">
						    <input class="form-control" placeholder="Player 2" v-model="player4_name">
						</div>						
					</div>
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
			<div class="panel-heading">Match</div>
			<div class="panel-body">
				<div class="row">			
					<table class="table table-condensed col-md-12">
						<tr class="tr-games label-info ">
							<th></th>
							<th class="col-xs-1 th-games">Games</th>
							<th class="col-xs-1 th-games">1</th>
							<th class="col-xs-1 th-games">2</th>
							<th class="col-xs-1 th-games">3</th>
							<th class="col-xs-1 th-games">4</th>
							<th class="col-xs-1 th-games">5</th>
						</tr>
						<tr>
							<td>
								<div class="player col-md-3">
									@{{ player1_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player1_num">
									</i> 
								</div>
								<div class="player col-md-1"v-show="player2_name != ''">/</div>
								<div class="player col-md-3"v-show="player2_name != ''">
									@{{ player2_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player2_num">
									</i>
								</div>
							</td>
							<td class="score">
								<div v-show="game > 1">@{{ team1_games }} </div>
							</td>
							<td class="score" v-for="g in team1_scores" v-if="game >= g.gm" v-bind:class="[g.score < score_max && g.gm < game? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} </td>
						</tr>
						<tr>
							<td>
								<div class="player col-md-3">
									@{{ player3_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player3_num ">
									</i>
								</div>
								<div class="player col-md-1"v-show="player4_name != ''">/</div>
								<div class="player col-md-3"v-show="player4_name != ''">
									@{{ player4_name }}
									<i class="fa fa-circle" 
										v-bind:class="[faults >= 1? classRed : classBlack]" 
										v-show="server == player4_num ">
									</i>
								</div>
							</td>
							<td class="score">
								<div v-show="game > 1">@{{ team2_games }} </div>
							</td>
							<td class="score" v-for="g in team2_scores" v-if="game >= g.gm" v-bind:class="[g.score < score_max && g.gm < game? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} </td>
						</tr>
					</table>				
				</div>
			</div>
			<div class="panel-footer">			 
				<div class="row">
					<div class="col-xs-6">		
						<button v-on:click="point" class="btn btn-success" v-bind:class="isStarted? classEnabled : classDisabled">Point</button>
						<button v-on:click="sideout" class="btn btn-danger" v-bind:class="isStarted? classEnabled : classDisabled">Side Out</button>	
						<button v-on:click="fault" class="btn btn-warning" v-bind:class="isStarted? classEnabled : classDisabled">Fault</button>	
						<button v-on:click="undo" class="btn btn-default" v-bind:class="isStarted? classEnabled : classDisabled">Undo</button>	
					</div>
					<div class="col-xs-2 col-xs-offset-4">
						<button v-on:click="resetMatch" class="btn btn-default" v-bind:class="isStarted? classEnabled : classDisabled">New</button>	
					</div>	
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-6 alert alert-success" v-if="winner !=''">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<h2>@{{ winner }}</h2>			
					</div>
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
				max_players: 4, 
				score_steps: [],
				game: 1,
				faults: 0,
				score_max: 11,  // 11 or 15
				tiebreaker: 7, // 7 or 11
				game_max: 2,  // 2 or 3
				total_games: 3,  // 3 or 5
				win_by: 1, // 1 or 2
				winner: '',
				player1_name: '',
				player2_name: '',
				player3_name: '',
				player4_name: '',
				player1_num: 1,
				player2_num: 2,
				player3_num: 3,
				player4_num: 4,
				team1_games: 0,
				team2_games: 0,
				team1_scores: [{score: 0, gm: 1}, {score:0, gm: 2} , {score: 0, gm:3}, {score: 0, gm:4}, {score:0, gm:5}],
				team2_scores: [{score: 0, gm: 1}, {score:0, gm: 2} , {score: 0, gm:3}, {score: 0, gm:4}, {score:0, gm:5}],				
			},
			computed: {
				max_players: function () {
					this.max_players = 0;

					if (this.player1_name != ''){
						this.max_players+=1; 
					}
					if (this.player2_name != ''){
						this.max_players+=1; 
					}
					if (this.player3_name != ''){
						this.max_players+=1; 
					}
					if (this.player4_name != ''){
						this.max_players+=1; 
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
					if(this.game == this.total_games) {
						this.score_max = this.tiebreaker;
						return true;
					}
					else {
						return false;				
					}
				}
			},

			methods: {
				createMatch: function(event){ 
					// enable point, sideout, fault, etc
					this.isStarted = true;
					this.showSetup = false;
				},
				resetMatch: function(event){ 
					// disable point, sideout, fault, etc
					this.isStarted = false;
					this.showSetup = true;
					this.player1_name = '';
					this.player2_name = '';
					this.player3_name = '';
					this.player4_name = '';
				},				
				point: function (event){
					this.faults = 0;
					this.score_steps.push('point');

					if (this.isTiebreaker){}

					if (this.server < 3) {
						this.team1_scores[this.game-1].score +=1;
					}
					else {
						this.team2_scores[this.game-1].score +=1;
					}					

					if ((this.team1_scores[this.game-1].score >= this.score_max) && 
						((this.team1_scores[this.game-1].score - this.team2_scores[this.game-1].score) >= this.win_by))
					{
						this.game+=1;
						this.team1_games +=1;

						//Change serving Team start of next game
						this.changeServingTeam();
					}
					if ((this.team2_scores[this.game-1].score >= this.score_max) && 
						((this.team2_scores[this.game-1].score - this.team1_scores[this.game-1].score) >= this.win_by))
					{
						this.game+=1;
						this.team2_games +=1;

						this.changeServingTeam();
					}

					if (this.team1_games == this.game_max) {
						this.winner = 'The winner is ' + this.player1_name + ' ' + this.player2_name;
					}

					if (this.team2_games == this.game_max) {
						this.winner = 'The winner is ' + this.player3_name + ' ' + this.player4_name;
					}
				},
				undoPoint: function (event){
					//restore any faults
                    this.restoreFault();

                    //checkf if start of new game, but not the first game
                    if ((this.game > 1) && (this.team1_scores[this.game-1].score + this.team2_scores[this.game-1].score ==0)) {
                    	this.game -=1;
                    	//decrement team_game
                    	//team1_games -=1;
                    	//team2_games -=2;
                    	this.undoServingTeam();
                    }

                    //remove point
                    if (this.server < 3) {
						this.team1_scores[this.game-1].score -=1;
					}
					else {
						this.team2_scores[this.game-1].score =1;
					}
				},
				fault: function (event){
					this.faults +=1;

					if (this.faults == 2 ) {
					    this.score_steps.push('doublefault');
						this.sideout(event);
					}else{
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
				changeServingTeam: function(event){
					//Change server start of next game
					//tiebreaker
					//					
					for (var i in this.team2_scores)
					{
						//alert(i);
						t1+= this.team2_scores[i].score;
						//alert(t1);
					}

					if(this.game == this.total_games) {
						var t1;
						var t2;

						for (var i in this.team2_scores)
						{
							t1+= this.team2_scores[i].score;
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