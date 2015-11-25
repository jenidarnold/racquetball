@extends('pages.players.journal.layout')

@section('style')	
	<style type="text/css">
		.dash-num {
			font-size: 40px;
		}
		.dash-text {
			font-size: 20px;
		}
		.dash-link {
			font-size: 20px;
			color:white;
			font-weight: bold;
		}
		.panel-green {
	    	border-color: #5cb85c;
	    	color: #fff;
	    	background-color: #5cb85c;
		}
		.panel-gold {
	    	border-color: #f0ad4e;
	    	color: #fff;
	    	background-color: #f0ad4e;
		}
		.panel-pale-blue {
	    	border-color: #669999;
	    	color: #fff;
	    	background-color: #669999;
		}
		.panel-red {
	    	border-color: #d9534f;
	    	color: #fff;
	    	background-color: #d9534f;
		}
		.panel-blue {
	    	border-color: #337ab7;
	    	color: #fff;
	    	background-color: #337ab7;
		}
		.panel-purple {
	    	border-color: #9070bc;
	    	color: #fff;
	    	background-color: #9070bc;
		}
	</style>
	@parent
@stop
@section('title')
	My Dashboard
@stop

@section('journal-content')
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-blue" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-comments"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">12</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/messages/{{ $player->player_id}}">Messages</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-purple" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-pie"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">12</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/evaluation/{{ $player->player_id}}">Stats</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-gold" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-tasks"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">4</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/evaluation/{{ $player->player_id}}">Awards</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>			
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-pale-blue" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-tasks"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">4</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/evaluation/{{ $player->player_id}}">Evaluations</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>		
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-tasks"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">8</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/gameplans/{{ $player->player_id}}">Game Plans</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>	
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red" >
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-4x fa-tasks"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="dash-num">40</div>
							<div class="dash-text">
								<a class="dash-link" href="/players/{{ $player->player_id}}/journal/{{ $entry }}/evaluation/{{ $player->player_id}}">Opponents</a>
							</div>			
						</div>
					</div>
				</div>
				<div class="panel-footer">

				</div>		
			</div>
		</div>			
	</div>
@stop