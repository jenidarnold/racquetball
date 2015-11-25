@extends('layouts.app')

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row">
			<table class="table table-condensed">
				<tr class="tr-games label-info">
					<td></td>
					<td class="games">Gm</td>
					<td class="col-xs-1">1</td>
					<td class="col-xs-1">2</td>
					<td class="col-xs-1">3</td>
					<td class="col-xs-1">4</td>
					<td class="col-xs-1">5</td>
				</tr>
				<tr>
					<td>
						<h4>@{{ player1_name }} <i class="fa fa-circle" v-show="server == player1_number"></i> </h4>
					</td>
					<td></td>
					<td v-for="game in player1_scores">@{{ game.score }} </td>
				</tr>
				<tr>
					<td>
						<h4>@{{ player2_name }} <i class="fa fa-circle" v-show="server == player2_number "></i> </h4>
					</td>
					<td></td>
					<td v-for="game in player2_scores">@{{ game.score }} </td>				
				</tr>
			</table>
		</div>
		<div class="row">
			<div class="col-xs-2">	
				<button v-on:click="point" class="btn btn-success">Point</button>
			</div>
			<div class="col-xs-2">
				<button v-on:click="fault" class="btn btn-warning">Fault</button>	
			</div>
			<div class="col-xs-2">
				<button v-on:click="sideout" class="btn btn-danger">Side Out</button>	
			</div>
		</div>	
		<div class="row">
			<div class="col-xs-6 alert alert-success" v-if="winner !=''">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<h3>@{{ winner }}</h3>			
			</div>
		</div>

		{{-- <pre>@{{ $data | json }} </pre> --}}
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
				server: 1,
				game: 0,
				faults: 0,
				score_max: 3,
				game_max: 3,
				winner: '',
				player1_name: 'Missy',
				player2_name: 'Kaylee',
				player1_number: 1,
				player2_number: 2,
				player1_games: 0,
				player2_games: 0,
				player1_scores: [{score: 0}, {score:0} , {score: 0}, {score: 0}, {score:0}],
				player2_scores: [{score: 0}, {score:0} , {score: 0}, {score: 0}, {score:0}],	
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
			methods: {
				point: function (event){
					this.faults = 0;
					if (this.server == 1 ) {
						this.player1_scores[this.game].score +=1;
					}
					else {
						this.player2_scores[this.game].score +=1;
					}

					if (this.player1_scores[this.game].score == this.score_max) {
						this.game+=1;
						this.player1_games +=1;
					}
					if (this.player2_scores[this.game].score == this.score_max) {
						this.game+=1;
						this.player2_games +=1;
					}

					if (this.player1_games == this.game_max) {
						this.winner = 'The winner is ' + this.player1_name;
					}

					if (this.player2_games == this.game_max) {
						this.winner = 'The winner is ' + this.player2_name;
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
					if (this.server == 1 ) {
						this.server = 2;
					}
					else {
						this.server = 1;
					};
				}
			}
		});
	</script>
@stop