@extends('pages.tools.layouts.league')

@section('style')
	@yield('style')
	<style>
		.l-card {
			box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important;
			margin: 0px 0px 10px 30px;		
			padding-bottom: 15px;	
		}
		.popover{
		    width:200px;  
		}
		.panel-heading  {
		  border-radius: 0 !important;
		}
	 	.navbar  {
		 	border-radius: 0 !important;
		}
		.league-title {
			border-radius: 0 !important;
		}
	</style>
@stop

@section('league_menu')
	<!-- Menu -->
@stop

@section('league_content')
<!-- League Home Intro -->
	<div class="row">
		<div class="col-xs-11 col-xs-offset-1 col-sm-12 col-md-offset-0 ">			
			<h3>Racquetball Leagues </h3>
			<h4>Find your level of play, enjoy a fun, fast-action game.</h4>
		</div>
	</div>
	<div class="row">
	<nav class="navbar navbar-primary navbar-inverse col-xs-12">
		  <div class="container-fluid">
		    <ul class="nav navbar-nav">
		      	<li class="active"><a href="#">Leagues</a></li>
				<li><a id="lnkLeagueAdd" href="{{ route('tools.league.create') }}"></i>Create</a></li>li
		    </ul>
		  </div>
		</nav>
	</div>
	<div class="row">
		<div class="panel-body">
			<div>
				<form class="form-horizontal" role="form">
				@foreach ($leagues->chunk(2) as $chunk_leagues)	
					<div class="row">	
						@foreach($chunk_leagues as $l)				
						<div class="col-xs-12 col-sm-5 l-card">
							<h4><a id={{"lnkLeague-$l->league_id"}} class="league-title btn btn-primary btn-lg col-xs-12 col-sm-12" href="{{ route('tools.league.show', [$l->league_id]) }}">{{$l->name}}</a>

							</h4>
							<div class="form-group">		
								<label class="control-label col-xs-3 col-sm-3" for="location">Location:</label>
								<div class="col-xs-7 col-sm-9">									
									@foreach ($gym->whereId($l->location_id)->get() as $g)
										<address class=" text text-primary" >
											{{$g->name}}<br/>
											{{$g->address1}}<br/>
										</address>
									@endforeach
									<span class="control-label text text-primary" id="location">
									</span>
								</div>
							</div>				
							<div class="form-group">
								<label class="control-label col-xs-3 col-sm-3" for="dates">Starts:</label>
								<div class="col-xs-7 col-sm-9">
									<label class="control-label text text-primary" id="start">{{date('m-d-y', strtotime($l->start_date))}}</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-3 col-sm-3" for="dates">Ends:</label>
								<div class="col-xs-7 col-sm-9">
									<label class="control-label text text-primary" id="end">{{date('m-d-y', strtotime($l->end_date))}}</label>
								</div>
							</div>						
							<div class="form-group">						
								<label class="control-label col-xs-3 col-sm-3" for="schedule">Schedule:</label>
								<div class="col-xs-7 col-sm-9">
									<label class="control-label text text-primary" id="schedule">{{date('l', strtotime($l->start_date))}} , {{date('g:i A', strtotime($l->start_date))}} to {{date('g:i A', strtotime($l->end_date))}}</label>
								</div>
							</div>
							<div class="form-group">						
								<label class="control-label col-xs-3 col-sm-3" for="format">Format:</label>
								<div class="col-xs-7 col-sm-9">
									<label class="control-label text text-primary" id="format">
										@foreach($format->whereFormatId($l->format_id)->get() as $f)
											{{$f->format}}
										@endforeach
									</label>
								</div>
							</div>
							<div class="form-group">						
								<label class="control-label col-xs-3 col-sm-3" for="fees">Fees:</label>
								<div class="col-xs-7 col-sm-9">
									<label class="control-label text text-primary" id="fees">{{$l->fee}}</label>
								</div>
							</div>
							<div class="form-group">						
								<label class="control-label col-xs-3 col-sm-3" for="details">Details:</label>
								<div class="col-xs-7 col-sm-9">
									<span class="control-label text text-primary" id="details">{{$l->detail}}</span>
								</div>
							</div>
							{{-- League Actions --}}
							<div class="row">
								<div class="col-xs-2">
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-success btn-sm" href="{{ route('tools.league.show', [$l->league_id]) }}">View</a>
								</div>
								<div class="col-xs-2">
									<a id={{"lnkLeague-$l->league_id"}} class="btn btn-info btn-sm" href="{{ route('tools.league.edit', [$l->league_id]) }}">Edit</a>
								</div>
								<div class="col-xs-3 col-sm-3">							    
									<button type="button" class="btn btn-primary btn-sm"  data-toggle="popover" title="Players ({{count($league_player->whereLeagueId($l->league_id)->get())}})" 
									data-html="true" data-content="
									@foreach ($league_player->whereLeagueId($l->league_id)->get() as $p)
	                                    	<li>{{ $player->wherePlayerId($p->player_id)->first()->last_name }}, {{ $player->wherePlayerId($p->player_id)->first()->first_name }}</li>
									@endforeach
										">Players <span class="badge">{{count($league_player->whereLeagueId($l->league_id)->get())}}</span></button>
								</div>
								{{-- initialize isOpen league --}}
								@if($isOpen = 1) 
								@endif
								{{-- check if league has ended --}}
								@if( date_diff(new Datetime($l->end_date), new Datetime(), false)->format("%r%a") > 0)
									{{-- set isOpen to false--}}
									@if($isOpen = 0) 									
									@endif	
									<div class="clearfix visible-xs"></div>	
									<div class="col-xs-12 col-sm-12">
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