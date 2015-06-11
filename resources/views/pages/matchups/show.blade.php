@extends('layouts.matchups')

@section('style')
	<style type="text/css">
	.hd {
		font-size: 24pt;
	}
	.hd2 {
		font-size:32pt;
		font-style: italic;
		font-weight: bolder;
		font-color: grey;
	}

	.img-profile {
		width:125px;
		height: auto;
		overflow: hidden;
	}
	.profile 
	{
		text-align:center;
		font-size:10pt;
		font-weight:bold;
	}

	.tbl-facts, .tbl-feedback {
		text-align:center;
		font-size:12pt;
		font-weight:bold;
	}
	.row-header{
		font-size: 16pt;
	}
	.row-subheader{
		font-size: 14pt;
	}
	.td-left {
		width: 50%;
		text-align: right;
		font-color: orange;
	}
	.td-right {
		width: 50%;
		text-align: left;
		font-color: blue;
	}
	.progress-radius {
		border-radius: 0;
	}		
	</style>	
@stop	

@section('matchup-content')
<div class="container">
	<div class="row">
		<div class="col-sm-3">	
			<center>		
				<table class="profile">	
					<tr>
						<td><h3>{{ $player1->first_name .' '. $player1->last_name }}</h3></td>
					</tr>
					<!--tr>
						<td>{{ $player1->gender }}</td>
					</tr-->	
					<tr>
						<td>{{ $player1->home }}</td>
					</tr>							
					<tr>
						<td>
						@if(get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player1->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found')	
							<img class='img-profile img-thumbnail' src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player1->player_id.'_normal.jpg' }} ></a>
						@else
							<img class='img-profile img-thumbnail' src='images/racquet-right.png'>
						@endif
						</td>
					</tr>
								
				</table>
			</center>					
		</div>
		<div class="col-sm-6">			
			<center>
				<table class="table table-condensed table-bordered tbl-facts">
					<tr>
						<td colspan="2" class='row-header label-info'>
							<span class='label label-block label-info'>Statistics</span>
						</td>
					</tr>
					<tr class="tr-facts">							
						<td colspan="2" class='row-subheader'>Rank</td>
					</tr>
					<tr>
						<td style="width:50%">{{$player1->national_rank}}</td>
						<td>{{$player2->national_rank}}</td>
					</tr>
					<tr class="tr-facts">
						<td colspan="2" class='row-subheader'>Skill</td>
					</tr>
					<tr>
						<td>{{$player1->skill_level}}</td>
						<td>{{$player2->skill_level}}</td>
					</tr>
					<tr class="tr-facts">
						<td colspan="2" class='row-subheader'>Wins</td>
					</tr>
					<tr>
						<td>{{ $head2head['player1']['wins'] }}</td>
						<td>{{ $head2head['player2']['wins'] }}</td>
					</tr>
				</table>
{{-- 				<table class="table table-striped table-condensed table-bordered tbl-feedback">
					<tr>
						<td colspan="4" class='row-header label-info'>
							<span class='label label-block label-info'>In Your Opinion</span>
						</td>
					</tr>
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>Power</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="float:right; width:80%">80%
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">20%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>Control</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="float:right; width:33%">33%
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width:66%">66%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>Serves</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="float:right; width:40%">40%
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">60%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>Forehand</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="float:right; width:75%">75%
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">25%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>Backhand</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="float:right; width:50%">50%
								</div>
							</div></td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">50%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
				</table> --}}

				<table class="table table-striped table-condensed table-bordered tbl-feedback">
					<tr>
						<td colspan="4" class='row-header label-info'>
							<span class='label label-block label-info'>In Your Opinion</span>
						</td>
					</tr>
					@foreach($skills as $s)
					<tr class="tr-feedback">
						<td colspan="4" class='row-subheader'>{{ $s->skill }}</td>
					</tr>
					<tr>
						<td class="vote-left"><button class="btn btn-xs btn-primary"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="float:right; width:{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"] }}%
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div class="progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="float:right; width:{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"] }}%
								</div>
							</div>
						</td>
						<td class="vote-right"><button class="btn btn-xs btn-default"><i class="fa fa-thumbs-up"></i></button></td>
					</tr>
					@endforeach							
				</table>



			</center>
		</div>
		<div class="col-sm-3">		
			<center>			
				<table class="profile">
					<tr>
						<td><h3>{{ $player2->first_name .' '. $player2->last_name }}</h3></td>
					</tr>
					<!--tr>
						<td>{{ $player2->gender }}</td>
					</tr-->	
					<tr>
						<td>{{ $player2->home }}</td>
					</tr>									
					<tr>
						<td>
						@if(get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player2->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found')							
							<img class='img-profile img-thumbnail' src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player2->player_id.'_normal.jpg' }}  ></a>
						@else
							<img class='img-profile img-thumbnail' src='images/racquet-left.png'>
						@endif
						</td>
					</tr>
					
				</table>
			</center>				
		</div>	
	</div>
</div>
@stop