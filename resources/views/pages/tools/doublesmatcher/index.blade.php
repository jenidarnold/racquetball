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

		.profile {
			position: relative;
			height: 50px;
			width: 50px;
		}
		.img-profile{
			width: 100%;
			height: auto;
			overflow: hidden;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<div class="row">
			<div class="col-xs-7">
				<div class="panel panel-primary">			
					<div class="panel-heading"><h3>Questionaire</h3></div>
					<div class="panel-body">	
						<div class="row">
							<div class="col-xs-12">
								<form class="form-inline" role="form">
									<ul v-for="q in questions">
										<span class="question">@{{q.id}}. @{{ q.question }}</span><br/>
										<select v-model="score[q.id]" class="form-control" v-on:change="computeScore">
										  <option value="0" selected="true"></option>
										  <option v-for="a in answers | filterBy q.id in 'question_id'" v-bind:value="a.value">
										    @{{ a.answer }}
										  </option>
										</select>
									</ul>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-5">
				<div class="panel panel-success">			
					<div class="panel-heading"><h3>Matches</h3></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<ul v-for="m in matches">
									<div class="row">
										<div class="col-xs-2">
											<div class="profile">
												<img class='img-profile' v-bind:src="m.pid | profile">
											</div>
										</div>
										<div class="col-xs-7">
											<span class="player">@{{players[m.pid].first_name}} @{{players[m.pid].last_name}}</span>		
										</div>
										<div class="col-xs-3">
											<span v-for="s in m.score">
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
		<!-- Debug Panel -->
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
					score: {},
					total_score: 0,
					questions: [],
					answers: [],
					players: [],
					player_answers:[],
					player_scores:{},
					matches: [],	
			},							
			computed: {	
				
			},
			filters: {
				profile: function(pid) {
				var baseURL = 'http://www.r2sports.com/tourney/imageGallery/gallery/player/';				
				return baseURL + pid + '_normal.jpg';
				}
			},		
			ready: function() {
                this.getQuestions();
                this.getAnswers();
                this.getPlayers();
                this.getPlayerAnswers();
            },		
			methods: {
				getQuestions: function() {
                    $.ajax({
                        context: this,
                        url: "/tools/doublesmatcher/api/questions",
                        success: function (result) {
                            this.$set("questions", result);
                        },
						error:function(x,e) {
							console.log("error getting questions: " + e.message);
						}
                    });
                },
                getAnswers: function() {
                    $.ajax({
                        context: this,
                        url: "/tools/doublesmatcher/api/answers",
                        success: function (result) {
                            this.$set("answers", result);
                        },
						error:function(x,e) {
							console.log("error getting answers: " + e.message);
						}
                    });
                },
                getPlayers: function() {
                    $.ajax({
                        context: this,
                        url: "/tools/doublesmatcher/api/players",
                        success: function (result) {
                            this.$set("players", result);
                        },
						error:function(x,e) {
							console.log("error getting players: " + e.message);
						}
                    });
                },
                getPlayerAnswers: function(player_id) {
                    $.ajax({
                        context: this,
                        url: "/tools/doublesmatcher/api/players/answers",
                        success: function (result) {
                            this.$set("player_answers", result);
                        },
						error:function(x,e) {
							console.log("error getting player answers: " + e.message);
						}
                    });
                },				
				computeScore: function(){
					this.total_score = 0;			
					for (var id in this.score) {
						var weight =  parseInt(this.score[id]);
						this.total_score+=  weight;
					};
					
					for (var p in this.player_answers) {						
						var player_id = this.player_answers[p].player_id;
						var question_id = this.player_answers[p].question_id;
						var answer_id = this.player_answers[p].answer_id;

console.log(player_id + ' ' + answer_id + ' ' + question_id);
						var value = this.answers[answer_id].value;
						var score =  Math.abs(value - this.score[question_id]) ;
						if ((Number.isInteger(value)) && (Number.isInteger(parseInt(player_id)))) {
							if (!this.player_scores[player_id]){
								this.player_scores[player_id] = { pid: player_id, score: 0 };
							}
							this.player_scores[player_id].score += value;
						}				
					}

					this.matches = [];
					for (var player_id in this.player_scores) {
						this.matches.push(this.player_scores[player_id]);
					}					
				}
			}
		});	
	</script>
@stop