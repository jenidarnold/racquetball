@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Participant: {{ $participant->player["first_name"]}} </h1>

				</div>
			</div>
		</div>
	</div>
</div>
@stop