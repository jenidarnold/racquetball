@extends('pages.players.layout')

@section('player-content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="row">
							<h3 style="">{{ $player->first_name }} {{ $player->last_name }} </h3>						
					</div>
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
@stop