@extends('pages.players.journal.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">My Journal</label>
	<label class="entry-date" style="float:right">Last Entry: 6/1/15</label>		
@stop
@section('journal-content')
	<div class="jumbtron">
		<div class="container">
		<p>
		"Your journal is to keep track of your progress, skills, and add notes.
		Set goals. Be Active."
		</p>
		</div>
	</div>
@stop