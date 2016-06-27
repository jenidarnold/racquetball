@extends('pages.tools.layouts.league')

	<style>
	.week_num {
		text-align:center;
	}
	</style>

@section('league_menu')
	<!-- Main Menu -->	
@stop

@section('league_content')
	<!-- Display League Standings -->	
	@include('pages.tools.includes.league_header')
	<!-- Menu -->
	<nav class="navbar navbar-primary navbar-inverse col-xs-12">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      	<li><a href="/tools/league/">Leagues</a></li>
      	  	<!--@ if($league->permission($user->id) -->
	      	<li><a href="/tools/league/{{$league->league_id}}/edit">Edit</a></li>
	      	<!--@ endif -->
	    	<li><a href="/tools/league/{{$league->league_id}}/join">Join</a></li>
	      	<li class="active"><a href="#" active>Standings</a></li>
	      	<li><a href="/tools/league/{{$league->league_id}}/">Matches</a></li>	    
	  </div>
	</nav>
		<!-- Display Match Results  -->
		<div class="panel panel-primary" v-if="showResults">
		<div class="panel-heading">	
			<h4>Match Results for {{$player->first_name}} {{$player->last_name}}</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					{!! HTML::linkRoute('tools.league.match.create', 'Add Match', array($league->league_id), array('class' => 'btn btn-success btn-sm')) !!} 
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<table class="table">
						<th class="col-xs-1">Week #</th>
						<th class="col-xs-2">Date</th>
						<th class="col-xs-6">Result</th>
						<th class="col-xs-2" colspan="2">Actions</th>
						@foreach ($matches as $m)
							<tr>
								<td class='text-center'>{{ ceil(date_diff(new DateTime($m->match_date), new DateTime($league->start_date))->days /7)}} </td>
								<td class='text-center'>{{date('m-d-y', strtotime($m->match_date))}}</td>
								<td>
									<table class="match">
										@if($m->winner_id == $m->player1_id)
										<tr class="winner">
										@else
										<tr>
										@endif
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p1_first_name }} {{ $m->p1_last_name }} </td>			
											@foreach ($match_game->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score1 }}</td>
											@endforeach	
										</tr>
										@if($m->winner_id == $m->player2_id)
										<tr class="winner">
										@else
										<tr>
										@endif
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p2_first_name }} {{ $m->p2_last_name }} </td>			
											@foreach ($match_game->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score2 }}</td>
											@endforeach		
										</tr>										
									</table>
								</td>
								<td class='text-center'>
					               {!! Form::open(array('route' => array('tools.league.match.edit',  $league->league_id, $m->match_id), 'class' => '')) !!}
					                    {!! Form::hidden('_method', 'GET') !!}
					                    {!! Form::submit('Edit', array('class' => 'btn btn-warning btn-xs')) !!}
					                {!! Form::close() !!}
					            </td>
					            <td>
									{!! Form::open(array('route' => array('tools.league.match.delete', $league->league_id, $m->match_id), 'class' => '')) !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::hidden ('league_id', $league->league_id) !!}	
										{!! Form::hidden ('match_id', $m->match_id) !!}	
					                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
					                {!! Form::close() !!}
								</td>
							</tr>
						@endforeach
						@if (count($matches) == 0)
							<tr><td colspan="3" class ="score"><h4>No Matches</h4></td></tr>
						@endif
						</table>					
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
			}
		});	
	</script>
@stop

