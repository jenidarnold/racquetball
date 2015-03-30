@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Tournaments</div>

				<div class="panel-body">
					<ul>
						@foreach ($tournaments as $tourney)
							<li> Tournament: {{ $tourney->name}}   Location: {{ $tourney->location }} Dates: {{ $tourney->start_date}} to {{ $tourney->end_date }}  </li>					
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop