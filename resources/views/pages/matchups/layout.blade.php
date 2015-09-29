@extends('layouts.app')

@section('style')
	<style type="text/css">
	.lbl {
		font-weight: bold;
		font-size:34px;
	}
	.hd {
		font-size: 24pt;
		font-weight: bolder;
		font-color:red;
	}
	.hd2 {
		font-size:32pt;
		font-style: italic;
		font-weight: bolder;
		font-color: grey;
	}	
	.racquet {
		height:60px;
		padding-right:10px;
	}
	.lbl-player {
		font-weight:600 !important; 
		font-size:14pt !important;
	}
	.player {
		font-weight:600 !important; 
		font-size:14pt !important;
	}
	</style>
@stop

@section('content')
<div class="main">
	<div class="row">
		<div class="col-s">
			<div class="panel1 panel-primary">
				<div class="panel1-heading la-primary">
					<center>
						<img src='images/racquet-right.png' class='racquet')>
						<span class='hd'>Head</span><span class="hd2"> 2 </span><span class='hd'>Head</span>
						<img src='images/racquet-left.png' class='racquet')>
					</center>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">	
							<center>				
								{!! Form::open(array('class' => 'form-inline', 'role' => 'form')) !!}
									<div class="form-group" style="padding-bottom:10px">
										<span class='lbl-player text-primary' style='font-weight:600; font-size:18pt'>Player 1</span>
										{!! Form::select('ddlPlayer1', $players_list, $player1->player_id, array('class' => 'player form-control', 'style' => 'font-weight:300; font-size:12pt; width:250px' )) !!}	
										<!--span class='lbl text-muted' style="font-weight:bold; font-size:18pt; padding-left:20px; padding-right:20px"><i> Vs </i></span -->
										{!! Form::submit('Vs', array('class' =>'btn btn-sm btn-success', 'style' => 'font-style:italic; font-weight:300; font-size:14pt')) !!}	
										{!! Form::select('ddlPlayer2', $players_list, $player2->player_id, array('class' => 'player form-control', 'style' => 'font-weight:300; font-size:12pt; width:250px;text-align:center' )) !!}	
										<span class='lbl-player text-primary' style='font-weight:600; font-size:18pt;'>Player 2</span>
									</div>
									
								{!! Form::close() !!}	
							</center>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>		
</div>

@yield('matchup-content')

@stop