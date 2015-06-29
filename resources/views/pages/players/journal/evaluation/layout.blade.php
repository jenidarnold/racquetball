@extends('pages.players.layout')

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

@section('menu')
	<div class="col-md-12">			
   		<ul class="nav nav-pills">				
			<li id="li-List"><a href="/players/{{ $player->player_id}}/journal/1/evaluation">Home</a></li>
			<li id="li-New"><a href="/players/{{ $player->player_id}}/journal/{{$entry}}/evaluation/create">New</a></li>
		</ul>
	</div>	
@stop

@section('player-content')
<div class="container">
	<div class="row">
				
		<div class="col-md-10">
			@yield('evaluation-content')
		</div>
		</div>		
	</div>	
</div>
<div class="row">
	@yield('player-footer')
</div>
@stop
