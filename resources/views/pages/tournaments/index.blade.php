@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel-success">
				<a name="live"></a>
				<div class="panel-heading">
					<h3>Live Racquetball Tournaments</h3>
				</div>
				<div class="panel-body">
					<ul>
						@foreach ($live_tournaments as $tourney)
							<div class="panel panel-default">
								<div class="panel-heading">				
									<h3><a href="{{ route('tournaments.show', [$tourney->tournament_id]) }}">{{ $tourney->name}}</a></h3>
								</div>
								<div class="panel-body">								
									<div class="row">
										<div class="col-md-2">
											<img src="{{ url('http://www.r2sports.com/tourney/imageGallery/gallery/tourneyLogo/'.$tourney->img_logo) }}" width="125" height="85" border="0"></image>
										</div>
										<div class="col-md-10 col-md-offset-0">
										      <h4>Dates: {{ $tourney->start_date}} - {{ $tourney->end_date }}</h4>
											  <h4>Location: {{ $tourney->location }}</h4>
											  <h6><a href="{{ url('http://www.r2sports.com/tourney/home.asp?TID='.$tourney->tournament_id) }}" target="new">Official site</a></h6>
											  <ul class="nav nav-pills">
											  	<li class="active"><a href="{{ route('tournaments.show', [$tourney->tournament_id]) }}">Participants <span class="badge">{{ $tourney->participants->count() }}</span></a></li>
											  	@if ( $tourney->divisions->count() > 0)
											  	   <li class="active"><a href="{{ route('tournaments.divisions.index',  [$tourney->tournament_id]) }}">Divisions <span class="badge">{{ $tourney->divisions->count()}}</span></a></li>
											  	@endif
											  	<li class="active"><a href="#">Sponsors <span class="badge">4</span></a></li>
											  	<li class="active"><a href="#">Live Matches <span class="badge">20</span></a></li>
											  	<li class="active label-success"><a href="#">Brackets <span class="badge">12</span></a></li>
											  </ul>
										</div>
									</div>
								</div>
							</div>				
						@endforeach
					</ul>
				</div>
			</div>
			<div class="panel panel-info">
				<a name="future"></a>
				<div class="panel-heading">
					<h3>Future Racquetball Tournaments</h3>
				</div>
				<div class="panel-body">
					<ul>
						@foreach ($future_tournaments as $tourney)
							<div class="panel1 panel-default">
								<div class="panel1-heading">				
									<h3>{{ $tourney->name}} </h3>
								</div>
								<div class="panel-body">								
									<div class="row">
										<div class="col-md-2">
											<img src="{{ url('http://www.r2sports.com/tourney/imageGallery/gallery/tourneyLogo/'.$tourney->img_logo) }}" width="125" height="85" border="0"></image>
										</div>
										<div class="col-md-10 col-md-offset-0">
										      <h4>Dates: {{ $tourney->start_date}} - {{ $tourney->end_date }}</h4>
											  <h4>Location: {{ $tourney->location }}</h4>
											  <h6><a href="{{ url('http://www.r2sports.com/tourney/home.asp?TID='.$tourney->tournament_id) }}" target="new">Official site</a></h6>
											  <ul class="nav nav-pills">
											  	<li class="active"><a href="{{ route('tournaments.participants.index', [$tourney->tournament_id]) }}">Participants <span class="badge">{{ $tourney->participants->count() }}</span></a></li>
											  	<li class="active"><a href="#">Divisions <span class="badge">12</span></a></li>
											  	<li class="active"><a href="#">Sponsors <span class="badge">4</span></a></li>
											  	<li class="active"><a href="#">Results <span class="badge">20</span></a></li>
											  </ul>
										</div>
									</div>
								</div>	
							</div>			
						@endforeach
					</ul>
				</div>
			<div>
			<div class="panel-footer">
				{!! $future_tournaments->render() !!}
			</div>
		</div>
			</div>
			<div class="panel panel-warning">
				<a name="past"></a>
				<div class="panel-heading">
					<h3>Past Racquetball Tournaments</h3>
				</div>
				<div class="panel-body">
					<ul>
						@foreach ($past_tournaments as $tourney)
							<div class="panel1 panel-default">
								<div class="panel1-heading">				
									<h3>{{ $tourney->name}} </h3>
								</div>
								<div class="panel1-body">								
									<div class="row">
										<div class="col-md-2">
											<img src="{{ url('http://www.r2sports.com/tourney/imageGallery/gallery/tourneyLogo/'.$tourney->img_logo) }}" width="125" height="85" border="0"></image>
										</div>
										<div class="col-md-10 col-md-offset-0">
										      <h4>Dates: {{ $tourney->start_date}} - {{ $tourney->end_date }}</h4>
											  <h4>Location: {{ $tourney->location }}</h4>
											  <h6><a href="{{ url('http://www.r2sports.com/tourney/home.asp?TID='.$tourney->tournament_id) }}" target="new">Official site</a></h6>
											  <ul class="nav nav-pills">
											  	<li class="active"><a href="{{ route('tournaments.participants.index', [$tourney->tournament_id]) }}">Participants <span class="badge">{{ $tourney->participants->count() }}</span></a></li>
											  	<li class="active"><a href="#">Divisions <span class="badge">12</span></a></li>
											  	<li class="active"><a href="#">Sponsors <span class="badge">4</span></a></li>
											  	<li class="active"><a href="#">Results <span class="badge">20</span></a></li>
											  </ul>
										</div>
									</div>
								</div>	
							</div>			
						@endforeach
					</ul>
				</div>
				<div class="panel-footer">
					{!! $past_tournaments->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop