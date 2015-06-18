@extends('pages.players.journal.evaluation.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">My Evaluations</label>
	<label class="entry-date" style="float:right">Last Entry: 6/1/15</label>		
@stop
@section('evaluation-content')
	<div class="well">
		evaluation form 
		index list by date. 
		click to show - need to view, add, edit, update.
	</div>
@stop