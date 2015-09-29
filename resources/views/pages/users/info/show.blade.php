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

		.describe-sm {
			font-weight: 300;
			font-size: 16pt;
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

		.field-name {
			color: steelblue;
			font-weight: 200;
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
		<div class="row col-md-12 div-describe">
			<label class="describe">Your personal information</label>
		</div>	
		<div class="row col-md-12 div-describe">
			<div class="col-sm-8 col-sm-offset-2">
			<label class="describe-sm">Manage this basic information — your name, email, and phone number — to help others find you on Google products like Hangouts, Gmail, and Maps, and make it easier to get in touch.</label>
			</div>
		</div>	
		@if(Session::has('message'))
			<div class="row col-md-12 alert {{ Session::get('alert-class', 'alert-info') }}">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<center>{{ Session::get('message') }}</center>
			</div>
		@endif
	</div>
	<div class="row regions">
		<div class="col-sm-6 region col-sm-offset-3">
			<div class="panel panel-default box-shadow--2dp">
				<div class="list-group">				
				  <a href="/users/{{$user->id}}/info/name/edit" class="list-group-item">
				  <div class="row">
				  	<div class="col-sm-3 text-left field-name">Nickname</div>
				  	<div class="col-sm-8 text-left">Rballer</div>
				  	<div class="col-sm-1 text-right"><i class="fa fa-caret-right"></i></div>
				   </div>
				  </a>				  
				</div>
				<div class="list-group">
				  <a href="/users/{{$user->id}}/info/email/edit" class="list-group-item">
				  <div class="row">
				  	<div class="col-sm-3 text-left field-name">Email</div>
				  	<div class="col-sm-8 text-left">player@racquetballhub.com </div>
				  	<div class="col-sm-1 text-right"><i class="fa fa-caret-right"></i></div>
				  	</div>
				  </a>				  
				</div>
				<div class="list-group">
				  <a href="/users/{{$user->id}}/info/phone/edit" class="list-group-item">
				  <div class="row">
				  	<div class="col-sm-3 text-left field-name">Phone</div>
				  	<div class="col-sm-8 text-left">555-555-5555</div>
				  	<div class="col-sm-1 text-right"><i class="fa fa-caret-right"></i></div>
				  	</div>
				  </a>				  
				</div>
				<div class="list-group">
				  <a href="/users/{{$user->id}}/info/address/edit" class="list-group-item">
				  <div class="row">
				  	<div class="col-sm-3 text-left field-name">Address</div>
				  	<div class="col-sm-8 text-left">123 Main St. City, TX 77777</div>
				  	<div class="col-sm-1 text-right"><i class="fa fa-caret-right"></i></div>
				  	</div>
				  </a>				  
				</div>
			</div>
		</div>
	</div>
</div>
@stop