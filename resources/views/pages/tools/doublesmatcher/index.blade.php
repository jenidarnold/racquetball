@extends('layouts.app')

@section('style')
	<style>

	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="panel panel-primary">			
			<div class="panel-heading"><h3>Questionaire</h3></div>
			<div class="panel-body">	
				<div class="row">
					<div class="col-xs-8">
						<form class="form-inline" role="form">
							<ul v-for="q in survey">
								<h4>@{{q.id}}. @{{ q.question }}</h4>
								<select v-model="score[q.id]" class="form-control" v-on:change="computeScore">
								  <option value="0" selected="true"></option>
								  <option v-for="a in q.answers" v-bind:value="a.weight">
								    @{{ a.text }}
								  </option>
								</select>
							</ul>
						</form>
						<label>@{{total_score}}</label>
					</div>
					<div class="col-xs-4">
						<ul v-for="p in players | orderBy 'weight'">
							<h3>@{{p.weight}} @{{p.name}}</h3>
						</ul>
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
								2: { text: 'Conrol Player', weight: 3 },
								3: { text: 'Balanced Player', weight: 2 },						
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
								1: { text: 'Calm', weight: 1 },
								2: { text: 'Psyched Up', weight: 2 },
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
							name: 'Apple',
							weight: 4
						},
						2: {id: 2,
							name: 'Banana',
							weight: 3
						},
						3: {id: 3,
							name: 'Orange',
							weight: 1
						},
						4: {id: 4,
							name: 'Kiwi',
							weight: 2
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
						console.log(this.total_score);
					};
				}
			}
		});	
	</script>
@stop