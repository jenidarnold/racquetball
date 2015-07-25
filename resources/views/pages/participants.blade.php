@extends('layouts.app')

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Tournament: </div>

				<div class="panel-body">
					<h1>Participants </h1>
					<ul>
						@foreach ($participants as $player)
							<li> Name: {{ $player->ranking}}   Home: {{ $player->player_id }}  </li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop