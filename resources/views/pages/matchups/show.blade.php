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

	.p1-bar{
		float: right;
	}
	.p2-bar{
		float: left;
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
						@if((true) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player1->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))	
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
								<div id="div_p1_vs" class="p1-bar progress-bar " role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"] }}%
								</div>
							</div>
						
							<div class="progress progress-radius">
								<div id="div_p1_all" class="p1-bar progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"]  }}%">
								{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"] }}% (overall)
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div id="div_p2_vs" class="p2-bar progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"] }}% 
								</div>
							</div>
						
							<div class="progress progress-radius">
								<div id="div_p2_all"class="p2-bar progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"]  }}%">
								{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"] }}% (overall)
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
						@if((true) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player2->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))							
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
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		$('[id^=div_p]').each(function(){
			var perct = $(this).text();

			perct = parseInt(perct.replace('%',''));

			if (perct == 50) {
				$(this).addClass('progress-bar-warning');
			} else if (perct > 50) {
				$(this).addClass('progress-bar-success');
			}
			else {
				$(this).addClass('progress-bar-danger');
			}		
		});
	});
	</script>
