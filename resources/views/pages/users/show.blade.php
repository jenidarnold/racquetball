@extends('layouts.app')

@section('style')
	<style>
		.div-welcome {
			text-align: center;
			padding-top: 15px;
			padding-bottom: 15px;
		}
		.welcome {
			font-weight: 300;
			font-size: 18pt;
		}		
		.div-describe {
			text-align: center;
			padding-top: 15px;
			padding-bottom: 15px;
		}

		.describe {
			font-weight: 500;
			font-size: 20pt;
		}	

		.region {
			vertical-align: top;
			text-align: center;
			padding-top: 15px;
			padding-bottom: 15px;
		}

		.region-title {
			color: steelblue;
		}

		.go-arrow{
			text-align: right;
		}
	</style>
	@parent	
@stop

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-2">			
	   		
		</div>			
		<div class="row col-md-12 div-welcome">
			<label class="welcome">Welcome, {{$user->name}}</label>
		</div>	
		<div class="row col-md-12 div-describe">
			<label class="describe">Your account settings and preferences</label>
		</div>	
	</div>
	<div class="row">
		<div class="col-md-4 region panel panel-default box-shadow--2dp" role="region">
			<h2 class="region-title">
				<div class="" id="">
					<i class="fa fa-lock"></i> Sign-in &amp; security
					<i class="fa fa-caret-right"></i>				
				</div>
			</h2>
		</div>
		<div class="col-md-4 region" role="region">
			<h2 class="region-title">
				<div class="" id="">
					<i class="fa fa-user"></i> Personal Info
					<i class="fa fa-caret-right"></i>
				</div>
			</h2>
		</div>
		<div class="col-md-4 region" role="region">
			<h2 class="region-title">
				<div class="" id="">
					<i class="fa fa-cog"></i> Preferences
					<i class="fa fa-caret-right"></i>
				</div>
			</h2>
		</div>
	</div>
</div>
@stop