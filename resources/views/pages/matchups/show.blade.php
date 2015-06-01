@extends('layouts.matchups')

@section('style')
	<style type="text/css">
	.vs{
		text-align: center;
		font-size: 24pt;
	}
	</style>	

	
@stop

@section('matchup-content')
<div class="container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="panel panel-success">
				<div class="panel-heading">
					<center><h3>Head to Head</h3></center>
				</div>
				<div class="panel-body">
					<center>
						<table class="table" style="text-align:center;font-size:12pt;font-weight:bold">
							<tr>
								<td></td>
								<td><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player1->player_id.'_normal.jpg' }} class="img-thumbnail" height="100" ></a></td>
								<td></td>
								<td><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player2->player_id.'_normal.jpg' }} class="img-thumbnail" height="100" ></a></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td><h3>{{ $player1->first_name .' '. $player1->last_name }}</h3></td>
								<td><h3>Vs</h3></td>
								<td><h3>{{ $player2->first_name .' '. $player2->last_name }}</h3></td>
								<td></td>
							</tr>
							<tr>							
								<td style='width:150px;font-size:14pt;'>Rank</td>
								<td style='width:200px;'>{{$player1->id}}</td>
								<td style='width:50px;'></td>
								<td style='width:200px;'>{{$player2->id}}</td>
								<td style='width:150px;'></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Skill</td>
								<td>{{$player1->skill_level}}</td>
								<td></td>
								<td>{{$player2->skill_level}}</td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Wins</td>
								<td>10</td>
								<td></td>
								<td>4</td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Power</td>
								<td><i class="fa fa-lg fa-check"></td>
								<td></td>
								<td></i></td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Control</td>
								<td></td>
								<td></td>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Serves</td>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Forehand</td>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td style='width:150px;font-size:14pt;'>Backhand</td>
								<td></td>
								<td></td>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
							</tr>
						</table>
					</center>
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
@stop