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

		.user-form {
			text-align: center;			
			padding-top: 15px;
			padding-bottom: 15px;
		}
		.control-label {
			font-size: 14pt;
			font-weight: 500;
		}
	</style>
	@parent
@stop
@section('content')
<div class="main-content">
	<div class="row">
		<div class="row col-md-12 div-describe">
			<label class="describe">Edit your Username and Password</label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">			
			<div class="user-form panel panel-default box-shadow--2dp">				
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-md-5 control-label">Username:</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="username" value="{{ old('username') }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">New Password:</label>
						<div class="col-md-4">
							<input type="password" class="form-control" name="password">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-5 control-label">Confirm Password:</label>
						<div class="col-md-4">
							<input type="password" class="form-control" name="password">
						</div>
					</div>			
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button type="submit" class="btn btn-success">Submit</button>
							<button type="button" class="btn btn-warning">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop