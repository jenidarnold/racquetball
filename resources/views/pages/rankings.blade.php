@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Ranking as of {{ $rankings[0]->ranking_date}}</h3>
				</div>

				<div class="panel-body">
					<ul>
						@foreach ($rankings as $player)
							<div> # {{ $player->ranking}} 

								<a href="{{ route('players.show', [$player->player_id]) }}"><img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->img_profile }} class="img-thumbnail" width="100" ></a>
								<a href="{{ route('players.show', [$player->player_id]) }}">{{ $player->first_name}} {{ $player->last_name}} </a>
							   from {{ $player->home }}  
							   ({{ $player->player_id}} )
							</div>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop