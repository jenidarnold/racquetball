@extends('layouts.app')

@section('style')
	<style type="text/css">
		.td-profile-head {
			font-weight: bold;
			padding-right: 5px;
		}
	</style>
@stop

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
						<div class="col-md-3">
							<table>								
								<tr>
				                    <td class="td-profile-head">National Rank:</td><td> {{ $player->national_rank }}</td>
				                 </tr>
				                <tr>
				                    <td class="td-profile-head">State Rank:</td><td>{{ $player->state_rank}}</td>
				                </tr>
								<tr>
				                    <td class="td-profile-head">Tracking #:</td><td>{{ $player->tracking_id }}</td>
				                </tr>
				                <tr>
				                    <td class="td-profile-head">Tracking:</td><td>{{ $player->tracking }}</td>
				                </tr>				                
							</table>							
						</div>
						<div class="col-md-3">
							<table>
								<tr>
									<td class="td-profile-head">Skill Level:</td><td>{{ $player->skill_level }}</td>
								</tr>
							</table>	
						</div>	
						<div class="col-md-3">
							<table>
								<tr>
									<td class="td-profile-head">Home:</td><td>{{ $player->home }}</td>
								</tr>
								<tr>
									<td class="td-profile-head">Gender:</td><td>{{ $player->gender }}</td>
								</tr>
							</table>	
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
						@foreach ($tournaments as $tournament)
							<tr>		
								<td>{{ $tournament->start_date }}  </td>
								<td>{{ $tournament->name }}  </td>
								<td> 1st Place  </td>
							</tr>
						@endforeach
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
								<td>
									{{ $m->tournament }}
								</td>
								<td>{{ $m->winner_first_name.' '.$m->winner_last_name}}</td>
								<td>{{ $m->loser_first_name.' '.$m->loser_last_name }} </td>								
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