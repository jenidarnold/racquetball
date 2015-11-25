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


	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row">
			<table class="table table-condensed col-md-8">
				<tr class="tr-games label-info ">
					<td></td>
					<td class="col-xs-1">Gm</td>
					<td class="col-xs-1">1</td>
					<td class="col-xs-1">2</td>
					<td class="col-xs-1">3</td>
					<td class="col-xs-1">4</td>
					<td class="col-xs-1">5</td>
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
						<div class="player col-md-1"v-show="isDoubles">/</div>
						<div class="player col-md-3"v-show="isDoubles">
							@{{ player2_name }}
							<i class="fa fa-circle" 
								v-bind:class="[faults >= 1? classRed : classBlack]" 
								v-show="server == player2_num">
							</i>
						</div>
					</td>
					<td></td>
					<td class="score" v-for="g in team1_scores" v-if="game >= g.gm" v-bind:class="[g.score < score_max && g.gm < game? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} </td>
				</tr>
				<tr>
					<td>
						<div class="player col-md-3">
							@{{ player3_name }}
							<i class="fa fa-circle" 
								v-bind:class="[faults >= 1? classRed : classBlack]" 
								v-show="server = player3_num ">
							</i>
						</div>
						<div class="player col-md-1"v-show="isDoubles">/</div>
						<div class="player col-md-3"v-show="isDoubles">
							@{{ player4_name }}
							<i class="fa fa-circle" 
								v-bind:class="[faults >= 1? classRed : classBlack]" 
								v-show="server == player4_num ">
							</i>
						</div>
					</td>
					<td></td>
					<td class="score" v-for="g in team2_scores" v-if="game >= g.gm" v-bind:class="[g.score < score_max && g.gm < game? classLoss: g.score >= score_max? classWin: '']">@{{ g.score }} </td>
				</tr>
			</table>
		</div>
		<div class="row">		
			<div class="col-xs-2">	
				<button v-on:click="point" class="btn btn-success">Point</button>
			</div>			
			<div class="col-xs-2">
				<button v-on:click="sideout" class="btn btn-danger">Side Out</button>	
			</div>
			<div class="col-xs-2">
				<button v-on:click="fault" class="btn btn-warning">Fault</button>	
			</div>
		</div>	
		<div class="row">
			<div class="col-xs-6 alert alert-success" v-if="winner !=''">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<h2>@{{ winner }}</h3>			
			</div>
		</div>
					
		 <pre>@{{ $data | json }} </pre> 
		}
		}
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
				classWin: 'win',
				classLoss: 'loss',
				classRed: 'red',
				classBlack: 'black',
				initServer: 1,
				max_players: 4, 
				server: 1,
				game: 1,
				faults: 0,
				score_max: 11,  // 11 or 15
				tiebreaker: 7, // 7 or 11
				game_max: 3,  // 2 or 3
				total_games: 5,  // 3 or 5
				win_by: 1, // 1 or 2
				winner: '',
				player1_name: 'Missy',
				player2_name: 'Kaylee',
				player3_name: 'TJ',
				player4_name: 'Richie',
				player1_num: 1,
				player2_num: 2,
				player3_num: 3,
				player4_num: 4,
				team1_games: 0,
				team2_games: 0,
				team1_scores: [{score: 0, gm: 1}, {score:0, gm: 2} , {score: 0, gm:3}, {score: 0, gm:4}, {score:0, gm:5}],
				team2_scores: [{score: 0, gm: 1}, {score:0, gm: 2} , {score: 0, gm:3}, {score: 0, gm:4}, {score:0, gm:5}],

				// player1: [
				// 		{ name: 'Missy'},
				// 		{ number: 1 },
				// 		{ scores: [ 
				// 			{score: 0}, 
				// 			{score: 0}, 
				// 			{score: 0} , 
				// 			{score: 0}, 
				// 			{score:0}
				// 			]
				// 		},
				// 		{ games: 0},
				// 	],
				// player2: [
				// 		{ name: 'Kaylee'},
				// 		{ number: 1 },
				// 		{ scores: [ 
				// 			{score: 0}, 
				// 			{score: 0}, 
				// 			{score: 0} , 
				// 			{score: 0}, 
				// 			{score:0}
				// 			]
				// 		},
				// 		{ games: 0},
				// 	],			
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
				point: function (event){
					this.faults = 0;					
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

						//Change server start of next game
						this.changeServer();
					}
					if ((this.team2_scores[this.game-1].score >= this.score_max) && 
						((this.team2_scores[this.game-1].score - this.team1_scores[this.game-1].score) >= this.win_by))
					{
						this.game+=1;
						this.team2_games +=1;

						this.changeServer();
					}

					if (this.team1_games == this.game_max) {
						this.winner = 'The winner is ' + this.player1_name + ' ' + this.player2_name;
					}

					if (this.team2_games == this.game_max) {
						this.winner = 'The winner is ' + this.player3_name + ' ' + this.player4_name;
					}
				},
				fault: function (event){
					this.faults +=1;

					if (this.faults == 2 ) {
						this.faults = 0;
						this.sideout(event);
					};
				},
				sideout: function (event){
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

				changeServer: function(event){
					//Change server start of next game
					//tiebreaker
					if(this.game == this.game_max -1) {
						//team with highest score serves
						
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
				}
			}
		});
	</script>
@stop