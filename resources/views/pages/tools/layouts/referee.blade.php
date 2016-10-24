@extends('layouts.app')

@section('style')
	<style>
		.player {
			font-weight: 500;
			font-size: 14pt;
		}
		.player-sum {
			font-weight: 500;
			font-size: 12pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 9pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 9pt;
		}
		.score {
			font-weight: 500;
			font-size: 12pt;
			text-align: center;
		}
		.th-games {
			text-align: center;
			color: white;
		}
		.nopadding {
			padding: 0px !important;
		}
		td {
			padding: 2px !important;
		}
		.tr-games {
			font-weight: 300;
			font-size: 9pt;
		}
		.game-time{
			font-size: 8pt;
			color:white;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.purple {
			color:#7E43CB;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px 5px 5px;
		   padding-right: 5px;
		}
		h3  > *{
		   padding-top: 10px;
		   padding-bottom:  10px;
		}
		.lbl-team {
			font-weight: 700;
			font-size: 14pt;
		}
		.timer {
			text-align: center;
		}
		.timeout .modal-backdrop {
	    	background-color: yellow;
		}
		.winner .modal-backdrop {
	    	background-color: green;
		}	
		.btn-actions {
			margin-top: 150px;			
			margin-bottom: 10px;
		}
		.brand-small {
			font-size: 19pt !important;
			font-weight: 700;
		}
	</style>
	@parent	
@stop

@section('content')
	<nav class="navbar navbar-inverse ">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#refNavBar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav navbar-nav">
					<li>
						<a class="navbar-brand" href="#">					
							<!-- img class="logo" src="{{ asset('/images/racquet-right.png') }}" -->				
						</a>
					</li>
					<li>
						<span class=""><i class="fa fa-circle fa-2x purple"></i> 
							<a class="brand-small text-default" href="{{ url('/') }}">RacquetballHub.com</a></span>
					</li>										
				</ul>			
			</div>
		<!-- 2nd Nav menu -->
			<div class="collapse navbar-collapse" id="refNavBar">
				<ul class="nav navbar-nav">               
					<li><a class="navbar-link" href="{{ url('/scores/referee') }}"> 
						<i class="fa fa-home1" style="color:black1"></i> Score a Match</a></li>
					<li><a class="navbar-link" href="{{ url('/scores/live') }}"> 
						<i class="fa fa-home1" style="color:black1"></i> Live Matches </a></li>
					<li><a class="navbar-link" href="{{ url('/scores/recent') }}">
						<i class="fa fa-trophy1"></i> Recent Matches</i></a></li>
					<li><a class="navbar-link" href="{{ url('/scores/archived') }}">
						<i class="fa fa-users1"></i> Archived Matches</a></li>		
					<li><a class="navbar-link" href="{{ url('/scores/about') }}"> 
						<i class="fa fa-home1" style="color:black1"></i> About this App</a></li>			
               </ul>
            </div>
        </div>
    </nav>

    <div class="White">
		@yield('ref-content')
    </div>
@stop