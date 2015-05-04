@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Players</div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<th>Profile</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Skill Level</th>
							<th>Home</th>
						</thead>
						<tbody>
						@foreach ($players as $player)
							<tr>	
								<td><a href="{{ route('players.show', [$player->player_id]) }}"><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->img_profile }} class="img-thumbnail" width="100" ></a></td>
								<td>{{ $player->first_name }}  </td>
								<td>{{ $player->last_name }}  </td>
								<td>{{ $player->gender }}</td>
								<td>{{ $player->skill_level }} </td>								
								<td>{{ $player->home }} </td>
							</tr>
						@endforeach
						</tbody>					
					</table>
				</div>

			</div>
		</div>
	</div>
</div>
@stop