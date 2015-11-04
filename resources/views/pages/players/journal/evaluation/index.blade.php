@extends('pages.players.journal.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop
@section('journal-content')
	<div class="row" style="padding-top:10px">
		<h3>Self Evaluations</h3>
		<h4>These are evalutions completed by myself to assess my skills in my opinion.</h4>
	</div>
	<div class="row">
		<form class="navbar-form" role="searc">
			<div class="col-md-1">
				<a href="/players/{{ $player->player_id}}/journal/{{$entry}}/evaluation/{{$player->player_id}}/{{$player->player_id}}/create">
				<button class="btn btn-success" type="button">New</button>
				</a>
			</div>
			<div class="col-md-4">								
			        <div class="input-group">		       
			            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
			            <div class="input-group-btn">		            
			                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			            </div>
			        </div>
			</div>		
        </form>
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-success">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">From</th>
				<th class="eval-header">Target</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($self_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->creator->full_name }}</td>
				<td class="eval" >{{ $e->target->full_name}}</td>
				<td class="eval" >{{ $e->title }}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $self_evals->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Peer Evaluations</h3>
		<h4>These are evalutions completed by those whom I've sent an evaluation invitation to assess my skills in their opinion</h4>
	</div>
	<div class="row">
		<form class="navbar-form" role="searc">
			<div class="col-md-1">
				<a href="/players/{{ $player->player_id}}/evaluation/invite">
				<button class="btn btn-warning" type="button">Invite</button>
				</a>
			</div>		
			<div class="col-md-4">		
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-warning" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		    </div>
		</form>
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-warning">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">From</th>
				<th class="eval-header">Target</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($peer_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->creator->full_name }}</td>
				<td class="eval" >{{ $e->target->full_name}}</td>
				<td class="eval" >{{ $e->title }}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $peer_evals->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Opponent Evaluations</h3>
		<h4>These are evalutions completed by me on opponents to assess their skills in my opinion</h4>
	</div>
	<div class="row">
		<form class="navbar-form" role="searc">
			<div class="col-md-1">
				<a href="/players/{{ $player->player_id}}/journal/{{$entry}}/evaluation/opponent">
				<button class="btn btn-danger" type="button">New</button>
				</a>
			</div>
			<div class="col-md-4">	
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-danger" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
	        </div>		
		</form>		
	</div>
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-danger">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">From</th>
				<th class="eval-header">Target</th>
				<th class="eval-header">Title</th>
			</thead>
			@foreach($opp_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->creator->full_name }}</td>
				<td class="eval" >{{ $e->target->full_name}}</td>			
				<td class="eval" >{{ $e->title }}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $opp_evals->render() !!}
		</div>
	</div>
@stop