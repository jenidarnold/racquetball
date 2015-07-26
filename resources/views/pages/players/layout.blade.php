@extends('layouts.app')

@section('style')
	<style type="text/css">
		.player-title{
			font-weight: 800;
			font-size: 20pt;
			padding-right: 20px;
			padding-top: 15px;
		}

		.player-sub-title{
			font-weight: 500;
			font-size: 18pt;
		}

		.player-nav-container{
			background-color: lightgrey;
			padding-right: 0px;
			text-align:center;
		}

		.nav-pills {
			font-weight: 600;
			font-size: 12pt;
			padding-left: 25px;
		}

		.player-logo{
			text-align:center;
			padding-top: 15px;
		}
	</style>
@stop

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-2">
			<div class="player-nav-container">	
				<div style="text-align:left">
					<div class="player-logo">
			   			<img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} class="img-thumbnail" width="200px">		
			   		</div>
					<ul class="nav nav-pills nav-stacked">				
						<li id="li-profile"><a href="/players/{{ $player->player_id}}/"><i class="fa fa-user"></i> Profile</a></li>
						<li id="li-tourney"><a href="/players/{{ $player->player_id}}/tournaments"><i class="fa fa-trophy"></i> Tournaments</a></li>
						<li id="li-journal"><a href="/players/{{ $player->player_id}}/journal"><i class="fa fa-edit"></i> Journal</a></li>
						<li id="li-gallery"><a href="/players/{{ $player->player_id}}/gallery"><i class="fa fa-photo"></i> Gallery</a></li>
					</ul>
				</div>
			</div>	
		</div>	
		<div class="col-md-10 player-content">	
			<div class="row">
				<label class="player-title">{{$player->first_name.' '.$player->last_name}}</label>
			</div>
			<div class="row col-md-10 panel panel-primary">
				@yield('menu')
			</div>
			<div class="row col-md-10">
				@yield('title')
			</div>
			<div class="row col-md-10">
				@yield('player-content')
			</div>
		</div>	
	</div>	
</div>
<div class="row">
	@yield('player-footer')
</div>
@stop