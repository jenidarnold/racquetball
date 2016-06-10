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

@section('league_menu')
	<!-- Menu -->

@stop

@section('league_content')

<!-- Leaue Home Intro -->
	<div class="row">
		<div clas="col-xs-12">
			
			<h3>Competitive Racquetball Leagues </h3>
			<h4>
			<p>
			Find your level of play, enjoy a fun, fast-action game. 
			</p>
			</h4>
		</div>
	</div>
	<nav class="navbar navbar-primary navbar-inverse col-xs-12">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      	<li class="active"><a href="#">Leagues</a></li>
			<li><a id="lnkLeagueAdd" href="{{ route('tools.league.create') }}"></i>Create</a></li>li
	    </ul>
	  </div>
	</nav>
	<div class="panel-body">
		<div>
			<form class="form-horizontal" role="form">
			@foreach ($leagues->chunk(2) as $chunk_leagues)	
				<div class="row">	
					@foreach($chunk_leagues as $l)				
					<div class="col-xs-12 col-sm-5 l-card">
						<h3><a id={{"lnkLeague-$l->league_id"}} class="btn btn-primary btn-lg col-xs-12 col-sm-12" href="{{ route('tools.league.show', [$l->league_id]) }}">{{$l->name}}</a>

						</h3>					
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
							<div class="col-xs-2">
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-info btn-sm" href="{{ route('tools.league.show', [$l->league_id]) }}">View</i></a>
							</div>
							<div class="col-xs-3">
								<button type="button" class="btn btn-primary btn-sm">Players <span class="badge">{{count($league_player->whereLeagueId($l->league_id))}}</span></button>
							</div>
							{{-- initialize isOpen league --}}
							@if($isOpen = 1) 
							@endif
							{{-- check if league has ended --}}
							@if( date_diff(new Datetime($l->end_date), new Datetime(), false)->format("%r%a") > 0)
								{{-- set isOpen to false--}}
								@if($isOpen = 0) 									
								@endif			
								<div class="col-xs-6">
									<p class="text-danger">This league is closed.</p>
								</div>					
							@endif	
							@if($isOpen == 1)
								<div class="col-xs-2">
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
			<div>
				{!! $leagues->render() !!}
			</div>
		</div>
	</div>
	<div class="panel-footer">
	
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