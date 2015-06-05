@extends('layouts.matchups')

@section('style')
	<style type="text/css">
	.profile 
	{
		text-align:center;
		font-size:10pt;
		font-weight:bold;
	}

	.category
	{
		background-color: lightblue;
	}
	</style>	
@stop	

@section('matchup-content')
<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<center><h2>Head to Head</h2></center>
			</div>
			<div class="panel-body">
				<div class="col-md-3">	
					<center>		
						<table class="profile">
							<tr>
								<td><h3>{{ $player1->first_name .' '. $player1->last_name }}</h3></td>
							</tr>
							<tr>
								<td><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player1->player_id.'_normal.jpg' }} class="img-thumbnail" width="200" ></a></td>
							</tr>
							<tr>
								<td>{{ $player1->gender }}</td>
							</tr>	
							<tr>
								<td>{{ $player1->home }}</td>
							</tr>				
						</table>
					</center>					
				</div>
				<div class="col-md-6">			
					<center>
						<table class="table table table-condensed" style="text-align:center;font-size:12pt;font-weight:bold">
							<tr class="category">							
								<td colspan="2">Rank</td>
							</tr>
							<tr>
								<td>{{$player1->national_rank}}</td>
								<td>{{$player2->national_rank}}</td>
							</tr>
							<tr class="category">
								<td colspan="2">Skill</td>
							</tr>
							<tr>
								<td>{{$player1->skill_level}}</td>
								<td>{{$player2->skill_level}}</td>
							</tr>
							<tr class="category">
								<td colspan="2">Wins</td>
							</tr>
							<tr>
								<td>{{ $head2head['player1']['wins'] }}</td>
								<td>{{ $head2head['player2']['wins'] }}</td>
							</tr>
							<tr class="category">
								<td colspan="2">Power</td>
							</tr>
							<tr>
								<td><i class="fa fa-lg fa-check"></td>
								<td></td>
							</tr>
							<tr class="category">
								<td colspan="2">Control</td>
							</tr>
							<tr>
								<td></td>
								<td><i class="fa fa-lg fa-check"></i></td>
							</tr>
							<tr class="category">
								<td colspan="2">Serves</td>
							</tr>
							<tr>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
							</tr>
							<tr class="category">
								<td colspan="2">Forehand</td>
							</tr>
							<tr>
								<td><i class="fa fa-lg fa-check"></i></td>
								<td></td>
							</tr>
							<tr class="category">
								<td colspan="2">Backhand</td>
							</tr>
							<tr>
								<td></td>
								<td><i class="fa fa-lg fa-check"></i></td>
							</tr>
						</table>
					</center>
				</div>
				<div class="col-md-3">		
					<center>			
						<table class="profile">
							<tr>
								<td><h3>{{ $player2->first_name .' '. $player2->last_name }}</h3></td>
							</tr>
							<tr>
								<td><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player2->player_id.'_normal.jpg' }} class="img-thumbnail" width="200" ></a></td>
							</tr>
							<tr>
								<td>{{ $player2->gender }}</td>
							</tr>	
							<tr>
								<td>{{ $player2->home }}</td>
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