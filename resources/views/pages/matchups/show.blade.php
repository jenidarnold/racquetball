@extends('pages.matchups.layout')

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

	.progress{
		background-color: #A8A8A8; !important
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
						<td class="vote-left">
							<button id="{{"btnVote-p$player1->player_id-s$s->skill_id"}}" 
							hasvote="{{ $votes->hasVote($voter_id, $s->skill_id, $player1->player_id, $player2->player_id) }}"  
							onclick="{{"vote($voter_id,$s->skill_id,$player1->player_id,$player2->player_id);"}}" 
							class="btn btn-xs"><i class="fa fa-thumbs-up"></i></button></td>
						<td class="td-left">
							<div class="progress progress-radius">
								<div id="{{"div-p$player1->player_id-s$s->skill_id-vs"}}" class="p1-bar progress-bar" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for"] }}% (vs)
								</div>
							</div>
						
							<div class="progress progress-radius">
								<div id="{{"div-p$player1->player_id-s$s->skill_id-all"}}" class="p1-bar progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"]  }}%">
								{{ $votes->head2head($s->skill_id, $player1->player_id, $player2->player_id)["for_all"] }}% (all)
								</div>
							</div>
						</td>
						<td class="td-right">
							<div class="progress progress-radius">
								<div id="{{"div-p$player2->player_id-s$s->skill_id-vs"}}" class="p2-bar progress-bar progress-bar-success" role="progressbar 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"]  }}%">
								{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for"] }}% (vs)
								</div>
							</div>
							<div class="progress progress-radius">

								<div id="{{"div-p$player2->player_id-s$s->skill_id-all"}}" class="p2-bar progress-bar progress-bar-success" role="progressbar" 
								aria-valuenow={{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"]  }} 
								aria-valuemin="0" aria-valuemax="100" 
								style="width:{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"]  }}%">
								{{ $votes->head2head($s->skill_id, $player2->player_id, $player1->player_id)["for_all"] }}% (all)
								</div>								
							</div>
						</td>
						<td class="vote-right">
							<button id="{{"btnVote-p$player2->player_id-s$s->skill_id"}}" 
							hasvote="{{$votes->hasVote($voter_id, $s->skill_id, $player2->player_id, $player1->player_id)}}"  
							onclick="{{"vote($voter_id,$s->skill_id,$player2->player_id,$player1->player_id);"}}" 
							class="btn btn-xs"><i class="fa fa-thumbs-up">
							</i></button>
						</td>
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

			//Vote Percentage color-code
			$('[id^=div-p]').each(function(){
				setProgressBarColors($(this));		
			});
			
			setVoteButtons();

		});

		function setVoteButtons(){
			//Vote button selected
			
			$('[id^=btnVote]').each(function(){
				setVote($(this));		
			});
		}

		function setVote(el) {

			var v = el.attr('hasvote');

			//remove previous color
			el.removeClass('btn-primary');
			el.removeClass('btn-info');
			el.removeClass('disabled');
			
			// set new color
			if (v == 'true') {
				el.addClass('btn-primary');
				el.addClass('disabled');
			}
			else {
				el.addClass('btn-default');

			}	
		}

		function setVoteButton(el, hasVote) {

			//remove previous color
			el.removeClass('btn-primary');
			el.removeClass('btn-info');
			el.removeClass('disabled');

			el.attr('hasvote', hasVote);
			// set new color
			if (hasVote == 'false') {
				el.addClass('btn-default');
			}
			else {
				el.addClass('btn-primary');
				el.addClass('disabled');
			}	
		}

		function setProgressBarColors(el){
			var perct = el.text();

			perct = parseInt(perct.replace('%',''));

			//remove previous color
			el.removeClass('progress-bar-warning');
			el.removeClass('progress-bar-success');
			el.removeClass('progress-bar-danger');
			
			// set new color
			if (perct == 50) {
				el.addClass('progress-bar-warning');
			} else if (perct > 50) {
				el.addClass('progress-bar-success');
			}
			else {
				el.addClass('progress-bar-danger');
			}	
		}

		//Voting Button
		function vote(voter_id, skill_id, for_id, against_id){
			$.ajax({
				type: 'GET',
				url: '{{ URL::to('api/vote/castvote') }}',
				data: 'voterID='+ voter_id +'&skillID=' + skill_id + '&forID=' + for_id + '&againstID=' + against_id,
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success:function(result){
					//Update the appropriate div
										
					var div_p1_vs = 'div-p' + for_id + '-s' + skill_id + '-vs';
					var div_p2_vs = 'div-p' + against_id + '-s' + skill_id + '-vs';
					var div_p1_all ='div-p' + for_id + '-s' + skill_id + '-all';
					var div_p2_all ='div-p' + against_id + '-s' + skill_id + '-all';

					//vote button			
					var btnVote_p1 = 'btnVote-p' + for_id + '-s' + skill_id;					
					var btnVote_p2 = 'btnVote-p' + against_id + '-s' + skill_id;	

					$('#'+ div_p1_vs).text( result.p1["for"]+'% (vs)');
					$('#'+ div_p2_vs).text( result.p2["for"]+'% (vs)');	
					$('#'+ div_p1_all).text( result.p1["for_all"]+'% (all)');
					$('#'+ div_p2_all).text( result.p2["for_all"]+'% (all)');		


					$('#'+ div_p1_vs).width( result.p1["for"]+'%');
					$('#'+ div_p2_vs).width( result.p2["for"]+'%');	
					$('#'+ div_p1_all).width( result.p1["for_all"]+'%');
					$('#'+ div_p2_all).width( result.p2["for_all"]+'%');	

					$('#'+ div_p1_vs).attr('aria-valuenow', result.p1["for"]);
					$('#'+ div_p2_vs).attr('aria-valuenow', result.p2["for"]);	
					$('#'+ div_p1_all).attr('aria-valuenow', result.p1["for_all"]);
					$('#'+ div_p2_all).attr('aria-valuenow', result.p2["for_all"]);	

					setProgressBarColors($('#'+ div_p1_vs));
					setProgressBarColors($('#'+ div_p2_vs));
					setProgressBarColors($('#'+ div_p1_all));
					setProgressBarColors($('#'+ div_p2_all));

					setVoteButton($('#'+ btnVote_p1), 'true');
					setVoteButton($('#'+ btnVote_p2), 'false');
				},
				error:function(x,e) {
					alert("error casting vote: " + e.message);
				}
			});
		};

	</script>
