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
						<span class="navbar-brand brand"><i class="fa fa-circle fa-1.5x purple"></i> 
							<a class="" href="{{ url('/') }}"><span class="text-default">RacquetballHub</span></a>
						</span>
					</li>										
				</ul>			
			</div>
		<!-- 2nd Nav menu -->
			<div class="collapse navbar-collapse" id="refNavBar">

				<ul class="nav navbar-nav">    
					@if (Auth::guest())
						<li><a class="navbar-link" href="{{ url('/auth/login') }}">Login</a></li>
						<li><a class="navbar-link" href="{{ url('/auth/register') }}">Register</a></li>								
					@else    					          
						<li><a class="navbar-link" href="{{ url('/scores/match') }}"> 
							<i class="fa fa-plus-square" style="color:black1"></i> Referee a New Match</a></li>
						<li><a class="navbar-link" href="{{ url('/scores/{user_id}/show') }}"> 
							<i class="fa fa-user" style="color:black1"></i> My Ref'd Matches</a></li>
					@endif	
						<li><a class="navbar-link" href="{{ url('/scores/live') }}"> 
							<i class="fa fa-spinner fa-spin1" style="color:black1"></i> Live Matches </a></li>
						<li><a class="navbar-link" href="{{ url('/scores/completed') }}">
							<i class="fa fa-trophy"></i> Completed Matches</i></a></li>
						<li><a class="navbar-link" href="{{ url('/scores/{user_id}/show') }}"> 
							<i class="fa fa-info-circle" style="color:black1"></i> About this App</a></li>	
					@if (!Auth::guest())
						<li><a class="navbar-link" href="{{ url('/auth/logout') }}">
							<i class="fa fa-power-off" style="color:black1"></i> Sign Out</a></li>
					@endif				
               </ul>
            </div>
        </div>
    </nav>

    <div class="White">
		@yield('ref-content')
    </div>
@stop