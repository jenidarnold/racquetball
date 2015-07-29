@extends('pages.players.journal.evaluation.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop

@section('title')
	<!-- label class="player-sub-title">Evaluations</label>
	<label class="entry-date" style="float:right">Last Entry: 6/1/15</label -->		
@stop
@section('evaluation-content')
	<div class="row" style="padding-top:10px">
		<h3>Self Evaluations</h3>
		<h4>These are evalutions completed by myself to assess my skills in my opinion.</h4>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-8">
			<form class="navbar-form" role="search">
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
	        </form>
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-success">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($evaluations as $e)
			<tr>
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				{{-- <td class="eval" >{{ $e->title }}</td> --}}
				<td class="eval" >{!! HTML::linkRoute('evaluation.show', $e->title, [$player->player_id, $entry, $e->evaluation_id]) !!}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $evaluations->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Fellow Evaluations</h3>
		<h4>These are evalutions completed by those whom I've sent an evaluation invitation to assess my skills in their opinion</h4>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-8">
			<form class="navbar-form" role="search">
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
	        </form>
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-warning">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($evaluations as $e)
			<tr>
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				{{-- <td class="eval" >{{ $e->title }}</td> --}}
				<td class="eval" >{!! HTML::linkRoute('evaluation.show', $e->title, [$player->player_id, $entry, $e->evaluation_id]) !!}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $evaluations->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Opponent Evaluations</h3>
		<h4>These are evalutions completed by me on opponents to assess their skills in my opinion</h4>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-8">
			<form class="navbar-form" role="search">
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
	        </form>
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-danger">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($evaluations as $e)
			<tr>
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				{{-- <td class="eval" >{{ $e->title }}</td> --}}
				<td class="eval" >{!! HTML::linkRoute('evaluation.show', $e->title, [$player->player_id, $entry, $e->evaluation_id]) !!}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $evaluations->render() !!}
		</div>
	</div>
@stop