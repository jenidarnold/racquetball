@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				   <h1>Tournament: {{ $tournament->name }} {{ $tournament->participants->count() }}</h1>
				</div>
				<div class="panel-body">
					<h2>Participants</h2>
						<!--
					<ul>
						@foreach ($tournament->participants as $participant)
							<ul>
								<li class="active"><a href="{{ route('participants.show', [$participant->player_id]) }}">{{ $participant }}</a></li>
								<ul>
									<! --
									@foreach ($participant->divisions as $division)
										<li>{{division->name}}</li>
									@endforeach
									-- 
								</ul>
							</ul>
						@endforeach
					</ul>

					-->
				</div>
			</div>
		</div>
	</div>
</div>
@stop