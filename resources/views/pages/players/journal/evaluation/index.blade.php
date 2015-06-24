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
	<div class="row" style="padding-top:10px">
		<table class="table table-condensed">
			<thead class="label-primary">
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
	</div>
@stop