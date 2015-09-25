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

		.regions {
			vertical-align: top;
			text-align: center;
			padding-top: 15px;
			padding-left: 20px;
			padding-right: 20px;
			padding-bottom: 15px;
		}
		.region {
			text-align: center;
			padding-left: 30px;
			padding-right: 30px;
		}
		.region-title {
			color: steelblue;
		}

		.list-group-item {
			font-size: 14pt;
		}
	</style>
	@parent	
@stop
@section('content')
<div class="main-content">
	<div class="row">
		<div class="row col-md-12 div-welcome">
			<label class="welcome">Welcome, {{$user->name}}</label>
		</div>	
		@if(Session::has('message'))
			<div class="row col-md-12 alert {{ Session::get('alert-class', 'alert-info') }}">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<center>{{ Session::get('message') }}</center>
			</div>
		@endif
		<div class="row col-md-12 div-describe">
			<label class="describe">Your account settings and preferences</label>
		</div>	
	</div>
	<div class="row regions">
		<div class="col-md-4 region">
			<div class="panel panel-default box-shadow--2dp">
				<h2 class="region-title">
					<div class="" id="">
						<i class="fa fa-lock"></i> Sign-in &amp; Security
						<i class="fa fa-caret-right"></i>				
					</div>
				</h2>
				<div class="list-group">
				  <a href="/users/{{$user->id}}/edit" class="list-group-item">Change Username and/or Password</a>
				  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
				  <a href="#" class="list-group-item">Morbi leo risus</a>
				  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
				  <a href="#" class="list-group-item">Vestibulum at eros</a>
				</div>
			</div>
		</div>
		<div class="col-md-4 region">
			<div class="panel panel-default box-shadow--2dp">
				<h2 class="region-title">
					<div class="" id="">
						<i class="fa fa-user"></i> Personal Info
						<i class="fa fa-caret-right"></i>
					</div>
				</h2>
				<div class="list-group">
				  <a href="/users/{{$user->id}}/info/edit" class="list-group-item">Your personal info</a>
				  <a href="#" class="list-group-item">Account history</a>
				  <a href="/users/{{$user->id}}/info/link-usar" class="list-group-item">Link account to your USAR account</a>
				  <a href="#" class="list-group-item"></a>
				</div>
			</div>
		</div>
		<div class="col-md-4 region">
			<div class="panel panel-default box-shadow--2dp">
				<h2 class="region-title">
					<div class="" id="">
						<i class="fa fa-cog"></i> Preferences
						<i class="fa fa-caret-right"></i>
					</div>
				</h2>
				<div class="list-group">
				  <a href="#" class="list-group-item">Home Page</a>
				  <a href="#" class="list-group-item">Control content</a>
				  <a href="#" class="list-group-item"></a>
				  <a href="#" class="list-group-item"></a>
				</div>
			</div>
		</div>
	</div>
</div>
@stop