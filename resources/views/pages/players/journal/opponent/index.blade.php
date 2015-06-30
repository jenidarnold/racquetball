@extends('pages.players.journal.opponent.layout')

@section('style')	
	<style type="text/css">

	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">My Opponents' Logs</label>
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
			@foreach($opplogs as $o)
			<tr>
				<td class="eval" >{{ $o->created_at }}</td>
				<td class="eval" >{{ $o->updated_at }}</td>
				{{-- <td class="eval" >{{ $e->title }}</td> --}}
				<td class="eval" >{!! HTML::linkRoute('opponent.show', $o->title, [$player->player_id, $entry, $e->opponent_id]) !!}</td>
			</tr>
			@endforeach
		</table>
		<div>
		{{--!! $opplogs->render() !!--}}
		</div>
	</div>
@stop