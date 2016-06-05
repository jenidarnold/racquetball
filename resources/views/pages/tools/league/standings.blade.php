@extends('pages.tools.layouts.league')

@section('league_content')
		<!-- Display League Standings -->	
		<div class="panel panel-primary" v-if="showStandings">
			<div class="panel-heading">	
				<div class="row">
					<div class="col-xs-12 col-md-62">
						<h4>{{$league->name}} Standings as of {{date('M d, y')}} </h4>
						<h6>League runs {{date('M d, y', strtotime($league->start_date))}} to {{date('M d, y', strtotime($league->end_date))}}</h6>						
					</div>										
				</div>				
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12">
						<table class="table">
							<th class="col-xs-1">Rank</th>
							<th class="col-xs-2">Name</th>
							<th class="col-xs-1" title="Total games won">W</th>
							<th class="col-xs-1" title="Total games lost">L</th>
							<th class="col-xs-1" title="Total number of games played"># Gms</th>
							<th class="col-xs-1" title="Percent Won">PCT</th>
							<th class="col-xs-1" title="Win or Loss Streak">Strk</th>
							<th class="col-xs-1">Total Pts</th>
							<th class="col-xs-1">Avg Pts</th>
							@if($i=1)@endif
							@foreach ($standings as $s)
								<tr>									
									<td class='rank'>{{ $i++}} </td>
									<td class="player_name">{{ $s->first_name}}  {{$s->last_name }} </td>								
									<td class="score">{{ $s->wins }}</td>
									<td class="score">{{ $s->losses }}</td>
									<td class="score">{{ $s->games }} </td>
									<td class="score">{{ number_format(($s->wins/$s->games)*100,1) }}%</td>
									<td class="score"><div class="player_streak" pid="{{$s->player_id}}" lid="{{$league->league_id}}"></div></td>
									<td class="score">{{ $s->points }} </td>
									<td class="score">{{ $s->avg }} </td>
								</tr>
							@endforeach
							@if (count($matches) == 0)
								<tr><td colspan="5" class ="score"><h4>No Matches</h4></td></tr>
							@endif
						</table>
						<div>
						{!! $standings->render() !!}
					</div>
					</div>
				</div>
			</div>			
		</div>		
	</div>
</div>

@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){           
	        $(".player").select2({
	        	placeholder: "Select a Player",
	        	allowClear: true,    	 	
	        });	
	        
	       function getStreak(league_id, player_id){
				$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
			        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
			        if (token) {
			            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
			        }
			    });
                $.ajax({
                    context: this,
                    type: "GET",
                    data: {
                    	league_id: league_id,
                    	player_id: player_id
                    },
                    url: "/tools/league/api/players/streak",
                    success: function (result) {

                        console.log( result);

                        return result;
                    },
					error:function(x,e) {
						console.log("error getttng streak: " + e.message);
					}
                });
            }

            $(".player_streak").each(function(){

            	var league_id =$(this).attr("lid");
            	var player_id =$(this).attr("pid");
            	
            	$.ajax({
                    context: this,
                    type: "GET",
                    data: {
                    	league_id: league_id,
                    	player_id: player_id
                    },
                    url: "/tools/league/api/players/streak",
                    success: function (result) {
                        $(this).html(result);
                        if (/W/i.test(result)){
                        	$(this).addClass("win-streak");
                        }else{                        	
                        	$(this).addClass("loss-streak");
                        }
                    },
					error:function(x,e) {
						console.log("error getttng streak: " + e.message);
					}
                });
            })
	    });

	    
	</script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,
				preview: false,
				showStandings: true,
				showResults: true,
				showAddMatch: false,
				league_id: 1,
				league_title: '',
				isStarted: false,
				score_max: 11,		
			},		
			ready: function() {
				//ajax functions
				//this.getLeagues();
            },								
			computed: {									
			},
			filters: {				
			},				
			methods: {				
				getStreak: function(league_id, player_id){

					$.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
				        var token = $('input[name="_token"]').attr("value"); // or _token, whichever you are using
				        if (token) {
				            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
				        }
				    });
                    $.ajax({
                        context: this,
                        type: "GET",
                        data: {
                        	league_id: league_id,
                        	player_id: player_id
                        },
                        url: "/tools/league/api/players/streak",
                        success: function (result) {

                            this.$set("pid_"+ player_id + "_streak", result);

                            return result;
                        },
						error:function(x,e) {
							console.log("error getttng streak: " + e.message);
						}
                    });
				},		               
			}
		});	
	</script>
@stop