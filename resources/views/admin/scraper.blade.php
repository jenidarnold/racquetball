@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Download from Official Site</h3>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					@if($success)
						<div class="alert-box success">
							<h2>{{ $success}}</h2>
						</div>
					@endif
					<h3>Tournaments</h3>
					<div class="row">
						<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/tournaments') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">								
								<div class="col-md-4 col-md-offset-1">
									<button id="btnTournaments" type="submit" class="btn btn-primary">Download Tournaments</button>
								</div>
							</div>
						</form>
					</div>

					<h3>Participants</h3>
					<div class="row">
						{!! Form::open(array('route' => 'download_participants', 'method' => 'get')) !!}
						<div class="col-md-1 col-md-offset-0">
							{!! Form::Label('ddlTournaments', 'Tournament:', array('id' => 'lblTournament')) !!}
						</div>
						<div class="col-md-6 col-md-offset-0">
							{!! Form::select('tournament_id', $tournaments, null, array('class' => 'form-control')) !!}	
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<br/>
							{!! Form::submit('Download Participants', array('class' =>'btn btn-primary')) !!}
						</div>					
						{!! Form::close() !!}
					</div>


					<h3>Player Profiles</h3>
					<div class="row">
						{!! Form::open(array('route' => 'download_player', 'method' => 'get')) !!}
						<div class="col-md-1 col-md-offset-0">
							{!! Form::Label('txtPlayer', 'PlayerID:', array('id' => 'lblPlayerID')) !!}
						</div>
						<div class="col-md-1 col-md-offset-0">
							{!! Form::text('player_id', '', null, array('class' => 'form-control')) !!}	
						</div>
					</div>
					<div class="row">					
						<div class="col-md-4 col-md-offset-1">
							<br/>
							{!! Form::submit('Download Player', array('class' =>'btn btn-primary')) !!}	
						</div>				
					{!! Form::close() !!}
					</div>

					<h3>Match History</h3>
					<div class="row">
						{!! Form::open(array('route' => 'download_matches', 'method' => 'get')) !!}
						<div class="col-md-1 col-md-offset-0">
							{!! Form::Label('txtMatches', 'Player:', array('id' => 'lblMatches')) !!}
						</div>
						<div class="col-md-2 col-md-offset-0">
							{!! Form::select('player_id', $players, null, array('class' => 'form-control')) !!}	
						</div>
					</div>
					<div class="row">					
						<div class="col-md-4 col-md-offset-1">
							<br/>
							{!! Form::submit('Download Matches', array('class' =>'btn btn-primary')) !!}	
						</div>				
					{!! Form::close() !!}
					</div>

					<h3>Rankings</h3>
					<div class="row">
						{!! Form::open(array('route' => 'download_rankings', 'method' => 'get')) !!}
						<div class="col-md-1 col-md-offset-0">
							{!! Form::Label('ddlGroup', 'Group:', array('id' => 'lblGroup')) !!}
						</div>
						<div class="col-md-4 col-md-offset-0">
							{!! Form::select('group_id', $groups, null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-1 col-md-offset-0">
                        	{!! Form::Label('ddlLocation', 'Location:', array('id' => 'lblLocation')) !!}
                        </div>
                        <div class="col-md-4 col-md-offset-0">
							{!! Form::select('location_id', $locations, null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<br/>
							{!! Form::submit('Download Rankings', array('class' =>'btn btn-primary')) !!}
						</div>					
						{!! Form::close() !!}
					</div>
					<br/>
					

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
