@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="panel panel-default">
				<div class="panel-heading">Screen Scrape</div>
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

					{!! Form::open(array('route' => 'download_rankings', 'method' => 'get')) !!}
						{!! Form::Label('ddlGroup', 'Group:', array('id' => 'lblGroup')) !!}
						{!! Form::select('group_id', $groups, null, array('class' => 'form-control')) !!}<br/>
                        {!! Form::Label('ddlLocation', 'Location:', array('id' => 'lblLocation')) !!}
						{!! Form::select('location_id', $locations, null, array('class' => 'form-control')) !!}<br/>
						{!! Form::submit('Download Rankings', array('class' =>'btn btn-primary')) !!}					
					{!! Form::close() !!}
					<br/>


					<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/rankings') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Download Rankings</button>
							</div>
						</div>
					</form>
					<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/tournaments') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Download Tournaments</button>
							</div>
						</div>
					</form>

					{!! Form::open(array('route' => 'download_participants', 'method' => 'get')) !!}
						{!! Form::Label('ddlTournaments', 'Tournament:', array('id' => 'lblTournament')) !!}
						{!! Form::select('tournament_id', $tournaments, null, array('class' => 'form-control')) !!}	
						{!! Form::submit('Download Participants', array('class' =>'btn btn-primary')) !!}					
					{!! Form::close() !!}
					<br/>

					{!! Form::open(array('route' => 'download_player', 'method' => 'get')) !!}
						{!! Form::Label('txtPlayer', 'PlayerID:', array('id' => 'lblPlayerID')) !!}
						{!! Form::text('player_id', '', null, array('class' => 'form-control')) !!}	
						{!! Form::submit('Download Player', array('class' =>'btn btn-primary')) !!}					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
