@extends('layouts.app')
@section('style')
	<style type="text/css">
		.welcome {
			padding-top: 150px;			
			background-image: url('/images/julie-racquet.jpg');
			background-repeat:  no-repeat;
			background-position:  center;
			height: 600px;
		}
		.logo {
		}
		h1 {
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
			padding-top: 150px;
			color: white;
			font-weight: 800;
			font-size: 24pt;
			text-shadow:
		    -1px -1px 0 #000,
		    1px -1px 0 #000,
		    -1px 2px 0 #000,
		    1px 1px 0 #000;  
		}
	</style>
@stop
@section('content')
	<div class="container">
		<center>
		<div class="row welcome">
			<h1 class="primary">Racquetball Prep</h1>
				<br>
				<br>
				<a href="{{ url('/auth/register') }}" class="btn btn-primary btn-lg"><b>Get Started</b></a>
				<br>
				<p class="lead">Prepare. Perform. Prevail.</p>
				<br>
			</div>
		</div>
		</center>	
	</div>
@stop