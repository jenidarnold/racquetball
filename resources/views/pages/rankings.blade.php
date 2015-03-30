@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Rankings as of: $rankings[0]["ranking_date"]</div>

				<div class="panel-body">
						{{ $rankings->count() }}
					<ul>
						@foreach ($rankings as $player)
								<li> Rank: {{ $player->ranking}}   Player ID: {{ $player->player_id }}  </li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop