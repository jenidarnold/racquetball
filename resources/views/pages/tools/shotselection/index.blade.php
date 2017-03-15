@extends('layouts.app')

@section('style')
	<style>
		.court-diagram {
			background: url('/images/court.png') no-repeat;
			height: 600px;
			width: 310px;
		}
		.title {
			text-align: center
		}
		.subtitle{
			text-align: center
		}
		.red {
			color: red;
		}		
		.blue {
			color: blue;
		}
		.pass {
			color:green;
		}
		.ceiling {
			color:orange;
		}
		.kill {
			color:red;
		}
		.pinch {
			color:blue;
		}	
		.pass_path{
			fill:none;stroke:green;stroke-width:2;
		}
		.kill_path{
			fill:none;stroke:red;stroke-width:2;
		}
		.ceiling_path{
			fill:none;stroke:orange;stroke-width:2;
		}
		.pinch_path{
			fill:none;stroke:blue;stroke-width:2;
		}	
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row title">
		<h2>Shot Selection</h2>
		</div>		
		<div class="row">
			<div class="col-xs-12 subtitle"><h3>You + Ball + Opponent + Score = Shot Selection</h3></div>
		</div>
		
		<div class="row">
			<form class="form-horizontal" role="form">
				<!-- Dropdowns -->
				<div class="col-xs-3">
					<div class="form-group">
						<label for="off_position" class="control-label"><i class="fa fa-circle blue"></i> Offense</label>
						<select id="off_position" v-model="off_position" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in player.positions" v-bind:value="pos">
							    @{{ pos }}
							</option>
						</select>
					</div>				
					<div class="form-group">
					    <label for="def_position" class="control-label"><i class="fa fa-circle red"></i> Defense</label>		
					    <select id="def_position" v-model="def_position" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in player.positions" v-bind:value="pos">
							    @{{ pos }}
							</option>
						</select>			    
					</div>	
					<div class="form-group">
					    <label for="ball_speed" class="control-label">Ball Speed</label>	
					    <select id="ball_speed" v-model="ball_speed" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in ball.speed" v-bind:value="pos">
							    @{{ pos }}
							</option>
						</select>
					</div>	
					<div class="form-group">
					    <label for="ball_height" class="control-label">Ball Height</label>	
					    <select id="ball_height" v-model="ball_height" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in ball.height" v-bind:value="pos">
							    @{{ pos }}
							</option>
						</select>
					</div>	
					<div class="form-group">
					    <label for="ball_angle" class="control-label">Ball Angle</label>	
					    <select id="ball_angle" v-model="ball_angle" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in ball.angle" v-bind:value="pos">
							    @{{ pos }}
							</option>
						</select>
					</div>	
					<div class="form-group">
					    <label for="score_range" class="control-label indent">Score +/-</label>	
					    <select id="score_range" v-model="score_range" class="form-control" v-on:change="reset_legend()">
							<option v-for="pos in score.range" v-bind:value="score.range">
							    @{{ pos }}
							</option>
						</select>
					</div>	
				</div>
				<!-- Court Diagram -->
				<div class="col-xs-6">
					<center>
					<div class="court-diagram" id="court">						
						<svg id="court" height="600" width="330" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">							
							<!-- Players Front Court -->
							<circle v-if="show_player(def_position, 'front')" cx="150" cy="200" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="show_player(off_position, 'front')" cx="160" cy="250" r="15" stroke="black" stroke-width="2" fill="blue" />
							<!-- PlayersCenter Court -->
							<circle v-if="show_player(def_position, 'center')" cx="150" cy="350" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="show_player(off_position, 'center')" cx="160" cy="400" r="15" stroke="black" stroke-width="2" fill="blue" />
							<!-- Players Back Court -->
							<circle v-if="show_player(def_position, 'back')" cx="150" cy="500" r="15" stroke="black" stroke-width="2" fill="red" />
							<circle v-if="show_player(off_position, 'back')" cx="160" cy="550" r="15" stroke="black" stroke-width="2" fill="blue" />

							<!-- Offense = FRONT Defense = FRONT -->
							<!-- Pass DTL-->
							<polyline v-if="show_shot('front','front', 1, 1, 1)" points="170,240 200,10 250,500" class="pass_path" />
							<!-- Ceiling -->
							<polyline v-if="show_shot('front','front', 3, 2, 20)" points="170,240 200,10 290,580" class="ceiling_path" />
							<!-- Z-shot -->
							<polyline v-if="show_shot('front','front', 3, 3, 22)" points="170,240 50,10, 10, 50, 300,580 50,580" class="ceiling_path" />


							<!-- Offense = FRONT Defense = CENTER -->
							<!-- Kill -->
							<polyline v-if="show_shot('front','center', 2, 1, 10)" points="170,240 200,10 205,200" class="kill_path" />
							<!-- Pinch -->
							<polyline v-if="show_shot('front','center', 4, 2, 30)" points="170,240 300,30 280,10, 250,50" class="pinch_path" />
							<!-- Reverse Pinch -->
							<polyline v-if="show_shot('front','center', 4, 2, 31)" points="170,240 10,30 30,10 60,50" class="pinch_path" />
							<!-- Pass DTL  -->
							<polyline v-if="show_shot('front','center', 1, 1, 1)" points="170,240 230,10 250,500" class="pass_path" />
							<!-- Pass Wide-Angle -->
							<polyline v-if="show_shot('front','center', 1, 3, 3)" points="170,240 100,10 10,300 200,500" class="pass_path" />
							

							<!-- Offense = FRONT Defense = BACK -->
							<!-- Kill -->
							<polyline v-if="show_shot('front','back', 2, 1, 10)" points="170,240 200,10 205,200" class="kill_path" />
							<!-- Pinch -->
							<polyline v-if="show_shot('front','back', 4, 2, 30)" points="170,240 300,30 280,10, 250,50" class="pinch_path" />
							<!-- Reverse Pinch -->
							<polyline v-if="show_shot('front','back', 4, 2, 31)" points="170,240 10,30 30,10 60,50" class="pinch_path" />
							<!-- Pass-KILL DTL  -->
							<polyline v-if="show_shot('front','back', 1, 3, 1)" points="170,240 230,10 250,300" class="pass_path" />							

							<!-- Offense = CENTER Defense = FRONT -->
							<!-- Pass DTL -->
							<polyline v-if="show_shot('center','front', 1, 1, 1)" points="180,400 240,10 250,500" class="pass_path" />
							<!-- Pass Cross Court -->
							<polyline v-if="show_shot('center','front', 1, 2, 2)" points="180,400 80,10 40,500" class="pass_path" />						
							<!-- Pass Wide-Angle  -->
							<polyline v-if="show_shot('center','front', 1, 3, 3)" points="180,400 100,10 10,300 200,500" class="pass_path" />						
							<!-- Ceiling  -->
							<polyline v-if="show_shot('center','front', 3, 3, 20)" points="180,400 240,10, 290,580" class="ceiling_path" />
							<!-- Z-shot -->
							<polyline v-if="show_shot('center','front', 3, 3, 22)" points="180,400 50,10, 10, 50, 300,580 50,580" class="ceiling_path" />


							<!-- Offense = CENTER Defense = CENTER -->
							<!-- Pinch -->
							<polyline v-if="show_shot('center','center', 4, 2, 30)" points="180,400 300,30 280,10, 250,50" class="pinch_path" />
							<!-- Pass DTL -->
							<polyline v-if="show_shot('center','center', 1, 1, 1)" points="180,400 240,10 250,500" class="pass_path" />
							<!-- Pass Wide-Angle  -->
							<polyline v-if="show_shot('center','center', 1, 1, 3)" points="180,400 100,10 10,300 200,500" class="pass_path" />	
							<!-- Ceiling  -->
							<polyline v-if="show_shot('center','center', 3, 3, 20)" points="180,400 200,10 290,580" class="ceiling_path" />
							<!-- Z-shot -->
							<polyline v-if="show_shot('center','center', 3, 3, 22)" points="180,400 50,10, 10, 50, 300,580 50,580" class="ceiling_path" />


							<!-- Offense = CENTER Defense = BACK -->
							<!-- Kill -->
							<polyline v-if="show_shot('center','back', 2, 1, 10)" points="160,390 200,10 205,200" class="kill_path" />
							<!-- Pinch -->
							<polyline v-if="show_shot('center','back', 4, 2, 30)" points="160,390 300,30 280,10, 250,50" class="pinch_path" />
							<!-- Reverse Pinch -->
							<polyline v-if="show_shot('center','back', 4, 2, 31)" points="160,390 10,30 30,10 60,50" class="pinch_path" />


							<!-- Offense = BACK Defense = FRONT -->



							<!-- Offense = BACK Defense = CENTER -->



							<!-- Offense = BACK Defense = BACK -->
						</svg>						
					</div>
					</center>
				</div>
				<!-- Drop downs Filter Shot Selections -->
				<div class="col-xs-3">
					<div class="form-group">
						<label for="shot_types" class="control-label">Shot Types:</label>
						<select id="shot_types" v-model="show_shot_type" class="form-control" v-on:change="reset_legend()">
							<option value="All" selected="true">All</option>
							<option v-for="shot in shot_types" v-bind:value="shot.id">
							    @{{ shot.type }}
							</option>
						</select>
					</div>
					<div class="form-group">
						<label for="shot_types" class="control-label">Shot Preference:</label>
						<select id="shot_types" v-model="show_shot_pref" class="form-control" v-on:change="reset_legend()">	
							<option value="All" selected="true">All</option>						
							<option value="1">1st Only</option>
							<option value="2">2nd Only</option>
							<option value="3">3rd Only</option>
							<option value="4">1st & 2nd Only</option>
						</select>
					</div>
					<!-- Legend -->
					<div class="form-group">
						<label for="shot_types" class="control-label">Shots by Name:</label>
						<div class="well well-sm">
							<ul v-for="shot in shots" v-if="shot.show">
								<i class="fa fa-circle" v-bind:class="shot.type"></i> @{{ shot.name }} 
							</ul>
						</div>						
					</div>
					
				</div>	
			</form>
		</div>
		<div class="row>">
		<h3>This interactive tool is based on information found in the book <a href="http://frandavisracquetball.com" target="frandavis">Championship Racquetball</a> by Fran Davis and Jason Mannino. </a>
		</div>

		<!-- Debug Panel -->
		<div class="panel panel-default" v-show="debug">
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

		Vue.config.debug = true;		

		new Vue({
			el: '#myvue',
			data: {	
				debug: false,
				off_position: '',
				def_position: '',
				show_shot_type: '',
				show_shot_pref: '',
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
				shot_types: [ {id:1, type:'pass'}, { id:2, type:'kill'}, {id:3, type:'ceiling'}, {id:4, type:'pinch'}],

				shots: {
						 1: {type: 'pass', name: 'pass down-the-line', show: false }, 
						 2: {type: 'pass', name: 'pass cross-court', show: false },
						 3: {type: 'pass', name: 'pass wide-angle', show: false },
						 4: {type: 'pass', name: 'over-head pass', show: false },
						10: {type: 'kill', name: 'kill straight in', show: false }, 
						11: {type: 'kill', name: 'kill pass', show: false , show: false }, 
						12: {type: 'kill', name: 'kill pinch', show: false },
						20: {type: 'ceiling', name: 'ceiling down-the-line', show: false },
						21: {type: 'ceiling', name: 'ceiling cross-court', show: false }, 
						22: {type: 'ceiling', name: 'Z-shot', show: false }, 
						23: {type: 'ceiling', name: 'around the world', show: false },
						30: {type: 'pinch', name: 'pinch', show: false },
						31: {type: 'pinch', name: 'reverse pinch', show: false },
						32: {type: 'pinch', name: 'splat', show: false },
						33: {type: 'pinch', name: 'fly pinch', show: false },
						34: {type: 'pinch', name: 'over-head pinch', show: false },
				},				
				score: {
						range: [ -3, 0 +3 ]
				},
			},
			methods: {
				reset_legend: function(){
					for (var id in this.shots) {
						this.shots[id].show = false;
					};
				},
				show_player: function(player_pos, pos){
					if (player_pos == pos){
						return true;
					}else {
						return false;
					}					
				},
				show_shot: function(off_pos, def_pos, shot_type, shot_pref, shot_id){					
					//determine if show
					if ((this.show_shot_type == 'All') || (this.show_shot_type == shot_type)) {
						if ((this.show_shot_pref == 'All') || (this.show_shot_pref == shot_pref) || ((this.show_shot_pref == 4) && (shot_pref < 3))){
							if ((this.off_position == off_pos) && (this.def_position == def_pos)){
								this.shots[shot_id].show = true;							
								return true;
							}
						}
					}
					return false;
				},			
			},
			filters: {

			}
		});		
	</script>
@stop