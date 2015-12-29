@extends('layouts.app')

@section('style')
	<style>
		h3 {
			text-align: center;
		}
		.player {
			font-size: 12pt;
			font-weight: 500;
		}
		.star {
			color:green;
		}
		.question {
			font-size: 12pt;
			font-weight: 500;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row">
			<div class="col-xs-8">
				<div class="panel panel-primary">			
					<div class="panel-heading"><h3>Questionaire</h3></div>
					<div class="panel-body">	
						<div class="row">
							<div class="col-xs-12">
								<form class="form-inline" role="form">
									<ul v-for="q in survey">
										<span class="question">@{{q.id}}. @{{ q.question }}</span>
										<select v-model="score[q.id]" class="form-control" v-on:change="computeScore">
										  <option value="0" selected="true"></option>
										  <option v-for="a in q.answers" v-bind:value="a.weight">
										    @{{ a.text }}
										  </option>
										</select>
									</ul>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="panel panel-success">			
					<div class="panel-heading"><h3>Matches</h3></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<ul v-for="p in players | orderBy 'match' -1">
									<div class="row">
										<div class="col-xs-4">
											<span class="player">@{{p.name}} </h4>
										</div>
										<div class="col-xs-8">
											<span v-for="s in p.match">
												<i class ="fa fa-star fa-xs star"></i>
											</span>
										</div>
									</div> 							
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Debug Panel -->
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
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>

		Vue.config.debug = false;

		new Vue({
			el: '#myvue',
			data: {	
					debug: false,
					score: {},
					total_score: 0,
					survey: {
						1: {
							id: 1,
							question: 'Are you a Power player, Control Player, or Balanced Player?', 
							answers : { 
								1: { text: 'Power Player',weight: 1 },
								3: { text: 'Balanced Player', weight: 0 },									
								2: { text: 'Control Player', weight: 2 },					
							}
						},
						2: {
							id: 2,
							question: 'I Prefer to Shoot or Retrieve the ball?', 
							answers : { 
								1: { text: 'Shoot', weight: 1 },
								2: { text: 'Retrieve', weight: 2 },
							}
						},
						3: {
							id: 3,
							question: 'I play Level-headed or Emotionally?', 
							answers : { 
								1: { text: 'Level-headed', weight: 1 },
								2: { text: 'Emotionally', weight: 2 },
							}
						},
						4: {
							id: 4,
							question: 'I play Calm or Psyched Up?', 
							answers : { 
								1: { text: 'Calm', weight: 2 },
								2: { text: 'Psyched Up', weight: 1 },
							}
						},
						5: {
							id: 5,
							question: 'I play Left-Handed or Right-Handed?', 
							answers : { 
								1: { text: 'Left-Handed', weight: 1 },
								2: { text: 'Right-Handed', weight: 2 },
							}
						},
						6: {
							id: 6,
							question: 'My preferred game tempo is:', 
							answers : { 
								1: { text: 'Slow and Methodical', weight: 1 },
								2: { text: 'Fast-paced', weight: 2 },
							}
						},
					},
					players: {
						1: {id: 1,
							name: 'Michael',
							scores: [1,1,1,1,1,1],
							diff: [],
							match: 0,
						},
						2: {id: 2,
							name: 'Brandon',
							scores: [0,2,1,1,1,2],
							diff: [],
							match: 0,
						},
						3: {id: 3,
							name: 'Justin',
							scores: [1,1,1,1,1,2],
							diff: [],
							match: 0
						},
						4: {id: 4,
							name: 'Barry',
							scores: [0,0,1,1,1,1],
							diff: [],
							match: 0
						},					
				},
			},								
			computed: {				
			},
			filters: {
			},				
			methods: {
				computeScore: function(){
					this.total_score = 0;			
					for (var id in this.score) {
						var weight =  parseInt(this.score[id]);
						this.total_score+=  weight;
					};

					for (var pid in this.players) {
						this.players[pid].match = 0;
						for (var sid in this.score) {
							this.players[pid].diff[sid-1] =  Math.abs(this.players[pid].scores[parseInt(sid)-1] - this.score[sid]) ;

							this.players[pid].match += this.players[pid].diff[sid-1]
						}
					};
				}
			}
		});	
	</script>
@stop