@extends('layouts.app')
@section('style')
	<style type="text/css">

	    .container { 
        background-color: transparent !important;
    	}
		.bg-logo {
			/* background-image: url('/images/julie-racquet1.jpg'); */
			/*background-image: url('/images/racquet-round.png'); */
			/*background-image: url('/images/blueball.png'); */
			background-repeat:  no-repeat;
			background-position:  center;
			vertical-align: center;
			height:350px;
			padding-top: 130px;
		}
		.main {
			padding-top: 50px;
		}


		.rball {
			padding-top: 25px;
			font-family: 'Josefin Slab';
			font-size: 70pt;
			font-weight: 900;			
			color: black;
			/*text-shadow:
		    -1px -1px 0 black,
		    1px -1px 0 black,
		    -1px 4px 0 black,
		    1px 1px 0 black; 
		    */ 
		}

		.ball{

			margin-top: : -125px;
			height: 100px;
		}

		.hub {
			font-family: 'Open Sans';
			padding-top: 5px;
			font-size: 80pt;
			font-weight: 900;
			color: black;
			/*text-shadow:
		    -1px -1px 0 black,
		    1px -1px 0 black,
		    -1px 4px 0 black,
		    1px 1px 0 black;  */
		}

		.lead {
			padding-top: 25px;
			color: blue;
			font-weight: 800;
			font-size: 24pt;
			text-shadow:
		    -1px -1px 0 black,
		    1px -1px 0 grey,
		    -1px 2px 0 grey,
		    1px 1px 0 grey;  
		}

		.btn-start {			
			font-weight: bold;
		}
	</style>
@stop
@section('content')
	<div class="container main">
		<center>
		<div class="row">
			<span class="rball">Racquetball</span>			
			<img src="{{ asset('images/blueball.png')}}" class="ball" />
			<span class="hub"><b>Hub</b></span>
		</div>
		<div class="row bg-logo-disable">			
			<a href="{{ url('/auth/register') }}" class="btn-start btn btn-info btn-lg">Get Started</a>
		</div>
		<!--div class="row">
			<p class="lead">Prepare. Perform. Prevail.</p>	
		</div--!>
		</center>	
	</div>
@stop