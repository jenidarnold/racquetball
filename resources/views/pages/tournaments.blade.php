@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h2>Tournaments</h2>
				</div>
				<div class="panel-body">
					<ul>
						@foreach ($tournaments as $tourney)
							<div class="panel panel-default">
								<div class="panel-heading">				
									<h3>{{ $tourney->name}} </h3>
								</div>
								<div class="panel-body">
								      <h4>{{ $tourney->start_date}} - {{ $tourney->end_date }}</h4>
									  <h4>{{ $tourney->location }}</h4>
									  <ul class="nav nav-pills">
									  	<li class="active"><a href="#">Participants <span class="badge">123</span></a></li>
									  	<li class="active"><a href="#">Divisions <span class="badge">12</span></a></li>
									  	<li class="active"><a href="#">Sponsors <span class="badge">4</span></a></li>
									  	<li class="active"><a href="#">Live Matches <span class="badge">20</span></a></li>
									  	<li class="active label-success"><a href="#">Brackets <span class="badge">12</span></a></li>
									  </ul>
								</div>	
							</div>				
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@stop