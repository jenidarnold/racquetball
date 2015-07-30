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
	<div class="row">
		<div class="col-md-12">			
	   		<ul class="nav nav-pills">	
	   			<li id="li-home"><a href="/players/{{ $player->player_id}}/journal">Home</a></li>
				<li id="li-profile"><a href="/players/{{ $player->player_id}}/journal/{{ $entry }}/evaluation/{{ $player->player_id}}">Self Evaluation</a></li>
				<li id="li-journal"><a href="/players/{{ $player->player_id}}/journal/{{ $entry }}/opponent/">Opponents Log</a></li>
				<li id="li-tourney"><a href="/players/{{ $player->player_id}}/journal/{{ $entry }}/gameplans/">Game Plans</a></li>				
				<li id="li-gallery"><a href="/players/{{ $player->player_id}}/journal/{{ $entry }}/training/">Training Logs</a></li>
			</ul>
		</div>
	</div>
@stop
@section('player-content')
	<div class="row">	
		<div class="col-md-10">
			@yield('journal-content')
		</div>		
	</div>	
<div class="row">
	@yield('player-footer')
</div>
@stop
