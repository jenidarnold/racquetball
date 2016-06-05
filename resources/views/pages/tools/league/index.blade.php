@extends('pages.tools.layouts.league')


@section('style')
	@yield('style')
@stop

@section('league_content')
<!-- Setup League  -->
<div class="panel panel-primary">			
	<div class="panel-heading"><h3>Racquetball Leagues</h3></div>
	<div class="panel-body">
		<div>
			<table class="table table-hover">
				<thead>
					<th></th>
					<th></th>
					<th>League Name</th>
					<th>Starts</th>
					<th>Ends</th>
					<th>Skill Level</th>							
					<th>Format</th>
					<th>Fee</th>
					<th>Location</th>
					<th>Director</th>
					<th> # Players</th>
					<th>Description</th>
				</thead>
				@foreach ($leagues as $l)		
					{{-- set isOpen --}}			
					@if($isOpen = 1) 
					@endif
					{{-- check if league has ended --}}
					@if( date_diff(new Datetime($l->end_date), new Datetime(), false)->format("%r%a") > 0)
						{{-- set isOpen --}}
						@if($isOpen = 0) 
						@endif
						<tr class="closed" title="This league has ended">
					@else
						<tr class="open" title="This league is open">
					@endif
							<td>
								<a id={{"lnkLeague-$l->league_id"}} class="btn btn-warning btn-sm" href="{{ route('tools.league.show', [$l->league_id]) }}"><i class="fa fa-search"></i></a>
							</td>
							<td>
								@if($isOpen == 1)
								<a id={{"lnkLeague-$l->league_id"}} class="btn btn-success btn-sm" href="{{ route('tools.league.join', [$l->league_id]) }}">Join</i></a>
								@endif
							</td>					
							<td>{{$l->name}}</td>
							<td>{{date('m-d-y', strtotime($l->start_date))}}</td>
							<td>{{date('m-d-y', strtotime($l->end_date))}}</td>
							<td>A/B</td>
							<td>Singles</td>
							<td>$40</td>
							<td>L.A.F. Midway</td>
							<td><a href="">B. Zimmerman</a></td>
							<td>{{ $league_player->whereLeagueId($l->league_id)->count() }}</td>
							<td>Singles Round Robin: 1 game to 11</td>
							<td></td>
						</tr>
				@endforeach
			</table>
			<div>
				{!! $leagues->render() !!}
			</div>
		</div>
	</div>
	<div class="panel-footer">
		<a id="lnkLeagueAdd" class="btn btn-success btn-sm" href="{{ route('tools.league.create') }}"><i class="fa fa-plus"></i>Create</a>
	</div>
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>	
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,				
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
				
				},		
			}
		});	
	</script>
	

@stop