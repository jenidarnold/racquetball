@extends('pages.players.journal.layout')

@section('style')
	@parent	
	<style type="text/css">
		.entry-date{
			color: #ff4422;
			font-size: 10pt;
			font-style: italic;
		}
	</style>
@stop
@section('player-content')
	<div class="row">			
		<div class="col-md-10">
			@yield('evaluation-content')
		</div>		
	</div>	
<div class="row">
	@yield('player-footer')
</div>
@stop
