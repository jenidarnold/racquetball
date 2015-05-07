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
					<h3>By Divisions</h3>
				</div>
				<div class="panel-body">
					<h3>By Participants: {{ $tournament->participants->count() }}</h3>
					<table class="table">
						<thead>
							<th>Profile</th>
							<th>Player ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Skill Level</th>
							<th>Division</th>
						</thead>
						<tbody>
						@foreach ($tournament->participants as $participant)
							<tr>	
								<td>
									<a href="{{ route('players.show', [$participant->player_id]) }}">
								     <img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$participant->player['player_id'].'_normal.jpg'}} class="img-thumbnail" width="100" >
								     </a>
								</td>
								<td>{{ $participant->player['player_id'] }}  </td>
								<td>{{ $participant->player['first_name'] }}  </td>
								<td>{{ $participant->player['last_name']   }}  </td>
								<td>{{ $participant->player['gender']    }}  </td>
								<td>{{ $participant->player['skill_level']  }}  </td>
								<td>{{ $participant->player['division']  }}  </td>
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