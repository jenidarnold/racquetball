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
		height:40px;
	}
	</style>
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<center>
						<img src='images/racquet-right.png' class="" ='racquet')>
						<span class='hd'>Head</span><span class="hd2"> 2 </span><span class='hd'>Head</span>
						<img src='images/racquet-left.png' class="" ='racquet')>
					</center>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">	
							<center>				
								{!! Form::open(array('class' => 'form-inline', 'role' => 'form')) !!}
									<div class="form-group" style="padding-bottom:10px">
										<span class='lbl text-primary' style="font-weight:bolder; font-size:14pt;">Player 1</span>
										{!! Form::select('ddlPlayer1', $players_list, $player1->player_id, array('class' => 'form-control', 'style' => 'width:250' )) !!}	
										<span class='lbl text-muted' style="font-weight:bold; font-size:18pt; padding-left:20px; padding-right:20px"><i> Vs </i></span>
									
										{!! Form::select('ddlPlayer2', $players_list, $player2->player_id, array('class' => 'form-control', 'style' => 'width:250;text-align:center' )) !!}	
										<span class='lbl text-primary' style="font-weight:bolder; font-size:14pt">Player 2</span>
									</div>
									<br/>{!! Form::submit('Show Matchup', array('class' =>'btn btn-sm btn-success', 'style' => 'font-weight:bold')) !!}								
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