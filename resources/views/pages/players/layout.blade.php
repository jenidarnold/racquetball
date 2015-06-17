@extends('layouts.app')

@section('style')
	<style type="text/css">
		.player-title{
			font-weight: 800;
			font-size: 20pt;
			padding-right: 20px;
		}

		.player-sub-title{
			font-weight: 500;
			font-size: 18pt;
		}
	</style>
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-2">			
	   		<img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} class="img-thumbnail" width="200" >		
			<ul class="nav nav-pills nav-stacked">				
				<li id="li-profile"><a href="/players/{{ $player->player_id}}/">Profile</a></li>
				<li id="li-tourney"><a href="/players/{{ $player->player_id}}/tournaments">Tournaments</a></li>
				<li id="li-journal"><a href="/players/{{ $player->player_id}}/journal">My Journal</a></li>
				<li id="li-gallery"><a href="/players/{{ $player->player_id}}/gallery">My Gallery</a></li>
			</ul>
		</div>			
		<div class="col-md-10">
			<label class="player-title">{{$player->first_name.' '.$player->last_name}}: </label>
			@yield('title')
			@yield('player-content')
		</div>
		</div>		
	</div>	
</div>
<div class="row">
	@yield('player-footer')
</div>
@stop