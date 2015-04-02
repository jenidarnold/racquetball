@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Tournament: {{ $tournament->name }} {{ $tournament->participants->count() }}</div>

				<div class="panel-body">
					<h1>Participants</h1>
					<!--ul>
						@foreach ($tournament->participants as $participant)
							<ul>
								<li> Name: {{ $participant->player_id}}  Division: {{ $participant->division_id}}  </li>							
							</ul>

						@endforeach
					</ul -->

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