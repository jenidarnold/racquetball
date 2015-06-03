@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>{{ $player->first_name }} {{ $player->last_name }} </h3>
				</div>
				<div class="panel-body">
					<div class="row">
					   	<div class="col-md-2">
							<img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} class="img-thumbnail" width="100" >
						</div>
						<div class="col-md-4">
							<li>Skill:{{ $player->skill_level }}</li>
		                    <li>Rank: {{ $player->ranking }}</li>
							<li>Home: {{ $player->home }} </li>
							<li>Gender:{{ $player->gender }}</li>
						</div>
						<div class="col-md-6">
							
						</div>	
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3>Tournament History</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<th>Date</th>
							<th>Tournament</th>
							<th>Result</th>
						</thead>
						<tbody>
						<!--
						@ foreach ($tournaments as $tournament)
							<tr>	
								<td><a href="{{ route('players.show', [$player->player_id]) }}"><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->img_profile }} class="img-thumbnail" width="100" ></a></td>
								<td>{{ $player->first_name }}  </td>
								<td>{{ $player->last_name }}  </td>
								<td>{{ $player->gender }}</td>
								<td>{{ $player->skill_level }} </td>								
								<td>{{ $player->home }} </td>
							</tr>
						@e ndforeach
						-->
						</tbody>
					</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3>Match History</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<th>Date</th>
							<th>Tournament</th>
							<th>Winner</th>
							<th>Loser</th>
							<th>Dvision</th>
							<th>Match Type</th>
						</thead>
						<tbody>						
						@foreach ($matches as $m)
							<tr>	
								<td>{{ $m->match_date }}  </td>
								<td>{{ $m->tournament_id }}  </td>
								<td>{{ $m->player1_id }}</td>
								<td>{{ $m->player2_id }} </td>								
								<td>{{ $m->match_division }} </td>						
								<td>{{ $m->match_type }} </td>
							</tr>
						@endforeach						
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
@stop