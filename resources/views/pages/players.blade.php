@extends('layouts.app')

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Players</div>

				<div class="panel-body">
					<ul>
						@foreach ($players as $player)
							<li> Name: {{ $player->ranking}}   Home: {{ $player->player_id }}  </li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop