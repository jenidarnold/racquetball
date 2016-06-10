@extends('layouts.app')

@section('style')
	
	@yield('style')
	<style>
		th {
			text-align: center
		}
		.txt-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-right: 15px;
		}
		.lbl-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-left: 15px;
		}
		.player {
			font-weight: 500;
			font-size: 12pt;
			width: 250px;
		}
		.player_name {
			font-weight: 500;
			font-size: 11pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 14pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 14pt;
		}
		.score {
			font-weight: 500;
			font-size: 10pt;
			text-align: center;
		}
		.rank {
			font-weight: 700;
			font-size: 12pt;
			text-align: center;
		}
		.tr-games {
			font-weight: 700;
			font-size: 12pt;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px;
		   padding-right: 5px;
		}
		h4  > *{
		   padding-top: 10px;
		   padding-bottom:  10px;
			background-color: green;
		}

		.match .week_num{
			font-weight: 200;
			font-size: 10pt;
			text-align: center;
			width: 80px;
		}
		.match .match_id {
			font-weight: 200;
			font-size: 10pt;
			text-align: center;
			width: 80px;
		}
		.match .rank {			
			font-weight: 200;
			font-size: 8pt;
			text-align: center;
		}
		.match .player_name {			
			font-weight: 200;
			font-size: 10pt;
			width: 200px;
		}
		.match .score {			
			font-weight: 400;
			font-size: 10pt;
			text-align: center;
		}
		.match .winner {			
			color:green;
			font-weight: 300;
		}
		.txt-score {
			width: 60px;
		}
		.win-streak {
			color:green;
		}
		.loss-streak {
			color:red;
		}
	</style>	
@stop

@section('content')
<div class="container">
	<div id="myvue" >
		<!-- Navigation  -->	
		<div class="row">
			@yield('league_header')
		</div>	
		<div class="row">
			@yield('league_menu')
		</div>	
		<div class="row">
			@yield('league_content')
		</div>
	</div>
@stop

@section('script')
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>	
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>

@yield('script')
@stop
