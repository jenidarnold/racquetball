@extends('layouts.app')

@section('style')
	<style type="text/css">
		
		.tournament {
			font-weight: bold;
			font-size: 12pt;
			color: #fff;
		}

		.tr-games{
			font-weight: bold;
			text-align: center;
		}
		.seed {
			width:15px;
			font-size: 9pt;
			color:gray;
		}
		.games {
			font-weight: bolder;
			text-align: right;
		}
		.winner {
			color:green;
			font-weight: bold;
		}
		.loser {
			color:gray;
			font-weight: bold;
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
		.player-title{
			font-weight: 500;
			font-size: 16pt;
		}
	</style>
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<label class="player-title">{{ $player->first_name }} {{ $player->last_name }} </label>
	   		<img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} class="img-thumbnail" width="200" >		
			<ul class="nav nav-pills nav-stacked">				
				<li><a href="#">Profile</a></li>
				<li class="active"><a href="#">Tournaments</a></li>
				<li><a href="#">My Journal</a></li>
				<li><a href="#">My Gallery</a></li>
			</ul>
		</div>			
		<div class="col-md-10">
			@yield('player-header')
		</div>
		</div>		
	</div>	
</div>
<div class="row">
	@yield('player-content')
</div>
@stop