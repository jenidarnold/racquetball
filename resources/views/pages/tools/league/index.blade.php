@extends('pages.tools.layouts.league')


@section('style')
	@yield('style')
	<style>
		.l-card {
			box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
			margin: 5px 0px 10px 30px;		
			padding-bottom: 15px;	
		}
	</style>
@stop

@section('league_content')
<!-- Setup League  -->
<div class="panel panel-primary">			
	<div class="panel-heading"><h3>Racquetball Leagues</h3></div>
	<div class="panel-body">
		<div>
			<form class="form-horizontal" role="form">
			@foreach ($leagues->chunk(2) as $chunk_leagues)	
				<div class="row">	
					@foreach($chunk_leagues as $l)				
					<div class="col-xs-12 col-sm-5 l-card">
						<h3><a id={{"lnkLeague-$l->league_id"}} class="btn btn-warning btn-lg col-xs-12 col-sm-12" href="{{ route('tools.league.show', [$l->league_id]) }}">{{$l->name}}</a></h3>					
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="dates">Dates:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="dates">{{date('m-d-y', strtotime($l->start_date))}} to {{date('m-d-y', strtotime($l->end_date))}}</label>
							</div>
						</div>
						<div class="form-group">		
							<label class="control-label col-xs-3 col-sm-2" for="location">Location:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="location">LA Fitness @ Midway</label>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="schedule">Schedule:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="schedule">Monday 6-8 pm</label>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="format">Format:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="format">Singles, Round Robin</label>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="fees">Fees:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="fees">$20</label>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="details">Details:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="details">Play one game to 11. Rankings by Average Points</label>
							</div>
						</div>
						{{-- League Actions --}}
						<div class="row">
							{{-- initialize isOpen league --}}
							@if($isOpen = 1) 
							@endif
							{{-- check if league has ended --}}
							@if( date_diff(new Datetime($l->end_date), new Datetime(), false)->format("%r%a") > 0)
								{{-- set isOpen to false--}}
								@if($isOpen = 0) 									
								@endif			
								<div class="col-xs-12">
									<p class="text-danger">This league is closed.</p>
								</div>					
							@endif	
							@if($isOpen == 1)
								<div class="col-xs-1">
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-success btn-sm" href="{{ route('tools.league.join', [$l->league_id]) }}">Join</i></a>
								</div>
							@endif
						</div>						
					</div>
					<div class="col-sm-1">&nbsp;</div>
					@endforeach
				</div>			
			@endforeach
			</form>
		 {{-- Table Layout--}}
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
		<a id="lnkLeagueAdd" class="btn btn-success btn-sm" href="{{ route('tools.league.create') }}"></i>Create League</a>
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
		});	
	</script>
	

@stop