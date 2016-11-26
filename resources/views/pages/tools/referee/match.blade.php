@extends('pages.tools.layouts.referee')

@section('style')
	<style>
		.player {
			font-weight: 500;
			font-size: 14pt;
		}
		.player-sum {
			font-weight: 500;
			font-size: 12pt;
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
			font-size: 12pt;
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
			font-size: 9pt;
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
		.match.timer {
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
	<div id="myvue" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div id="setup" v-if="match.showSetup">
			<form class="form-inline" role="form">	
				<div class="row">			
					<!--div class="row">
						 <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Tournament:</label>				
							<select v-model="match.tournament" id="ddlTournaments" class="form-control">
							  	<option v-for="t in tournaments" v-bind:value="match.tournament">
							    	@{{ t }}
							  	</option>
							</select>	
						</div>
					</div-->					
			    	<div class="row">
					    <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Match Title:</label>
							<input class="form-control" id="title" placeholder="Enter Match Title" v-model="match.title">
					    </div>
					</div>
					<div class="row">
					    <div class="col-xs-12 col-sm-12 form-group">
							<label for="title" class="control-label lbl-team">Referee:</label>
							<input class="form-control" id="referee" v-model="match.referee.name">
					    </div>
					</div>
					<div class="row">	
					    <div class="col-xs-12 col-sm-12 form-group">				    
							<label for="game_format" class="control-label lbl-team">Game Format: </label>
							<select v-model="game" id="game_format" class="form-control">
							  	<option v-for="game in game_formats" v-bind:value="game">
							    	@{{ game.name }}
							  	</option>
							</select>								
						</div>
					</div>
				</div>
				<div class="row">							
					<div class="row">
						<div class="col-xs-12 form-group">
							<label class="radio-inline">
						      	<input type="radio" id="singles" value="2" v-model="match.max_players">Singles
						    </label>
						    <label class="radio-inline">
						      	<input type="radio" id="doubles" value="4" v-model="match.max_players">Doubles
						    </label>
						</div>
					</div>
					<div class="row">			
						<div class="col-xs-12 col-sm-12  form-group">
							<label for="team1" class="control-label lbl-team ">@{{match.team[1].name}}:</label>
						    <input class="form-control" id="team1" v-model="match.players[1].name" v-bind="{'placeholder':match.team[1].placeholder[0]}">
						    <input class="form-control" v-model="match.players[2].name" v-bind="{'placeholder':match.team[1].placeholder[1]}" v-if="isDoubles == true">
						</div>				
						<div class="col-xs-12 col-sm-12  form-group">
						    <label for="team2" class="control-label lbl-team ">@{{match.team[2].name}}:</label>
						    <input class="form-control" id="team2" v-model="match.players[3].name" v-bind="{'placeholder':match.team[2].placeholder[0]}">
						    <input class="form-control" v-model="match.players[4].name" v-bind="{'placeholder':match.team[2].placeholder[1]}"  v-if="isDoubles == true">
						</div>	
					</div>	
					<div class="row">	
						<div class="col-xs-12 col-sm-12 form-group">
							<label for="server" class="control-label lbl-team">Starting Server: </label>
							<br>					
							{{-- <select id="server" v-model="server" class="form-control">
							  	<option v-for="player in match.players" v-bind:value="player.pos">
							    	@{{ player.name }}
							  	</option>
							</select>	 --}}
						</div>
					</div>
				</div>	
			</form>
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-3 col-xs-offset-1">
				    	<button class="btn btn-info" v-on:click="saveMatch" v-bind:class="{'disabled':match.title == ''}">Save</button>
				    </div>
				    <div class="col-xs-3">
				    	<button class="btn btn-success" v-on:click="startMatch" v-bind:class="{'disabled':match.id == '0'}">Start</button>
				    </div>		
				    <div class="col-xs-3">
				    	<button class="btn btn-danger" v-on:click="resetMatch">Reset</button>
				    </div>
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
		</div>

		<!-- Match Table -->
		<div v-show="match.isStarted && !match.showSetup">	
			<!--div>
				<h4 class="text-left">
					<span class="text-primary">@{{ match.tournament }}</span>
					<div style="float:right">	
						<button v-on:click="confirmReset" class="btn btn-success btn-sm" v-bind:class="match.isStarted? classEnabled : classDisabled">New Match</button>	
					</div>
				</h4>
			</div-->
			<div id="divMatch" class="">			
				<table class="table col-xs-12 well">					
					<tr class="tr-games label-primary ">
						<th class="col-xs-9 th-games">@{{ match.title }}</th>
						<th class="col-xs- th-games"></th>
						<th class="col-xs- th-games"><span v-if="match.game_num >= 1">1</span></th>
						<th class="col-xs- th-games"><span v-if="match.game_num >= 2">2</span></th>
						<th class="col-xs- th-games"><span v-if="match.game_num >= 3">3</span></th>
						<th class="col-xs- th-games"><span v-if="match.game_num >= 4">4</span></th>
						<th class="col-xs- th-games"><span v-if="match.game_num >= 5">5</span></th>
					</tr>
					<tr>
						<td class="col-xs-9">
							<div class="player-sum">@{{ match.players[1].name }}								
								<i class="fa fa-circle fa-xs" 
									v-bind:class="[match.faults >= 1? classRed : classPurple]" 
									v-show="match.server == match.players[1].pos">
								</i> 
								<span class="player-sum" v-show="match.players[2].name != ''">&amp;</span>
								<span class="player-sum" v-show="match.players[2].name != ''">@{{ match.players[2].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[match.faults >= 1? classRed : classPurple]"  
										v-show="match.server == match.players[2].pos">
									</i>
								</span>
								<i v-show="match.isWinner == 1" class="fa fa-trophy text-warning"></i>
							</div>
							<div class="" v-show="match.isStarted">
								<button v-on:click="timeout(1)" data-toggle="modal" data-target="#timeoutModal1" class="btn btn-warning btn-sm" v-bind:class="match.isStarted && (match.team[1].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								  <span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ match.team[1].timeouts }}</span></button>
								<span class="" v-show="match.isStarted">
									<button v-on:click="appeal(1)" class="btn btn-danger btn-sm" v-bind:class="match.isStarted && match.team[1].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ match.team[1].appeals  }}</span>
									</button>
								</span>
							</div>	
						</td>
						<td class="score">															
							<div class="" v-show="match.game_num > 1">								
								<span class="badge">@{{ match.team[1].wins }}</span>
							</div>
						</td>
						<td class="score" v-for="g in match.team[1].games" v-if="g.gm > 0" v-bind:class="[g.score < match.score_max && g.gm < match.game_num? classLoss: g.score >= match.score_max? classWin: '']">
							<span v-if="match.game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr>
						<td class="col-xs-9">
							<div class="player-sum">@{{ match.players[3].name }}
								<i class="fa fa-circle fa-xs" 
									v-bind:class="[match.faults >= 1? classRed : classPurple]" 
									v-show="match.server == match.players[3].pos ">
								</i>
								<span class="player-sum" v-show="match.players[4].name != ''">&amp;</span>
								<span class="player-sum" v-show="match.players[4].name != ''">@{{ match.players[4].name }}
									<i class="fa fa-circle fa-xs" 
										v-bind:class="[match.faults >= 1? classRed : classPurple]" 
										v-show="match.server == match.players[4].pos ">
									</i>
								</span>
								<i v-show="match.isWinner == 2" class="fa fa-trophy text-warning"></i>
							</div>
							<div class="" v-show="match.isStarted">
								<button v-on:click="timeout(2)" data-toggle="modal" data-target="#timeoutModal2" class="btn btn-warning btn-sm" v-bind:class="match.isStarted && (match.team[2].timeouts > 0 || timeoutTimer) ? classEnabled : classDisabled">
								<span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ match.team[2].timeouts }}</span></button>							
								<span class="col-xs" v-show="match.isStarted">
									<button v-on:click="appeal(2)" class="btn btn-danger btn-sm" v-bind:class="match.isStarted && match.team[2].appeals > 0? classEnabled : classDisabled"><span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ match.team[2].appeals  }}</span></button>
								</span>	
							</div>
						</td>
						<td class="score">
							<div class="col-xs" v-show="match.game_num > 1"><span class="badge">@{{ match.team[2].wins }}</span></div>
						</td>
						<td class="score" v-for="g in match.team[2].games"  v-if="g.gm > 0" v-bind:class="[g.score < match.score_max && g.gm < match.game_num? classLoss: g.score >= match.score_max? classWin: '']">
								<span v-if="match.game_num >= g.gm"> @{{ g.score }} </span>
						</td>
					</tr>
					<tr class="tr-games label-primary ">
						<td></td>
						<td class="th-games">&nbsp;</td>
						<td class="th-games game-time"><span class="" v-if="match.game_num >= 1" >@{{ match.timer.game[1] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="match.game_num >= 2" >@{{ match.timer.game[2] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="match.game_num >= 3" >@{{ match.timer.game[3] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="match.game_num >= 4" >@{{ match.timer.game[4] | secondsToTime }}</span></td>
						<td class=" th-games game-time"><span class="" v-if="match.game_num >= 5" >@{{ match.timer.game[5] | secondsToTime }}</span></td>						
					</tr>
					<tr class="tr-games label-info">
						<td colspan="5">&nbsp;</td>
						<td colspan="2" class=" th-games game-time"><span class="">@{{ matchTimer | secondsToTime }}</span></td>
					</tr>
					<tr>
						<td colspan="7">
							<!-- Match Actions -->
							<div class="">
								<div class="btn-group col-xs-7">
									<button class="btn btn-default btn-sm" v-on:click="shareMatch(match);">
										<i class="fa fa-share-alt-square"></i></button>									
									<button class="btn btn-default btn-sm" v-on:click="editMatch(match);">
										<i class="fa fa-step-backward"></i></button>
									<button class="btn btn-default btn-sm" v-bind:class="{'hidden': match.isComplete || match.isLive}" v-on:click="playMatch(match);">
									<i class="fa fa-play"></i></button>

									<button class="btn btn-default btn-sm" title="Pause Match" v-bind:class="{'hidden': match.isComplete || (!match.isLive && !match.isComplete) }" v-on:click="pauseMatch(match);">
									<i class="fa fa-pause"></i></button>
									
									<button class="btn btn-default btn-sm" title="Pause Match" v-bind:class="{'hidden': match.isComplete || (!match.isLive && !match.isComplete) }" v-on:click="goLiveFB(match);">
									<i class="fa fa-circle text-danger"></i></button>
									
									<button class="btn btn-default btn-sm" title="Delete Match" v-on:click="confirmDelete(match)"><i class="fa fa-times"></i></button>
								</div>	
								<div class="btn-group col-xs-5">
									<label class=" label label-danger" v-show="match.fb_id > 0">Shared on FB</label>
									<label class=" label label-danger" v-show="match.isLive">Match is Live</label>
									<label class=" label label-success" v-show="match.isComplete">Match is Complete</label>
									<label class=" label label-default" v-show="!match.isLive && !match.isComplete">Match is Paused</label>
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
			</div>
			<div class="row">	
				<div class="col-xs-12">					
					<!-- div class="col-xs-3 text-center">
						<button v-on:click="endMatch" class="btn btn-danger btn-sm" v-bind:class="match.isStarted? classEnabled : classDisabled">Stop Match</button>
					</div -->
					<!-- div class="col-xs-4">
						<button v-on:click="resumeMatch" class="btn btn-warning btn-sm" v-bind:class="match.isStarted? classEnabled : classDisabled">Resume Match</button>
					</div -->					
				</div>	
			</div>
			<div class="row btn-actions">
				<div class="col-xs-6">		
					<button v-on:click="point" class="btn btn-block btn-success btn-lg" v-bind:class="match.isStarted && match.isLive? classEnabled : classDisabled"><i class="fa fa-check"></i> Point</button>
					<button v-on:click="sideout" class="btn btn-block btn-danger btn-lg" v-bind:class="match.isStarted && match.isLive? classEnabled : classDisabled"><i class="fa fa-refresh"></i> Out Serve</button>	
				</div>
				
				<div class="col-xs-6">	
					<button v-on:click="fault" class="btn btn-block btn-warning btn-lg" v-bind:class="match.isStarted && match.isLive? classEnabled : classDisabled"><i class="fa fa-exclamation"></i> Fault</button>	
					<button v-on:click="undo" class="btn btn-block btn-default btn-lg" v-bind:class="match.isStarted && match.isLive? classEnabled : classDisabled"><i class="fa fa-rotate-left"></i> Undo</button>					
				</div>
			</div>
		
		<!--canvas id="canvas" width="300" height="300" style="border:1px solid      #d3d3d3;"-->


	<!-- Modal Team 1 Time out-->
	<div id="timeoutModal1" class="timeout modal fade" role="dialog">
	  <div class="modal-dialog alert-warning">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	       	 	<center>
		       	 	<h3 class="modal-title"><i class="fa fa-clock-o"></i> Time Out</h3>
		       	 	<h4>@{{ match.team[1].name}}</h4>
		       	 </center>
	      	</div>
	      <div class="modal-body alert-warning">
	        <center>
    	    	<h1><span class="match.timer"> @{{match.timer.team[1].timeout | timeoutToTime}}</h1></span>
            </center>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" v-on:click="timeout(1)" class="btn btn-default" data-dismiss="modal">Time In</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Team 2 Time out-->
	<div id="timeoutModal2" class="timeout modal fade" role="dialog">
	  <div class="modal-dialog alert-warning">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	      		<center>
	      	 		<h3 class="modal-title"><i class="fa fa-clock-o"></i> Time Out</h3>
	      	 		<h4>@{{ match.team[2].name}}</h4>
	      	 	</center>
	      	</div>
	      <div class="modal-body alert-warning">
	        <center><h1><span class="match.timer"> @{{match.timer.team[2].timeout | timeoutToTime}}</h1></center>
	      </div>
	      <div class="modal-footer">
	        	<button type="button" v-on:click="timeout(2)" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Welcome -->
	<div id="welcomeModal" class=" modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content alert-info">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h1><span class=""><i class="fa fa-circle purple"></i></span> Racquetball</h1></center>
					<center><h1><span class="">Referee <i class="fa fa-street-view text-info"></i></span></h1></center>
				</div>	
				<div class="row">
					<center><button type="button" class="btn btn-success" data-dismiss="modal">Get Started</button></center>
				</div>
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Intermission -->
	<div id="intermissionModal" class="intermission modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	 <h3 class="modal-title">Intermission</h3>
	      </div>
	      <div class="modal-body">
	        <center><h1><span class="label label-warning timer"> @{{match.timer.intermission[match.game_num - 1] | secondsToTime}}</h1></center>
	      </div>
	      <div class="modal-footer">
	        <button type="button" v-on:click="intermission('stop')" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Score -->
	<div id="scoreModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-success">
		      	<div class="row">
					<center><h2>@{{ match.service  }} </h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Fault -->
	<div id="faultModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-warning">
		      	<div class="row">
					<center><h2>Fault</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Sideout/Handout -->
	<div id="sideoutModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body alert-danger">
		      	<div class="row">
					<center><h2>@{{ match.sideout_type }}</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Undo -->
	<div id="undoModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-default">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h2>Undo @{{ match.last_step}}</h2></center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Winner-->
	<div id="winnerModal" class="winner modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body">
		      	<div class="row">
					<center>
						<h2><span class="text-warning"><i class="fa fa-trophy fa-3x"></i></span></h2>
						<h1> @{{ match.winner }}</h1>
					</center>
				</div>	
	      	</div>
	    </div>
	  </div>
	</div>

	<!-- Modal Confirm Reset -->
	<div id="confirmResetModal" class="score modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal-success">
	      	<div class="modal-body">
		      	<div class="row">
					<center><h3>Are you sure you want to start a new match?</h3></center>
				</div>	
				<div class="row">
					<button type="button" v-on:click="resetMatch" class="btn btn-success" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
	      	</div>
	    </div>
	  </div>
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
	<!--script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js"></script>
	<!-- Firebase --> 
    <!--script src="https://www.gstatic.com/firebasejs/3.5.1/firebase.js"></script -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'></script>
    <script src="https://cdn.jsdelivr.net/canvas2image/0.1/canvas2image.min.js"></script>
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

		var matchTimer;
		var gameTimer; //current game match.timer
		var injuryTimer; 
		var timeoutTimer;  //match.team timeouts
		var intermissionTimer; //timeout between games

		Vue.config.debug = true;
		Vue.config.devtools = true;

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

		function removeNullsInObject(obj) {
		    if( typeof obj === 'string' ){ return; }
		    $.each(obj, function(key, value){
		        if ( value === null){
		            delete obj[key];
		        } else if ($.isArray(value)) {
		            if( value.length === 0 ){ delete obj[key]; return; }
		            $.each(value, function (k,v) {
		                removeNullsInObject(v);
		            });
		        } else if (typeof value === 'object') {
		            if( Object.keys(value).length === 0 ){ 
		                delete obj[key]; return; 
		            }
		            removeNullsInObject(value);
		        }
		    }); 
		 }

		var match_id = '{{ $match_id}}';
		var user_id = {{ $user->id }};

		var matchesRef = firebase.database().ref('matches');
		var matchRef = firebase.database().ref('matches').orderByChild("id").equalTo(match_id);
		var t = JSON.parse(JSON.stringify({!! $tournaments !!} ));
		
		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: true,
				preview: false,
				classWin: 'win',
				classLoss: 'loss',
				classRed: 'red',
				classBlack: 'black',
				classPurple: 'purple',
				classEnabled: 'active',
				classDisabled: 'disabled',							
				tournaments: t  ,												
				game_formats: [ 	
							{id: 0, name:''},
							{id: 1, name:'2 games to 11; Tie to 7',  
								games:3,  points:11, tie:7, win_by: 1, timeouts:2, timeout_secs:30, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:2},
							{id: 2, name:'2 games to 15; Tie to 11',  
								games:3,  points:15, tie:11, win_by: 1, timeouts:3, timeout_secs:30, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:2},
							{id: 3, name:'Best of 5 games to 11', 
								games:5,  points:11, tie:7, win_by: 2, timeouts:3, timeout_secs:60, intermission_norm:120, intermission_tb:300, injury_secs:900, appeals:3},
							{id: 4, name:'1 game to 11', games:1,  points:11, tie:0, win_by: 1, timeouts:1, timeout_secs:30, intermission_norm:0, intermission_tb:0, injury_secs:900, appeals:0},
							{id: 5, name:'1 game to 15', games:1,  points:15, tie:0, win_by: 1, timeouts:1, timeout_secs:30, intermission_norm:0, intermission_tb:0, injury_secs:900, appeals:0}
						],	
				delete_id: null,
				delete_title: '',
				game: [],
				//Match Specific	
				match: {
						id: '{{ $match_id}}',
						fb_id: 0,
						tournament: {},
						referee: {
									id: {{ $user->id}}, 
									name: '{{ $user->first_name}} {{ $user->last_name}}', 
								 },
						title: '',
						date: '', 
						winner:'',
						showSetup: true,
						isStarted: false,
						isComplete: false,
						isLive: false,
						initServer: 1,
						server: 1,
						score_steps: [],
						game_num: 1,
						max_players: 4,		
						service:'',
						sideout_type: 'Sideout',
						last_step:'',				
						faults: 0,
						score_max: 11,   // 11 or 15
						tiebreaker: 7,   // 7 or 11
						game_max: 2,     // 2 or 3
						total_games: 3,  // 3 or 5
						win_by: 1,       // 1 or 2
						isWinner: 0,
						completeDate: '',
						last_play: '',
						game: [],
						score_steps: [],
						players: 
								{ 	1: {name:'', pos: 1 }, 
									2: {name:'', pos: 2 },  
									3: {name:'', pos: 3 }, 
									4: {name:'', pos: 4 }
								},			
						team: 	{
									1: 	
										{
											name: 'Team 1',
											placeholder: ['Enter Team Player 1', 'Enter Team Player 2'],
											serves:1,
											wins: 0,
											timeouts: 0,
											appeals: 0,
											injury: 0,
											games: {
												0: {score: 0, gm: 0 }, 
												1: {score: 0, gm: 1 }, 
												2: {score: 0, gm: 2 },
												3: {score: 0, gm: 3 },
												4: {score: 0, gm: 4 },
												5: {score: 0, gm: 5 },
											}
										},						
									2: 	
										{	
											name: 'Team 2',
											placeholder: ['Enter Team Player 1', 'Enter Team Player 2'],
											serves:1,
											wins: 0,
											timeouts: 0,
											appeals: 0,
											injury: 0,
											games: {
												0: {score: 0, gm: 0 },
												1: {score: 0, gm: 1 }, 
												2: {score: 0, gm: 2 },
												3: {score: 0, gm: 3 },
												4: {score: 0, gm: 4 },
												5: {score: 0, gm: 5 },
											}
										}
								},									
						timer: {
									match: 0,
									game: {
											1:0,
											2:0,
											3:0,
											4:0,
											5:0,
										},
									intermission: {
											1:0,
											2:0,
											3:0,
											4:0,
										},
									team: {
											1:{						
												timeout: 0, 
												injury: 0,
											},
											2:{						
												timeout: 0, 
												injury: 0,
											}
									}
								},
					}, //end match data
						
			},	
			mounted: function(){
				console.log('mounted');

				if(match_id != 0) {
					// Retrieve new posts as they are added to our database
					matchRef.on("child_added", function(snapshot, prevChildKey) {					
						vm.match = snapshot.val();
						//vm.match = removeNullsInObject(vm.match);
						console.log('Load match:');
						//console.log(JSON.stringify(vm.match));
						vm.game = vm.match.game;
					});					
				}
			},	
			firebase:{
				matches: matchesRef
			},						
			computed: {
				isDoubles: function(){		
					if(this.match.max_players == 2 ){
						this.match.team[1].name ="Player 1";
						this.match.team[2].name ="Player 2";
						this.match.team[1].placeholder[0] = "Enter Player 1";
						this.match.team[2].placeholder[0] = "Enter Player 2";
					}else {
						this.match.team[1].name ="Team 1";
						this.match.team[2].name ="Team 2";
						this.match.team[1].placeholder[0] = "Enter Team Player 1";
						this.match.team[2].placeholder[0] = "Enter Team Player 1";	
					}

					if (this.match.max_players == 4) {
						return true;
					}
					else {
						return false;
					}
				},
				isTiebreaker: function(){
					if(this.match.game_num == this.total_games) {
						this.match.score_max = this.match.game.tie;
						return true;
					}
					else {
						return false;				
					}
				}
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
				timeoutToTime: function(secs) {
					if (secs){
						secs = secs.toString();
						var date = new Date(null);
        				date.setSeconds(secs); // specify value for SECONDS here
        				return date.toISOString().substr(12, 7);
        			} else if (secs == 0)
        			{
        				return "Time is Up!";
        			}	

				}
			},				
			methods: {
				startMatch: function(event){
					this.match.showSetup = false;

					console.log('Start Match');
					//this.dumpMatch();

					this.match.isStarted = true;
					
					this.startTimer('match');
					this.startTimer('game');
					this.match.score_steps = [];

					this.match.isLive = true;
					this.updateMatchToDB();					
				},
				saveMatch: function(event){ 
					// enable point, sideout, fault, etc					
					
					//New match, save variables not set in match from game_format
					if (this.match.id == 0 ) {
						this.match.game = this.game;
						this.match.total_games = this.game.games;
						this.match.score_max = this.game.points;
					}

					//Team settings 
					if (this.match.isDoubles){
						if ((this.match.server == 1) || (this.match.server==2)){
							this.match.team[1].serves = 1;
						}
						else {
							this.match.team[2].serves = 2;
						}

						this.match.team[1].name = this.match.players[1].name + " & " + this.match.players[2].name;
						this.match.team[2].name = this.match.players[3].name + " & " + this.match.players[4].name;
					} else {
						this.match.team[1].name = this.match.players[1].name;
						this.match.team[2].name = this.match.players[3].name;
					}

					this.match.team[1].timeouts = this.match.game.timeouts;
					this.match.team[1].appeals = this.match.game.appeals;
					this.match.team[2].timeouts = this.match.game.timeouts;
					this.match.team[2].appeals = this.match.game.appeals;

					this.match.timer.team[1].injury = this.match.game.injury_secs;
					this.match.timer.team[2].injury = this.match.game.injury_secs;

					
					for (var i = 1; i <= this.total_games-1; i++) {
						if (i == this.total_games-1) {
							this.match.timer.intermission[i] = this.match.game.intermission_tb;
						}
						else{
							this.match.timer.intermission[i] = this.match.game.intermission_norm;
						}
					};

					console.log('save Match:' + this.match.id);
				
					if (this.match.id == '0') {
						console.log('Add new Match');
						this.match.date = new Date();
						this.addMatchToDB();
					}else {
						this.updateMatchToDB();
					}
				
				},	
				dumpMatch: function(){
					console.log(JSON.stringify(this.match));
				},
				addMatchToDB: function(){

					var newMatch = matchesRef; //firebase.database().ref('matches');
  					var newMatchKey = firebase.database().ref().child('matches').push().key;
					this.match.id = newMatchKey;

					console.log('key:' + newMatchKey);
  					this.updateMatchToDB();

				},			
				createFacebookPost: function(){
					var that = this;
					this.match.post = this.match.title + "\n"
					                + this.match.team[1].name + ' vs ' + this.match.team[2].name; // + 
					              // + 'http://racquetballhub.com/scores/0/live';

					FB.api('/me/feed', 'post', {message: that.match.post, privacy:{value:'SELF'}},
					 function(response) {
					  if (!response || response.error) {
					    console.log('Error occured in createFacebookPost posting to FB ' + response.error);
					  } else {
					     console.log('New Post ID: ' + response.id);
					     that.match.fb_id = response.id;
					     console.log('New Match Post ID: ' + that.match.fb_id.toString()) ;
					  }
					});
				},
				updateFacebookPost: function(){
					console.log('updateFacebookPost post: ' + this.match.fb_id.toString());

					//Match Title
					this.match.post = this.match.title + '\n';

					//Team 1 scores
					this.match.post += this.match.team[1].name + '   ' ;
					for (var i = 1; i <= this.match.game_max + 1; i++) {
						this.match.post += this.match.team[1].games[i].score + '  ';
					};
					this.match.post += '\n';
					//Team 1 scores
					this.match.post += this.match.team[2].name + '   ' ;
					for (var i = 1 ; i <= this.match.game_max + 1; i++) {
						this.match.post += this.match.team[2].games[i].score  + '  ';
					};
					this.match.post += '\n';

					// Live Link
					this.match.post += '\n\nAll Live Scores @ racquetballhub.com/scores/0/live';

					var that = this;
					FB.api(that.match.fb_id.toString(), 'post', {message: that.match.post }, function(response) {
					  if (!response || response.error) {
					    console.log('Error occured updating Post ' + that.match.fb_id.toString());
					    console.log(response.error);
					  } else {
					     console.log('Current Post ID: ' + response.id);
					     console.log('Current Match Post ID: ' + that.match.fb_id.toString()) ;
					  }
					});

					this.addFaceBookComment();
				},	
				addFaceBookComment: function(){
					var that = this;
					var game_time = this.match.timer.game[this.match.game_num];

					if (game_time){
						game_time = game_time.toString();
						var date = new Date(null);
        				date.setSeconds(game_time); // specify value for SECONDS here
        				game_time= date.toISOString().substr(12, 7);
        			}


					var comment =  '[Gm ' + this.match.game_num + ' ' + game_time + '] ' + this.match.last_step;

					FB.api(that.match.fb_id.toString()+ '/comments/', 'post', {message: comment }, function(response) {
					  if (!response || response.error) {
					    console.log('Error occured adding comment to Post ' + that.match.fb_id.toString());
					    console.log(response.error);
					  } else {
					     console.log('Current Match Post ID: ' + that.match.fb_id.toString()) ;
					  }
					});
				},
				updateMatchToDB: function(){
					if (this.match.score_steps ) {
						this.match.last_step = this.match.score_steps.pop();
					}
					this.updateFacebookPost();
					//Fix me
					//this.saveToImage();

					try{
						
						//console.log('updateMatchToDB:' + this.match.id);
						//console.log(JSON.stringify(this.match));

						var updates = {};
						updates['matches/'+ this.match.id] = this.match;
						return firebase.database().ref().update(updates);
					}
					catch (e){ 
						console.log('Error updateMatchToDB:' + e.message)
					}
					
				},
				//Workin Progress
				saveToImage: function(){
				  	html2canvas(document.getElementById("divMatch"), {
			            onrendered: function(canvas) {
			                document.body.appendChild(canvas);
			            	},
			            	width: 300,
			            	height: 300
			        	}
			    	)
				},
				confirmDelete: function(match){
					this.delete_id = match.id,
					this.delete_title = match.title;
					$('#confirmDeleteModal').modal('show');
				},
				deleteMatch: function(key){
					console.log('delete: ' + key);

					var ref = firebase.database().ref('matches').orderByChild("id").equalTo(key);
					
					//back to setup
					this.resetMatch();

					//delete from database
					var updates = {};
					updates['matches/'+ key] = null;
					return firebase.database().ref().update(updates);
				},
				pauseMatch: function(match){
					console.log('pause: ' + match.title);

					match.isLive = false;

					var updates = {};
					updates['matches/'+ match.id] = match;
					return firebase.database().ref().update(updates);
				},
				goLiveFB: function(match){
					 FB.ui({
					    display: 'popup',
					    method: 'live_broadcast',
					    phase: 'create',
					}, function(response) {
					    if (!response.id) {
					       console.log('dialog canceled');
					      return;
					    }
					    console.log('stream url:' + response.secure_stream_url);
					    FB.ui({
					      display: 'popup',
					      method: 'live_broadcast',
					      phase: 'publish',
					      broadcast_data: response,
					    }, function(response) {
					     console.log("video status: \n" + response.status);
					    });
					  });
				},
				shareMatch: function(match){
					if (this.match.fb_id == 0 ) {
						console.log('Call createFacebookPost');
						this.createFacebookPost();
					}else {
						this.updateFacebookPost();
					}
				},
				playMatch: function(match){
					console.log('play: ' + match.title);

					match.isLive = true;

					var updates = {};
					updates['matches/'+ match.id] = match;
					return firebase.database().ref().update(updates);
				},
				editMatch: function(match){
					console.log('edit: ' + match.title);
					this.pauseMatch(match);
					
					match.showSetup = true;

					var updates = {};
					updates['matches/'+ match.id] = match;
					firebase.database().ref().update(updates);

				},
				confirmReset: function(){
					$('#confirmResetModal').modal('show');
				},			
				resetMatch: function(event){ 					
					this.endMatch();

					//General variables
				    this.match.showSetup = true;
					this.clearTimer('game');
					this.clearTimer('match');

					//this.match = {};

					//Match Defaults
					
					//this.match.tournament = {id:0, name:''};
					this.match.referee = {
									id: {{ $user->id}}, 
									name: '{{ $user->first_name}} {{ $user->last_name}}', 
								 };

					this.match.isStarted = false;
				
					this.match.players[1].name = '';
					this.match.players[2].name = '';
					this.match.players[3].name = '';
					this.match.players[4].name = '';		
		
					this.match.team[1].name ="Team 1";
					this.match.team[2].name ="Team 2";
					this.match.team[1].wins = 0;
					this.match.team[2].wins = 0;
					this.match.winner = '';
					this.match.isWinner = 0;
					this.match.game_num = 1;
					this.match.game = [];
					this.match.score_steps = [],
					this.match.title ='';
					this.match.service = '';
					this.match.server = 0;

					this.match.last_step = '';

					for (var i = 1; i <= 5; i++) {
						this.match.team[1].games[i].score = 0;
						this.match.team[2].games[i].score = 0;
					};					

				},	
				completeMatch: function(event){
					this.endMatch();

					this.match.isComplete = true;	
					this.match.isLive = false;
					this.match.completeDate = new Date();										
					
					this.updateMatchToDB();	
				},
				endMatch: function(event){
					this.match.isLive = false;
					this.match.score_steps.push('Matched Ended');

					this.stopTimer(gameTimer);
					this.stopTimer(matchTimer);

					this.updateMatchToDB();					
				},
				resumeMatch:function(event){
					this.starTimer(gameTimer);
					this.starTimer(matchTimer);
				},
				endGame: function(event){
					this.stopTimer(gameTimer);
					
					this.match.team[1].timeouts = this.match.game.timeouts;
					this.match.team[1].appeals = this.match.game.appeals;
					this.match.team[2].timeouts = this.match.game.timeouts;
					this.match.team[2].appeals = this.match.game.appeals;	
					this.updateMatchToDB();		
				},
				startTimer: function(name, teamNum){
					var that = this;			

					if (name == 'match') {
						matchTimer = setInterval(function(){
							that.match.timer.match +=1;
						}, 1000);
					}

					if (name == 'game') {
						gameTimer = setInterval(function(){
							//Todo: fix. why is this undefined
							that.match.timer.game[that.match.game_num ] +=1;
						}, 1000);	
					}	

					if (name == 'timeout') {
						//reset match.timer
						that.match.timer.team[teamNum].timeout = that.match.game.timeout_secs;
						timeoutTimer = setInterval(function(){
							if (that.match.timer.team[teamNum].timeout > 0) {
								that.match.timer.team[teamNum].timeout -=1;
							}
						}, 1000);	
					}	

					if (name == 'injury') {						
						injuryTimer = setInterval(function(){
							that.match.timer.injury -=1;
						}, 1000);	
					}	

					if (name == 'intermission') {						
						intermissionTimer = setInterval(function(){
							if (that.match.timer.intermission[that.match.game_num-1] > 0) {
								that.match.timer.intermission[that.match.game_num-1] -=1;
							}
						}, 1000);	
					}				
				},
				stopTimer: function(timer){
					var that = this;
					clearInterval(timer);				
				},
				clearTimer: function(name){
					var that = this;
					if (name == 'match') {
						that.match.timer = 0;
					}	
					if (name == 'game') {
						that.match.timer.game[that.match.game_num] = 0;
					}	
					if (name == 'timeout') {
						that.match.timer.timeout = 0;
					}	
					if (name == 'injury') {
						that.match.timer.injury = 0;
					}			
				},
				countDownTimer: function (duration, display) {
					var that = this;
				    var timer = duration, minutes, seconds;
				    setInterval(function () {
				        minutes = parseInt(timer / 60, 10);
				        seconds = parseInt(timer % 60, 10);

				        minutes = minutes < 10 ? "0" + minutes : minutes;
				        seconds = seconds < 10 ? "0" + seconds : seconds;

				        display.textContent = minutes + ":" + seconds;

				        if (--timer < 0) {
				            timer = duration;
				        }
				    }, 1000);
				},
				totalPoints: function(team) {
					var total = 0;
					for (var i = 1; i <= this.match.game_num ; i++) {
						console.log('total points:' + total)
						total += team.games[i].score;
					};
					console.log('total points:' + total)
					return total;

				},
				changeInitServer: function(options){
					this.match.initServer = options.pos;
				},			
				point: function (event){
					this.match.faults = 0;
					this.match.score_steps.push('point');
					
					//Add point to serving match.team
					if (this.match.server < 3) {
						this.match.team[1].games[this.match.game_num].score +=1;
					}
					else {
						this.match.team[2].games[this.match.game_num].score +=1;
					}					


					//Did Team 1 win the game?
					if ((this.match.team[1].games[this.match.game_num].score >= this.match.score_max) && 
						((this.match.team[1].games[this.match.game_num].score - this.match.team[2].games[this.match.game_num].score) >= this.match.win_by))
					{
						//Game is over
						console.log('Game over');
						this.endGame();
						this.match.team[1].wins +=1;

						if (this.isMatchOver()) {
							return true;
						}else {							
							this.intermission('start');
							$('#intermissionModal').modal('show');
							
							this.match.game_num+=1;
							//Change serving Team start of next game
							this.changeServingTeam();
						}
					}
					else {
						this.showScore();
					}

					//Did Team 2 win the game?
					if ((this.match.team[2].games[this.match.game_num].score >= this.match.score_max) && 
						((this.match.team[2].games[this.match.game_num].score - this.match.team[1].games[this.match.game_num].score) >= this.match.win_by))
					{
						//Game is over
						this.endGame();
						this.match.team[2].wins += 1;

						if (this.isMatchOver()) {
							return true;
						}else {							
							this.intermission('start');
							$('#intermissionModal').modal('show');

							this.match.game_num+=1;
							//Change serving Team start of next game
							this.changeServingTeam();
						}
					}
					else {					
						this.showScore();
					}

					this.updateMatchToDB();
					
				},
				isMatchOver:function (event){
					if (this.match.team[1].wins == this.match.game_max) {
						this.match.winner = 'The winner is ' + this.match.team[1].name;
						this.match.isWinner=1;
						$('#winnerModal').modal('show');
						this.completeMatch();
						return true;					
					}
					if (this.match.team[2].wins == this.match.game_max) {
						this.winner = 'The winner is ' + this.match.team[2].name;
						this.isWinner=2;
						$('#winnerModal').modal('show');
						this.completeMatch();
						return true;					
					}

					return false;
				},
				undoPoint: function (event){
					//restore any faults
                    this.restoreFault();

                    //check if start of new game, but not the first game
                    if ((this.match.game_num > 1) && (this.match.team[1].games[this.match.game_num].score + this.match.team[2].games[this.match.game_num].score == 0 )) {
                    	this.match.game_num -= 1;
                    	//decrement team_game
                    	//match.team[1].wins -=1;
                    	//match.team[2].wins -=2;
                    	this.undoServingTeam();
                    }

                    //remove point
                    if (this.match.server < 3) {
						this.match.team[1].games[this.match.game_num].score -= 1;
					}
					else {
						this.match.team[2].games[this.match.game_num].score = 1;
					}
					this.showScore();
					this.updateMatchToDB();		
				},
				fault: function (event){

					this.match.faults +=1;

					if (this.match.faults == 2 ) {
					    this.match.score_steps.push('doublefault');
						this.match.sideout(event);
					}else {
					    this.match.score_steps.push('fault');
					    $('#faultModal').modal('show');	
					};					
					this.updateMatchToDB();		
				},
				undoFault: function (event){
					this.match.faults = 0;
					this.updateMatchToDB();		
				},
				restoreFault: function(event){ 
					//restore any faults
                    this.match.last_step = this.match.score_steps.pop();
                    if (this.match.last_step == 'fault'){
                    	this.match.faults = 1;
                    	this.match.score_steps.push(last_step);
                    }
                    if (this.match.last_step == 'doublefault'){
                    	this.match.faults = 1;
                    }
                    //this.match.score_steps.push(last_step);
				},
				sideout: function (event){
					
					this.match.sideout_type = 'Sideout';
					if ((this.match.server == 1) || this.match.server == 2){
						this.match.team[1].serves -=1;
						if (this.match.team[1].serves > 0) {
							if (this.match.server == 1) {
								this.match.server = 2;
								this.match.sideout_type = 'Handout';
							}
							else{
								this.match.server = 1;
							}
						}else { //Serve goes to Team 2
							if (this.match.isDoubles){
								this.match.team[1].serves = 2;
							}
							else {
								this.match.team[1].serves = 1;
							}
							this.match.server = 3;
						}
					}else{
						this.match.team[2].serves -=1;
						if (this.match.team[2].serves > 0) {
							if (this.match.server == 3) {
								this.match.server = 4;
								this.match.sideout_type = 'Handout';
							}
							else{
								this.match.server = 3;
							}
						}else { //Serve goes to Team 1
							if (this.match.isDoubles){
								this.match.team[2].serves = 2;
							}
							else {
								this.match.team[2].serves = 1;
							}
							this.match.server = 1;
						}
					}

					this.match.score_steps.push(this.match.sideout_type);
					this.match.faults = 0;
					$('#sideoutModal').modal('show');	
					this.showScore();
					this.updateMatchToDB();		
				},
				undoSideout: function (event){				
					this.restoreFault();

                    if (this.match.isDoubles) {
						if (this.match.server == 1 ) {
							this.match.server = 4;
						}
						else {
							this.match.server -= 1;
						}
					}
					else {
						if (this.match.server == 1) {
							this.match.server = 3;
						}
						else {
							this.match.server = 1;
						}
					};
					this.updateMatchToDB();		
				},
				timeout: function(teamNum) {

					if (timeoutTimer) {
						this.stopTimer(timeoutTimer);
						timeoutTimer = undefined;
					} else {
						if (this.match.team[teamNum].timeouts > 0 ){
							this.match.team[teamNum].timeouts-=1;
							this.startTimer('timeout', teamNum);
						}
						else {
							console.log('No more timeouts');
						}
					}	
					this.updateMatchToDB();		
				},
				intermission: function(action) {

					if (action =='stop') {
						this.stopTimer(intermissionTimer);
						intermissionTimer = undefined;
						this.startTimer('game');	
					} else {
						this.startTimer('intermission');						
					}	
					this.updateMatchToDB();		
				},
				undoTimeout: function(event){

				},
				appeal: function(teamNum) {
					this.match.team[teamNum].appeals-=1;					
				},
				undoAppeal: function(event){

				},
				changeServingTeam: function(event){
					//Change server start of next game					
					if (this.isTiebreaker) {
						//Team with most points previous game serves. and gets one service	
						if (this.totalPoints(this.match.team[1]) > this.totalPoints(this.match.team[2])) {
							console.log('match.team 1 serves tiebreaker');
							this.match.server  = 1;
							this.match.initServer = 1;
						}
						else{
							console.log('match.team 2 serves tiebreaker');
							this.match.server  = 3;
							this.match.initServer = 3;
						}											
					}
					else {
						//Alternate serving match.team
						if (this.match.initServer == 1) {
							this.match.server  = 3;
							this.match.initServer = 3;
						}
						else{
							this.match.server  = 1;
							this.match.initServer = 1;
						}
					}
					this.match.score_steps.push('changeServingTeam');
					this.updateMatchToDB();		
				},
				undoServingTeam: function(event){
					//Change server start of next game
					//tiebreaker
					//???				
					
					//Alternate serving match.team
					if (this.match.initServer == 1) {
						this.match.server  = 3;
						this.match.initServer = 3;
					}
					else{
						this.match.server  = 1;
						this.match.initServer = 1;
					}
					this.updateMatchToDB();		
				},				
				undo: function(){

					this.match.last_step = this.match.score_steps.pop();
					switch (this.match.last_step) {
						case "point":
							this.undoPoint();                            
							break;
						case "fault":
							this.undoFault();					
							break;
						case "doublefault":
							this.match.faults = 1;
							this.match.last_step = this.match.score_steps.pop();
                            if (this.match.last_step == 'changeServingTeam'){
                            	this.undoServingTeam();
                            }else if(this.match.last_step == 'sideout' || this.match.last_step == 'handout') {
                            	this.undoSideout();
                            }	
							break;
						case "sideout":
							this.undoSideout();
							break;
						case "undo":

							break;						
					}
					$('#undoModal').modal('show');	
					this.updateMatchToDB();		
				},
				showScore: function(event){
					if (this.match.server < 3) {
						this.match.service = this.match.team[1].games[this.match.game_num].score + " - " + this.match.team[2].games[this.match.game_num].score;
					}
					else{
						this.match.service = this.match.team[2].games[this.match.game_num].score + " - " + this.match.team[1].games[this.match.game_num].score;
					}
					$('#scoreModal').modal('show');	
				},
			}
		});	
		window.vue = vm;
	</script>

	<script type="text/javascript">         //<![CDATA[
     window.addEventListener('load', function() {
          var maybePreventPullToRefresh = false;
          var lastTouchY = 0;
          var touchstartHandler = function(e) {
            if (e.touches.length != 1) return;
            lastTouchY = e.touches[0].clientY;
            // Pull-to-refresh will only trigger if the scroll begins when the
            // document's Y offset is zero.
            maybePreventPullToRefresh =
                window.pageYOffset == 0;
          }

          var touchmoveHandler = function(e) {
            var touchY = e.touches[0].clientY;
            var touchYDelta = touchY - lastTouchY;
            lastTouchY = touchY;

            if (maybePreventPullToRefresh) {
              // To suppress pull-to-refresh it is sufficient to preventDefault the
              // first overscrolling touchmove.
              maybePreventPullToRefresh = false;
              if (touchYDelta > 0) {
                e.preventDefault();
                return;
              }
            }
          }

          document.addEventListener('touchstart', touchstartHandler, false);
          document.addEventListener('touchmove', touchmoveHandler, false);      });
            //]]>    
    </script>

@stop