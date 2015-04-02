@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>{{ $tournament->name }} </h1>
				</div>

				<div class="panel-body">
					<h3>{{ $tournament->participants->count() }} Participants</h2>
					<ul>
						@foreach ($tournament->participants as $participant)
							<ul>
								<li class="active"><a href="{{ route('tournaments.participants.show', [$tournament->tournament_id, $participant->player_id]) }}">{{ $participant->player_id }}</a></li>											  								
							</ul>
						@endforeach
					</ul>

				</div>
			</div>
		</div>
	</div>
</div>
@stop