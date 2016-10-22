@extends('layouts.app')

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

@section('content')

<div class="col-xs-12">
	<div id="myvue" class="col-xs-12 col-sm-7 col-md-6 col-lg-6">
		<h3>Live Matches</h3>
		<table class="table">
		  <tr v-for="m in matches">
		    <td>		    	
		    	<div class="">	
		    	<h4 class="text-primary">@{{ m.date }} @{{ m.title}} </h4>		
				<table class="table col-xs-12">					
					<tr class="tr-games label-primary ">
						<th class="col-xs-9 th-games"></th>
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
								<i v-show="m.isWinner[1]" class="fa fa-trophy text-warning"></i>
							</div>				
							<div class="" >								
								  <span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ m.team[1].timeouts }}</span>
								<span class="" >
									<span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ m.team[1].appeals  }}</span>
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
								<i v-show="m.isWinner[2]" class="fa fa-trophy text-warning"></i>
							</div>
							<div class="">								
								<span class="badge"><i class="fa fa-clock-o fa-xs"></i> @{{ m.team[2].timeouts }}</span>							
								<span class="col-xs" >
									<span class="badge"><i class="fa fa-thumbs-down fa-xs"></i> @{{ m.team[2].appeals  }}</span>
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
					<!--<tr class="tr-games label-primary ">
						<td></td>
						<td class="th-games">&nbsp;</td>
						<!--td class="th-games game-time"><span class="" v-if="m.game_num >= 1" >@{{ m.timer.game[1] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="m.game_num >= 2" >@{{ m.timer.game[2] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="m.game_num >= 3" >@{{ m.timer.game[3] | secondsToTime }}</span></td>
						<td class="th-games game-time"><span class="" v-if="m.game_num >= 4" >@{{ m.timer.game[4] | secondsToTime }}</span></td>
						<td class=" th-games game-time"><span class="" v-if="m.game_num >= 5" >@{{ m.timer.game[5] | secondsToTime }}</span></td>	
					</tr>
					<tr class="tr-games label-info">
						<td colspan="5">&nbsp;</td>
						<td colspan="2" class=" th-games game-time"><span class="">@{{ m.timer.match | secondsToTime }}</span></td>
					</tr>
					-->
				</table>
		  </tr>
		</table>
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

		var matchesRef = firebase.database().ref('matches');

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
				matches: []
			},
			firebase: {
				matches_fb: matchesRef.limitToLast(25)
			},	
			mounted: function(){
				console.log('mounted');

				// Retrieve new posts as they are added to our database
				matchesRef.on("child_added", function(snapshot, prevChildKey) {
				  var match = snapshot.val();
				  vm.matches.push(match);
				  console.log(match);
				});

				//this.matches = matchesRef;
			},				
		});	
	</script>
@stop