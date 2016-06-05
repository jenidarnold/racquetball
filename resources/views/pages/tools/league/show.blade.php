@extends('pages.tools.layouts.league')

@section('league_content')
		<!-- Display Match Results  -->
		<div class="panel panel-primary" v-if="showResults">
		<div class="panel-heading">	
			<h4>Week by Week Match Results</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
					{!! HTML::linkRoute('tools.league.match.create', 'Add', array($league->league_id), array('class' => 'btn btn-success btn-sm')) !!} 
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<table class="table">
						<th>Week #</th>
						<th>Result</th>
						<th>Actions</th>
						@foreach ($matches as $m)
							<tr>
								<td class='week_num'>{{ $m->match_date }} </td>
								<td>
									<table class="match">
										<tr>
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p1_first_name }} {{ $m->p1_last_name }} </td>			
											@foreach ($match_game->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score1 }}</td>
											@endforeach	
										</tr>
										<tr>
											<!--td class='rank'><sup></sup></td-->
											<td class="player_name">{{ $m->p2_first_name }} {{ $m->p2_last_name }} </td>			
											@foreach ($match_game->whereMatchId($m->match_id)->with('games')->get() as $g)
											<td class="score">{{$g["games"]->first()->score2 }}</td>
											@endforeach		
										</tr>										
									</table>
								</td>
								<td>
					                {!! Form::close() !!}
									{!! Form::open(array('route' => array('tools.league.match.edit',  $league->league_id, $m->match_id), 'class' => 'pull-left')) !!}
					                    {!! Form::hidden('_method', 'GET') !!}
					                    {!! Form::submit('Edit', array('class' => 'btn btn-warning btn-sm')) !!}
					                {!! Form::close() !!}
									{!! Form::open(array('route' => array('tools.league.match.delete', $league->league_id, $m->match_id), 'class' => 'pull-left')) !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::hidden ('league_id', $league->league_id) !!}	
										{!! Form::hidden ('match_id', $m->match_id) !!}	
					                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) !!}
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
