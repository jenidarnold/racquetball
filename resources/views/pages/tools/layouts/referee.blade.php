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

				<ul class="nav navbar-nav pointer">    
					@if (Auth::guest())
						<li><a class="navbar-link" href="{{ url('/auth/login') }}">
							<i class="fa fa-sign-in text-success"></i> Sign-in</a></li>
						<li><a class="navbar-link" href="{{ url('/auth/register') }}">
							<i class="fa fa-keyboard-o text-default"></i> Register</a></li>	
						<li><a class="navbar-link" href="{{ route('scores.live', [0]) }}"> 
							<i class="fa fa-spinner fa-spin text-info"></i> Live Matches </a></li>
						<li><a class="navbar-link text-warning" href="{{ route('scores.complete', [0]) }}">
							<i class="fa fa-trophy text-warning"></i> Completed Matches</i></a></li>
						<li><a class="navbar-link" href="{{ url('/') }}"> 
							<i class="fa fa-info-circle "></i> About this App</a></li>	
					@else   
						@if(isset($user))
						<li><a class="navbar-link">
							<i class="fa fa-user-circle text-primary"></i>								
							{{ $user->first_name }} {{ $user->last_name}}</a></li>
						@endif
						<li class="divider"></li>	
						<li><a class="navbar-link" href="{{ route('scores.user.match', [$user->id]) }}"> 
							<i class="fa fa-plus-square text-success"></i> Create a Match</a></li>
						<li><a class="navbar-link" href="{{ route('scores.user.show', [$user->id]) }}"> 
							<i class="fa fa-address-card text-danger"></i> My Created Matches</a></li>				
						<li><a class="navbar-link" href="{{ route('scores.live', [$user->id]) }}"> 
							<i class="fa fa-spinner fa-spin text-info"></i> Live Matches </a></li>
						<li><a class="navbar-link text-warning" href="{{ route('scores.complete', [$user->id]) }}">
							<i class="fa fa-trophy text-warning"></i> Completed Matches</i></a></li>
						<li><a class="navbar-link" href="{{ url('/') }}"> 
							<i class="fa fa-info-circle"></i> About this App</a></li>	
					@endif
					@if (!Auth::guest())
						<li class="divider"></li>	
						<li><a class="navbar-link" href="{{ url('/auth/logout') }}">
							<i class="fa fa-sign-out text-danger" style="color:black1"></i> Sign Out</a></li>
					@endif				
               </ul>
            </div>
        </div>
    </nav>

    <div class="White">
		@yield('ref-content')
    </div>
@stop