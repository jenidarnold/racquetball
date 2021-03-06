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
		.progress{
		background-color: #A8A8A8; !important
		}
		.progress-radius {
			border-radius: 0;
		}		
		.progress-bar{
			float: right;
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
								<form class="form-inline" role="form" >
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group">
										@if (Auth::guest())										
											<input id="player_id" v-model="player_id" placeholder="Player ID" type="text" class="form-control input-sm">
										@endif
									</div>
									<ul v-for="q in questions">
										<span class="question">@{{q.id}}. @{{ q.question }}</span><br/>
										<select v-model="score[q.id]" class="form-control" v-on:change="computeScore">
										  <option value="0" selected="true"></option>
										  <option v-for="a in answers | filterBy q.id in 'question_id'" v-bind:value="a.value">
										    @{{ a.answer }}
										  </option>
										</select>
									</ul>
									<div class="row">
										<div class="col-xs-2"> 
											<button class="btn btn-success" type="button" v-on:click="savePlayerAnswers" >Save</button>
										</div>
										<div class="col-xs-2">
											<button class="btn btn-danger">Reset</button>
										</div>
									</div>								
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
								<ul v-for="m in matches| orderBy 'score' -1">
									<div class="row">
										<div class="col-xs-2">
											<div class="profile">
												<img class='img-profile' v-bind:src="m.pid | profile">
											</div>
										</div>
										<div class="col-xs-7">
											<span class="player">@{{players[m.pid].first_name}} @{{players[m.pid].last_name}}</span>		
										</div>
										<!--div class="col-xs-3">
											<span v-for="s in m.score">
												<i class ="fa fa-star fa-xs star"></i>
											</span>
										</div-->
										<div class="col-xs-3">
											<bar-chart v-bind:percent="m.score | progress"  foreground-color="#00cc00" background-color="#DCDCDC"></bar-chart>
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
<script type="text/x-template" id="bar-template">
  	<div class="bar-outer" style="width: 100%; height: @{{height}}; background-color: @{{backgroundColor}};">
    	<div class="bar-inner" style="width: @{{percent}}%; height: @{{height}};  background-color: @{{foregroundColor}}">
	</div>
</script>
@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>	
	<script>
		Vue.config.debug = false;

		Vue.component('bar-chart', {
		  props: ['percent', 'foreground-color', 'background-color'],
		  template: '#bar-template',
		  replace: true,
		  data: function () {
		    return {
		      // default values
		      foregroundColor: "#0040ff",
		      backgroundColor: "#bada55",
		      percent: 0,
		      height: '1em'
		    }
		  },
		});

		new Vue({
			el: '#myvue',			
			data: {	
					debug: false,
					score: {},
    				barValue: 5,
					total_score: 0,
					max_score: 5,
					questions: [],
					answers: [],
					players: [],
					player_id: {{ Auth::user()->player_id}},
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
				},
				progress: function(score){					
					if (score > this.max_score) {
						return 100;
					}
					return parseInt(score/this.max_score*100);
				}
			},		
			ready: function() {
				//ajax functions
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
                savePlayerAnswers: function() {                	
                	$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
				        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
				        if (token) {
				            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
				        }
				    });
                    $.ajax({
                        context: this,
                        type: "POST",
                        data: {
                        	player_id: this.player_id,
                        	player_answers: this.score,
                        },
                        url: "/tools/doublesmatcher/api/players/answers/save",
                        success: function (result) {
                            this.$set("player_answers", result);
                        },
						error:function(x,e) {
							console.log("error saving player answers: " + e.message);
						}
                    });
                },		
                getCompareValue: function(category_id, answer_id){       
                    var compare_value = 0;

                	if( category_id == 1) {
						compare_value = parseInt(this.answers[answer_id].value);
					}
                	else {
						compare_value = parseInt(this.answers[answer_id].conjugate);
						console.log('A: ' + answer_id + ' conjugate: ' + compare_value);
					}
					return compare_value;
                },                            
				computeScore: function(){
					this.total_score = 0;			
					for (var id in this.score) {
						var weight =  parseInt(this.score[id]);
						this.total_score+=  weight;
					};
					
					//reset scores since answer changed
					for (var player_id in this.player_answers) {
						this.player_scores[player_id] = { pid: player_id, score: 0 };
					}
					//this.max_score = 0;

					//Calculate scores
				
					for (var player_id in this.player_answers) {						
						
						for (var q in this.player_answers[player_id]) {
							var question_id = this.player_answers[player_id][q].question_id;
							var answer_id = this.player_answers[player_id][q].answer_id;
							var category_id = parseInt(this.questions[q-1].category_id);
							var compare_value = this.getCompareValue(category_id, answer_id);
														
							//console.log(player_id + ' Q: ' + question_id + ' A: ' + answer_id + ' Val: ' + compare_value );

							if ((Number.isInteger(compare_value)) && (Number.isInteger(parseInt(player_id)))){
								if (!this.player_scores[player_id]){
									this.player_scores[player_id] = { pid: player_id, score: 0 };
								}								
								var score =  Math.abs(compare_value - this.score[question_id]) ;
								this.player_scores[player_id].score += score;
							}								
						}			
					}

					//reset matches since answer changed
					this.matches = [];
					for (var player_id in this.player_scores) {
						this.matches.push(this.player_scores[player_id]);
					}					
				}
			}
		});	
	</script>
@stop