@extends('layouts.app')

@section('style')
	<style>
		.court-diagram {
			background: url('/images/court.png') no-repeat;
			height: 600px;
			width: 310px;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row">
		<h2>Shot Selection</h2>
		</div>
		<div class="row">
			<div class="col-xs-12">You + Ball + Opponent + Score = Shot Selection</div>
		</div>
		
		<div class="row">
			<form class="form-horizontal" role="form">
				<!-- Dropdowns -->
				<div class="col-xs-4">
						<div class="form-group">
							<label for="off_position" class="control-label">Offense</label>
							<select id="off_position" v-model="off_position" class="form-control">
								<option v-for="pos in player.positions" v-bind:value="pos">
								    @{{ pos }}
								</option>
							</select>
						</div>				
						<div class="form-group">
						    <label for="def_position" class="control-label">Defense</label>		
						    <select id="def_position" v-model="def_position" class="form-control">
								<option v-for="pos in player.positions" v-bind:value="pos">
								    @{{ pos }}
								</option>
							</select>			    
						</div>	
						<div class="form-group">
						    <label for="ball_speed" class="control-label">Ball Speed</label>	
						    <select id="ball_speed" v-model="ball_speed" class="form-control">
								<option v-for="pos in ball.speed" v-bind:value="pos">
								    @{{ pos }}
								</option>
							</select>
						</div>	
						<div class="form-group">
						    <label for="ball_height" class="control-label">Ball Height</label>	
						    <select id="ball_height" v-model="ball_height" class="form-control">
								<option v-for="pos in ball.height" v-bind:value="pos">
								    @{{ pos }}
								</option>
							</select>
						</div>	
						<div class="form-group">
						    <label for="ball_angle" class="control-label">Ball Angle</label>	
						    <select id="ball_angle" v-model="ball_angle" class="form-control">
								<option v-for="pos in ball.angle" v-bind:value="pos">
								    @{{ pos }}
								</option>
							</select>
						</div>	
						<div class="form-group">
						    <label for="score_range" class="control-label lbl-team indent">Score +/-</label>	
						    <select id="score_range" v-model="score_range" class="form-control">
								<option v-for="pos in score.range" v-bind:value="score.range">
								    @{{ pos }}
								</option>
							</select>
						</div>	
				</div>
				<!-- Court Diagram -->
				<div class="col-xs-8">
					<div class="court-diagram" id="court">						
						<svg id="court" height="600" width="330">

							<!-- Players Front Court -->
							<circle v-if="def_position == 'front'" cx="150" cy="200" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="off_position == 'front'" cx="160" cy="250" r="15" stroke="black" stroke-width="2" fill="blue" />
							<!-- PlayersCenter Court -->
							<circle v-if="def_position == 'center'" cx="150" cy="350" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="off_position == 'center'" cx="160" cy="400" r="15" stroke="black" stroke-width="2" fill="blue" />
							<!-- Players Back Court -->
							<circle v-if="def_position == 'back'" cx="150" cy="500" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="off_position == 'back'" cx="160" cy="550" r="15" stroke="black" stroke-width="2" fill="blue" />

							<!-- Pass Front Court -->
							<polyline v-if="off_position == 'front' && def_position == 'front'" points="170,240 200,10 250,500" style="fill:none;stroke:green;stroke-width:2" />
							<!-- Ceiling Front Court -->
							<polyline v-if="off_position == 'front' && def_position == 'front'" points="170,240 200,200, 230, 50, 200,10 230,500" style="fill:none;stroke:orange;stroke-width:2" />
							<!-- Z-shot Front Court -->
							<polyline v-if="off_position == 'front' && def_position == 'front'" points="170,240 50,10, 10, 50, 300,550 50,550" style="fill:none;stroke:purple;stroke-width:2" />

							<!-- Pass DTL Center Court -->
							<polyline v-if="off_position == 'center' && def_position == 'front'" points="180,400 240,10 250,500" style="fill:none;stroke:green;stroke-width:2" />
							<!-- Pass Cross Center Court -->
							<polyline v-if="off_position == 'center' && def_position == 'front'" points="180,400 100,10 40,500" style="fill:none;stroke:blue;stroke-width:2" />						
							<!-- Pass Wide Center Court -->
							<polyline v-if="off_position == 'center' && def_position == 'front'" points="180,400 100,10 10,300 250,500" style="fill:none;stroke:red;stroke-width:2" />						<!-- Ceiling Front Court -->
							<polyline v-if="off_position == 'center' && def_position == 'front'" points="180,400 240,260, 230, 50, 200,10 230,500" style="fill:none;stroke:orange;stroke-width:2" />
							<!-- Z-shot Front Court -->
							<polyline v-if="off_position == 'center' && def_position == 'front'" points="180,400 50,10, 10, 50, 300,550 50,550" style="fill:none;stroke:purple;stroke-width:2" />

						</svg>						
					</div>
				</div>
			</form>
		</div>

		<!-- Debug Panel -->
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row col-xs-12">
					<input type="checkbox" id="chkDebug" v-model="debug">
					<label for="chkDebug">Debug</label>
				</div>
				<div class="row" v-show="debug">
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
				debug: true,
				off_position: '',
				def_position: '',
				player: {
						positions: [
							'front',
							'center',
							'back'						
						],
						skill: [
							'beginner',
							'intermediate',
							'advanced'
						]
				},
				ball: {
						speed: [
							'slow',
							'medium',
							'hard'						
						],
						height: [
							'low',
							'mid',
							'high'
						],
						angle: [
							'straight',
							'cross'
						]
				},
				score: {
						range: [ -3, 0 +3 ]
				},
			}
		});		
	</script>
@stop