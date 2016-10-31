@extends('pages.tools.layouts.referee')

@section('style')
	<style>
		.player {
			font-weight: 500;
			font-size: 14pt;
		}
		.player-sum {
			font-weight: 500;
			font-size: 10pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 9pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 9pt;
		}
		.score {
			font-weight: 500;
			font-size: 8pt;
			text-align: center;
		}
		.th-games {
			text-align: center;
			color: white;
		}
		.nopadding {
			padding: 0px !important;
		}
		td {
			padding: 2px !important;
		}
		.tr-games {
			font-weight: 300;
			font-size: 8pt;
		}
		.game-time{
			font-size: 8pt;
			color:white;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.purple {
			color:#7E43CB;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px 5px 5px;
		   padding-right: 5px;
		}
		h3  > *{
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
		.timeout .modal-backdrop {
	    	background-color: yellow;
		}
		.winner .modal-backdrop {
	    	background-color: green;
		}	
		.btn-actions {
			margin-top: 150px;			
			margin-bottom: 10px;
		}
	</style>
@stop

@section('ref-content')

<div class="col-xs-12">
	<div id="myvue" class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
		
		<div class="col-xs-12">
			<h4>Completed Matches</h4>
		</div>
		<div class="col-xs-10">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-search" for="search"></i></span>							
				<input type="text" id="search" v-model="searchText" class="form-control input-sm" placeholder="Search"></input>				
			</div>
		</div>
		<div>
			<button id="btnSearch" class="btn btn-sm btn-default" v-on:click="search">GO</button>
		</div>
		<br>
		<!-- List of Matches -->
		<div class="row">
		  	<template v-for="m in matches">			    	
			    		<div class="">	
			    			<table class="table col-xs-12 well">
							<caption>
								<div class="col-xs-8">
									<label class="text-primary h5">@{{ m.tournament.name}} </label>
								</div>
								<div class="col-xs-4">
									<label class="text-default h6">@{{ new Date(m.date).toLocaleString() }}</label>
								</div>								
							</caption>					
							<tr class="tr-games label-success ">
								<th class="col-xs-9 th-games">@{{ m.title}} </th>
								<th class="col-xs- th-games"></th>
								<th class="col-xs- th-games"><span v-if="m.game_num >= 1">1</span></th>
								<th class="col-xs- th-games"><span v-if="m.game_num >= 2">2</span></th>
								<th class="col-xs- th-games"><span v-if="m.game_num >= 3">3</span></th>
								<th class="col-xs- th-games"><span v-if="m.game_num >= 4">4</span></th>
								<th class="col-xs- th-games"><span v-if="m.game_num >= 5">5</span></th>
							</tr>
							<tr>
								<td class="col-xs-9">
									<div class="player-sum">@{{ m.players[1].name }}		

										<i class="fa fa-circle fa-xs" 
											v-bind:class="[m.faults >= 1? classRed : classPurple]" 
											v-show="m.server == m.players[1].pos">
										</i> 
										<span class="player-sum" v-show="m.players[2].name != ''">&amp;</span>
										<span class="player-sum" v-show="m.players[2].name != ''">@{{ m.players[2].name }}
											<i class="fa fa-circle fa-xs" 
												v-bind:class="[m.faults >= 1? classRed : classPurple]"  
												v-show="m.server == m.players[2].pos">
											</i>
										</span>
										<i v-show="m.isWinner == 1" class="fa fa-trophy text-warning"></i>
									</div>				
									<div class="" >								
										  <span class="badge label-warning" title="timeouts"><i class="fa fa-clock-o fa-xs"></i> @{{ m.team[1].timeouts }}</span>
										<span class="" >
											<span class="badge label-danger" title="appeals"><i class="fa fa-thumbs-down fa-xs"></i> @{{ m.team[1].appeals  }}</span>
										</span>
									</div>	
								</td>					
								<td class="score">															
									<div class="" v-show="m.game_num > 1">								
										<span class="badge">@{{ m.team[1].wins }}</span>
									</div>
								</td>	
										
								<td class="score" v-for="g in m.team[1].games" v-if="g.gm > 0" v-bind:class="[g.score < m.score_max && g.gm < m.game_num? classLoss: g.score >= m.score_max? classWin: '']">
									<span v-if="m.game_num >= g.gm"> @{{ g.score }} </span>
								</td>
							</tr>	
									
							<tr>
								<td class="col-xs-9">
									<div class="player-sum">@{{ m.players[3].name }}
										<i class="fa fa-circle fa-xs" 
											v-bind:class="[m.faults >= 1? classRed : classPurple]" 
											v-show="m.server == m.players[3].pos ">
										</i>
										<span class="player-sum" v-show="m.players[4].name != ''">&amp;</span>
										<span class="player-sum" v-show="m.players[4].name != ''">@{{ m.players[4].name }}
											<i class="fa fa-circle fa-xs" 
												v-bind:class="[m.faults >= 1? classRed : classPurple]" 
												v-show="m.server == m.players[4].pos ">
											</i>
										</span>
										<i v-show="m.isWinner == 2" class="fa fa-trophy text-warning"></i>
									</div>
									<div class="">								
										<span class="badge label-warning" title="timeouts"><i class="fa fa-clock-o fa-xs"></i> @{{ m.team[2].timeouts }}</span>							
										<span class="col-xs" >
											<span class="badge label-danger" title="appeaks"><i class="fa fa-thumbs-down fa-xs"></i> @{{ m.team[2].appeals  }}</span>
										</span>	
									</div>
								</td>
								<td class="score">
									<div class="col-xs" v-show="m.game_num > 1"><span class="badge">@{{ m.team[2].wins }}</span></div>
								</td>
								<td class="score" v-for="g in m.team[2].games" v-if="g.gm > 0" v-bind:class="[g.score < m.score_max && g.gm < m.game_num? classLoss: g.score >= m.score_max? classWin: '']">
										<span v-if="m.game_num >= g.gm"> @{{ g.score }} </span>
								</td>
							</tr>
							<tr class="tr-games label-success ">
								<td></td>
								<td class="th-games">&nbsp;</td>
								<td class="th-games game-time"><span class="" title="Game Time" v-if="m.game_num >= 1" >@{{ m.timer.game[1] | secondsToTime }}</span></td>
								<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 2" >@{{ m.timer.game[2] | secondsToTime }}</span></td>
								<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 3" >@{{ m.timer.game[3] | secondsToTime }}</span></td>
								<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 4" >@{{ m.timer.game[4] | secondsToTime }}</span></td>
								<td class=" th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 5" >@{{ m.timer.game[5] | secondsToTime }}</span></td>	
							</tr>
							<tr class="tr-games label-info">
								<td colspan="5"><span class="game-time">Ref: @{{ m.referee.name }}</span></td>
								<td colspan="2" class=" th-games game-time"><span class="" title="Match Time">@{{ m.timer.match | secondsToTime }}</span></td>
							</tr>							
							</table>
						</div>	
			</template>	
		</div>
		<!-- end list of matches -->	
	</div>
</div>

@stop

@section('script')
	<!--script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
	<!-- Firebase --> 
    <!--script src="https://www.gstatic.com/firebasejs/3.5.1/firebase.js"></script>
    <!-- VueFire -->
	<!--script src="https://cdn.jsdelivr.net/vuefire/1.0.0/vuefire.min.js"></script -->

    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyDOYjrE7msWmi09Qw6YHH5K_7OX6DJpHzk",
        authDomain: "racquetballhub.firebaseapp.com",
        databaseURL: "https://racquetballhub.firebaseio.com",
        storageBucket: "racquetballhub.appspot.com",
        messagingSenderId: "67100105837"
      };
      firebase.initializeApp(config);
    </script>
	<script>

		Vue.config.debug = true;
		Vue.config.devtools = true;		

		var matchesRef = firebase.database().ref('matches').orderByChild('isComplete').equalTo(true);


		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: true,
				classWin: 'win',
				classLoss: 'loss',
				classRed: 'red',
				classBlack: 'black',
				classPurple: 'purple',
				classEnabled: 'active',
				classDisabled: 'disabled',
				message: 'List of Live Matches',
				matches: [],
				matches_all: [],
				searchText: '',
			},
			firebase: {
				//matches: matchesRef.limitToLast(3)
			},	
			mounted: function(){
				console.log('mounted');

				// Retrieve new posts as they are added to our database
				matchesRef.on("child_added", function(snapshot, prevChildKey) {
				  var match = snapshot.val();
				  vm.matches.push(match);
				  vm.matches_all.push(match);
				});

				//Updates any changes all matches
				matchesRef.on("value", function(data) {
					vm.matches = data.val();
					vm.matches_all = data.val();
				});

				//this.matches = matchesRef;
			},
			filters: {
				secondsToTime: function(secs) {

					if (secs){
						secs = secs.toString();
						var date = new Date(null);
        				date.setSeconds(secs); // specify value for SECONDS here
        				return date.toISOString().substr(12, 7);
        			} else if (secs == 0)
        			{
        				return "";
        			}	
				},	
				tolocalDate: function(utc) {

					var date = new Date(utc);
					console.log('date:' + date)
    				return date.toLocaleString();
				},	
			},	
			methods: {
				search: function(){
					console.log('search');
					if (this.searchText == '') {
						results = this.matches_all;
					}
					else {
						console.log('search for ' + this.searchText);
						var results = [];
						var that = this;

						$.each(this.matches_all, function(key, match) {

							//Todo: Search Tournament
							//Search Match Title
							if ( match.title.toLowerCase().indexOf(that.searchText.toLowerCase()) >=0 ) {
								results.push(match); 
							}
							else {
								//Search Player Names
								for (var i = match.players.length-1; i >= 1; i--) {
									if ( match.players[i].name.toLowerCase().indexOf(that.searchText.toLowerCase()) >=0 ) {
										results.push(match); 
										break;										
									}
								}
							}		
						});
					}

					this.matches = results;

				},
			},					
		});	
	</script>
@stop