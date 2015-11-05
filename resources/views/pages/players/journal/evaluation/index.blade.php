@extends('pages.players.journal.layout')

@section('style')	
	<style type="text/css">
		.describe {
			color: gray;
		}
	</style>
	@parent
@stop
@section('journal-content')
	<div class="row" style="padding-top:10px">
		<h3>Self Evaluations</h3>
		<h4 class="describe">These are evalutions completed by myself to assess my skills in my opinion.</h4>
	</div>	
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-success">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">Title</th>
				<th>Actions</th>
			</thead>
			@foreach($self_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->title }}</td>
				<td class="eval">
					<a href="/players/{{ $player->player_id}}/journal/{{$entry}}/evaluation/{{$player->player_id}}/{{$player->player_id}}/create">
						<button class="btn btn-success btn-xs" type="button"><i class="fa fa-plus"></i></button>
					</a>
					<button class="btn btn-warning btn-xs" title="Archive"><i class="fa fa-archive"></i></button>
					<button class="btn btn-danger btn-xs" title="Delete"><i class="fa  fa-times"></i></button>
				</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $self_evals->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Peer Evaluations</h3>
		<h4 class="describe">These are evalutions completed by those whom I've sent an evaluation invitation to assess my skills in their opinion</h4>
	</div>	
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-info">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">From</th>
				<th class="eval-header">Target</th>
				<th class="eval-header">Title</th>
				<th>Actions</th>
			</thead>
			@foreach($peer_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->creator->full_name }}</td>
				<td class="eval" >{{ $e->target->full_name}}</td>
				<td class="eval" >{{ $e->title }}</td>
				<td class="eval">
					<a href="/players/{{ $player->player_id}}/evaluation/invite">
						<button class="btn btn-success btn-xs" type="button" title="Invite"><i class="fa fa-envelope"></i></button>
					</a>
					<button class="btn btn-warning btn-xs" title="Archive"><i class="fa fa-archive"></i></button>
					<button class="btn btn-danger btn-xs" title="Delete"><i class="fa  fa-times"></i></button>
				</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $peer_evals->render() !!}
		</div>
	</div>
	<div class="row" style="padding-top:10px">
		<h3>Opponent Evaluations</h3>
		<h4 class="describe">These are evalutions completed by me on opponents to assess their skills in my opinion</h4>
	</div>	
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-danger">
				<th class="eval-header">Created</th>
				<th class="eval-header">Updated</th>
				<th class="eval-header">From</th>
				<th class="eval-header">Target</th>
				<th class="eval-header">Title</th>
				<th>Actions</th>
			</thead>
			@foreach($opp_evals as $e)
			<tr class="clickable-row" data-href="{!! route('evaluation.show',  [$player->player_id, $entry,  $e->target->player_id, $e->creator->player_id, $e->evaluation_id]) !!}">
				<td class="eval" >{{ $e->created_at }}</td>
				<td class="eval" >{{ $e->updated_at }}</td>
				<td class="eval" >{{ $e->creator->full_name }}</td>
				<td class="eval" >{{ $e->target->full_name}}</td>			
				<td class="eval" >{{ $e->title }}</td>
				<td class="eval">
					<button class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
					<button class="btn btn-warning btn-xs" title="Archive"><i class="fa fa-archive"></i></button>
					<button class="btn btn-danger btn-xs" title="Delete"><i class="fa  fa-times"></i></button>
				</td>
			</tr>
			@endforeach
		</table>
		<div>
		{!! $opp_evals->render() !!}
		</div>
	</div>
@stop