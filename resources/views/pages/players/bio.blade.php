@extends('pages.players.layout')

@section('style')
	@parent
	<style type="text/css">
		.table-bio, tr{
			padding: 20px 20px 20px 20px;
		}
		.td-profile-head {
			font-weight: bold;
			padding: 5px 5px 5px 5px;
		}
		.td-stat {
			font-weight: 600;
			font-size: 12pt;
			padding-right: 5px;
			color: orangered;
		}
	</style>
@stop

@section('player-header')
<div class="container">	
	<div class="row">
		<div class="col-md-12">	
			<h2>My Profile</h2>		
				<div class="col-md-3">
					<div class="well">
						<table class="table-bio">								
							<tr>
			                    <td class="td-profile-head">National Rank:</td><td class="td-stat"> {{ $player->national_rank }}</td>
			                 </tr>
			                <tr>
			                    <td class="td-profile-head">State Rank:</td><td class="td-stat">{{ $player->state_rank}}</td>
			                </tr>
							<tr>
			                    <td class="td-profile-head">Tracking #:</td><td class="td-stat">{{ $player->tracking_id }}</td>
			                </tr>
			                <tr>
			                    <td class="td-profile-head">Tracking:</td><td class="td-stat">{{ $player->tracking }}</td>
			                </tr>				                
						</table>
					</div>							
				</div>
				<div class="col-md-3">
					<div class="well">
						<table>
							<tr>
								<td class="td-profile-head">Skill Level:</td><td class="td-stat"{{ $player->skill_level }}</td>
							</tr>
						</table>
					</div>	
				</div>	
				<div class="col-md-3">
					<div class="well">
						<table>
							<tr>
								<td class="td-profile-head">Home:</td><td class="td-stat">{{ $player->home }}</td>
							</tr>
							<tr>
								<td class="td-profile-head">Gender:</td><td class="td-stat">{{ $player->gender }}</td>
							</tr>
						</table>
					</div>	
				</div>
			</div>				
		</div>
	</div>
@stop