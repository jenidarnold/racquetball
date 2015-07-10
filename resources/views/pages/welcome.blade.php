@extends('layouts.app')
@section('style')
	<style type="text/css">
		.welcome {
			padding-top: 150px;
		}
		h1 {
			font-size: 42pt;
			font-weight: bolder;
			color: white;
		}
		.lead {
			color: white;
			font-weight: bolder;
		}
	</style>
@stop
@section('content')
	<div class="container">
		<center>
		<div class="row welcome">
			<h1>Blah Blah Racquetball</h1>
			<p class="lead">Play. Prepare. Profound.</p>
			<br>
			<a href="{{ url('/auth/register') }}" class="btn btn-default btn-lg">Get Started</a>
		</div>
		</center>	
	</div>
@stop