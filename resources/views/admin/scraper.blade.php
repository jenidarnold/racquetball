@extends('layouts.app')

@section('style')
	<style type="text/css">
		.player{
			width:300px;
		}
		.tournament{
			width:600px;
		}
		
		
	</style>
@stop
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
					{!! Form::open(array('route' => 'download_tournaments', 'method' => 'get')) !!}	
					<div class="row">	
						<div class="col-md-1 col-md-offset-0">
                        	{!! Form::Label('ddlLocation', 'Location:', array('id' => 'lblLocation')) !!}
                        </div>
                        <div class="col-md-2 col-md-offset-0">
							{!! Form::select('location_id', $locations, null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="row">	
						<div class="col-md-1 col-md-offset-0">
                        	{!! Form::Label('ddlTimePeriod', 'Time Period:', array('id' => 'lblTimePeriod')) !!}
                        </div>
                        <div class="col-md-1 col-md-offset-0">
							{!! Form::select('time_period', ['Past' => 'Past', 'Live' => 'Live', 'Future' => 'Future'], null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="row">								
						<div class="col-md-4 col-md-offset-1">
							<br/>
							<button id="btnTournaments" type="submit" class="btn btn-primary">Download Tournaments</button>
						</div>				
					</div>		
					{!! Form::close() !!}

					<h3>Participants</h3>
					<div class="row">
						{!! Form::open(array('route' => 'download_participants', 'method' => 'get')) !!}
						<div class="col-md-1 col-md-offset-0">
							{!! Form::Label('ddlTournaments', 'Tournament:', array('id' => 'lblTournament')) !!}
						</div>
						<div class="col-md-6 col-md-offset-0">
							{!! Form::select('tournament_id', $tournaments, null, array('class' => 'tournament form-control')) !!}	
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
							{!! Form::select('player_id', $players, null, array('class' => 'player form-control')) !!}	
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
                        <div class="col-md-2 col-md-offset-0">
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
@stop
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){           
            $(".player").select2({
            	placeholder: "Select a Player",
            	allowClear: true,        	 	
            });	
            $(".player").select2("val", "");

            $(".tournament").select2({
            	placeholder: "Select a Tournament",
            	allowClear: true,        	 	
            });	
            $(".tournament").select2("val", "");
        });
</script>