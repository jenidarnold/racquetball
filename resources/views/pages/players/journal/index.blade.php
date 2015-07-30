@extends('pages.players.journal.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop
@section('title')
	My Journal
@stop

@section('journal-content')
	<div class="well">
		<h2>Your journal is to keep track of anything!</h2>
		<h3>Track your Progress</h3>
		<h3>Evaluate your Skills</h3>
		<h3>Make Notes on Opponents</h3>
		<h3>Set Goals</h3>
		<h3>Be Active</h3>
		<h3>Post</h3>
		<center>
			<button class="btn btn-success">Get Started</button>
		</center>
	</div>
@stop