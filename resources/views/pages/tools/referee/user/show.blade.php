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
			<h4>My Created Matches</h4>
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
		<div class="row">			
			<template v-for="m in matches">	
				<table class="table col-xs-12">
					<caption>
						<div class="col-xs-8">
							<label class="text-primary h5">@{{ m.tournament.name}} </label>
						</div>
						<div class="col-xs-4">
							<label class="text-default h6">@{{ m.date }}</label>
						</div>
					</caption>					
					<tr class="tr-games" v-bind:class="{'label-primary': m.isLive, 'label-success': m.isComplete, 'label-danger': !m.isLive && !m.isComplete}">
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
					<!-- Team 2 -->						
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
					<tr class="tr-games" v-bind:class="{'label-primary': m.isLive, 'label-success': m.isComplete, 'label-danger': !m.isLive && !m.isComplete}">
						<td></td>
						<td class="th-games">&nbsp;</td>
						<td class="th-games game-time"><span class="" title="Game Time" v-if="m.game_num >= 1" >@{{ m.timer.game[1] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 2" >@{{ m.timer.game[2] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 3" >@{{ m.timer.game[3] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 4" >@{{ m.timer.game[4] | secondsToTime }}</span></td>
						<td class=" th-games game-time"><span class="" title="Game Time"  v-if="m.game_num >= 5" >@{{ m.timer.game[5] | secondsToTime }}</span></td>	
					</tr>
					<tr class="tr-games label-info">
						<td colspan="5">&nbsp;</td>
						<td colspan="2" class=" th-games game-time"><span class="" title="Match Time">@{{ m.timer.match | secondsToTime }}</span></td>
					</tr>
					<tr>
						<td colspan="7">
							<!-- Match Actions -->
							<div class="">
								<div class="col-xs-3"> 
									<button class="btn btn-success btn-xs btn-block">Resume</button>
								</div>
								<div class="col-xs-3"> 
									<button class="btn btn-warning btn-xs btn-block">Edit</button>
								</div>
								<div class="col-xs-3"> 
									<button class="btn btn-danger btn-xs btn-block" v-on:click="confirmDelete(m)">Delete</button>
								</div>
							</div>
							<!-- Modal Confirm Reset -->
							<div id="confirmDeleteModal" class="score modal fade" role="dialog">
							  <div class="modal-dialog">
							    <!-- Modal content-->
							    <div class="modal-content modal-success">
							      	<div class="modal-body">
								      	<div class="row">
											<center><h3>Are you sure you want to delete match @{{ delete_title }} ?</h3></center>
										</div>	
										<div class="row">
											<button type="button" v-on:click="deleteMatch(delete_id)" class="btn btn-success" data-dismiss="modal">Yes</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
										</div>
							      	</div>
							    </div>
							  </div>
							</div>
						</td>
					</tr>							
				</table>
			</template>					
		</div>			
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

		var ref_id = {{ $user->id}};

		var matchesRef = firebase.database().ref('matches').orderByChild("referee/id").equalTo(ref_id);

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
				classLive: 'label-primary',
				classComplete: 'label-success',
				classDefault: 'label-warning',
				message: 'List of Live Matches',
				matches: [],
				matches_all: [],
				searchText: '',
				delete_id: null,
				delete_title: '',
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
			},		
			methods: {
				confirmDelete: function(match){
					this.delete_id = match.id,
					this.delete_title = match.title;
					$('#confirmDeleteModal').modal('show');
				},
				deleteMatch: function(key){
					console.log('delete: ' + key);

					var ref = firebase.database().ref('matches').orderByChild("id").equalTo(key);
					console.log(ref);

					var updates = {};
					updates['matches/'+ key] = null;
					return firebase.database().ref().update(updates);
				},
				search: function(){

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