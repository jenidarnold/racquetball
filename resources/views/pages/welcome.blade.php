@extends('layouts.app')
@section('style')
	<style type="text/css">

	    .container { 
        background-color: transparent !important;
    	}
		.bg-logo {
			/* background-image: url('/images/julie-racquet1.jpg'); */
			background-image: url('/images/racquet-round.png');
			background-repeat:  no-repeat;
			background-position:  center;
			vertical-align: center;
			height:350px;
			padding-top: 130px;
		}
		.main {
			padding-top: 50px;
		}
		h1 {
			padding-top: 5px;
			font-size: 60pt;
			font-weight: 900;
			color: white;
			text-shadow:
		    -1px -1px 0 #000,
		    1px -1px 0 #000,
		    -1px 4px 0 #000,
		    1px 1px 0 #000;  
		}
		.lead {
			padding-top: 25px;
			color: white;
			font-weight: 800;
			font-size: 24pt;
			text-shadow:
		    -1px -1px 0 #000,
		    1px -1px 0 #000,
		    -1px 2px 0 #000,
		    1px 1px 0 #000;  
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
			<h1>Racquetball Prep</h1>																
		</div>
		<div class="row bg-logo">
			<a href="{{ url('/auth/register') }}" class="btn-start btn btn-primary btn-lg">Get Started</a>
		</div>
		<div class="row">
			<p class="lead">Prepare. Perform. Prevail.</p>	
		</div>
		</center>	
	</div>
@stop