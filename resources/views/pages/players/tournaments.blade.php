@extends('pages.players.layout')

@section('style')	
	<style type="text/css">
		.td-profile-head {
			font-weight: bold;
			padding-right: 5px;
		}
		.tournament {
			font-weight: bold;
			font-size: 12pt;
			color: #fff;
		}

		.table-games {
			width:500px !important;
		}
		.tr-games{
			font-weight: bold;
			text-align: center;
		}
		.seed {
			width:15px  !important;
			font-size: 9pt;
			color:gray;
		}
		.games {
			font-weight: bolder;
			font-size: 8.5pt;
			text-align: right;
			width:10px  !important;
		}

		.game-num {
			font-weight: bolder;
			font-size: 8.5pt;
			text-align: center;
		}

		.winner {
			color:green;
			font-weight: bold;
			width: 250px !important;
		}
		.loser {
			color:gray;
			font-weight: bold;
			width: 250px  !important;
		}

		.score {
			color:gray;
			font-weight: bold;
			text-align: center;
			width:30px  !important;
		}

		.high-score {
			color:green;
			font-weight: bold;
			text-align: center;
		}
		.low-score {
			color:gray;
			font-weight: bold;
			text-align: center;
		}
	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">Tournament History</label>	
@stop

@section('player-content')
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<tbody>
				@foreach ($tournaments as $t)
					<tr class="tournament label-success">		
						<td>{{ $t->start_date }}</td>
						<td>{{ $t->name }}  </td>
						<td> 1st Place  </td>
					</tr>
					<tr>
						<td colspan="3">
							<table class="table">
								<thead>
									<th>Div</th>
									<th>Format</th>
									<th>Round</th>
									<th>Results</th>										
								</thead>
								<tbody>		
								
									@foreach ($tournament->getMatches($t->tournament_id, $player->player_id) as $m)
									<tr>	
										<td>{{ $m->match_division }} </td>						
										<td>{{ $m->match_type }} </td>
										<td>Rnd {{$m->round}}</td>
										<td>
											<table class="table-games table table-condensed">
												<tr class="tr-games label-info">
													<td class="games">&nbsp;</td>
													<td class="games">Gm</td>													
													@for ($i = 1; $i <= $match->whereMatchId($m->match_id)->with('games')->count() ; $i++)
													<td class="game-num">{{ $i}}</td>
													@endfor
													<td class="">&nbsp;</td>
												</tr>
												<tr>
													<td class="seed">[1]</td>
													<td class="winner">
														<a href="{{ route('player.tournaments', [$m->winner_id]) }}" class="winner">
														{{ $m->winner_first_name.' '.$m->winner_last_name}}
														</a>
													</td>
													@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
													<td class="score">{{$g["games"]->first()->score1 }}
													</td>
													@endforeach
													<td class="">&nbsp;</td>
												</tr>
												<tr>
													<td class="seed">[2]</td>
													<td class="loser">
														<a href="{{ route('player.tournaments', [$m->loser_id]) }}" class="loser">
														{{ $m->loser_first_name.' '.$m->loser_last_name }}
														</a>
													</td>
													@foreach ($match->whereMatchId($m->match_id)->with('games')->get() as $g)
													<td class="score">{{$g["games"]->first()->score2}}</td>
													@endforeach
													<td class="">&nbsp;</td>
												</tr>
											</table>
										</td>													
									</tr>
									@endforeach	
								</tbody>
							</table>									
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		{{-- <div>
			{!! $tournaments->render() !!}
		</div> --}}
	</div>
@stop
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//Vote Percentage color-code
			$('#li-tourney').init(function(){	
				var el = $(this);
				el.addClass('active');
			});
			
		});
</script>	