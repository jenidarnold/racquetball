@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="row">						
						{!! Form::open() !!}
						<div class="form-group col-md-4">
							{!! Form::Label('ddlPlayer1', 'Choose Player 1:', array('id' => 'lblPlayerID' ,'for'=> 'ddlPlayer1')) !!}
							{!! Form::select('ddlPlayer1', $players_list, $player1->player_id, array('class' => 'form-control', 'style' => 'width:200px;')) !!}	
						</div>
						<div class="form-group col-md-4">
							{!! Form::Label('ddlPlayer2', 'Choose Player 2:', array('id' => 'lblPlayerID')) !!}
							{!! Form::select('ddlPlayer2', $players_list, $player2->player_id, array('class' => 'form-control', 'style' => 'width:200px;')) !!}	
						</div>
						<div class="col-md-1">
							{!! Form::submit('Show Matchup', array('class' =>'btn btn-primary')) !!}	
							</div>	
						</div>			
						{!! Form::close() !!}						
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>		
</div>

@yield('matchup-content')

@stop