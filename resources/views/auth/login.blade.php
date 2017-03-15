<!--@extends('pages.tools.layouts.referee')-->
@section('style')
	<style type="text/css">
	.cred {
		font-size:14pt;
		font-weight: 400;
		text-align: center;
	}

	</style>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">			
		<!--
			<div class="panel panel-info">
				<div class="panel-heading cred"><span class="cred">Login using one of your social media accounts</span></div>
				<div class="panel-body">
					<div class="col-md-3 col-md-offset-2">
						<a class="btn btn-block btn-social btn-twitter">
    						<i class="fa fa-twitter"></i> Sign in with Twitter
 						</a>
					</div>
					<div class="col-md-3">
						<a class="btn btn-block btn-social btn-facebook">
    						<i class="fa fa-facebook"></i> Sign in with Facebook
 						</a>
					</div>
					<div class="col-md-3">
						<a class="btn btn-block btn-social btn-google">
    						<i class="fa fa-google"></i> Sign in with Google
 						</a>
					</div>
				</div>
			</div>
			-->			
			<br>
			<div class="panel panel-warning">
				<div class="panel-heading cred"><span class="cred">Enter Your Login Credentials</span></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>
								<a class="btn btn-link small" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>

					</form>
					<br>
						<div>

						</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
