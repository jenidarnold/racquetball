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
	<div class="row" id="vueapp">
		<div class="col-md-6 col-md-offset-3">			
			<div class="user-form panel panel-default box-shadow--2dp">				
				{!! Form::model($user, array('route' => array('users.update', $user->id), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'PUT')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="form-group">
						<label class="col-md-5 control-label">Email Address:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="email" value="{{$user->email}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label">New Password:</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" v-model="password">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-md-5 control-label">Confirm Password:</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" v-model="confirm">
						</div>
					</div>			
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							{!!  Form::submit('Submit', array('class' => 'btn btn-success',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
							<button type="button" class="btn btn-warning" v-show="!error" @click ="cancelled">Cancel</button>
						</div>
					</div>
					<div class="alert alert-danger" v-show="password != '' && confirm != '' && (password != confirm)" v-model="error">
					  	Passwords do not match. Please re-enter.
					</div>
				{!! Form::close() !!}		
					
				<!--pre>
					@{{ $data |  json}}
				</pre-->	
			</div>
		</div>
	</div>
</div>
@stop
@section('script')
	<!--script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.min.js"></script-->
	<script type="text/javascript">
		new Vue({
			el:  '#vueapp',
			data:  {
				password: '',
				confirm: '',
				error: '',
			},
			methods: {
				submitted: function() {
					alert('handle submitted; used for calling ajax for example');
				},
				cancelled: function() {
					alert('cancelled');
				},
			}

		});
	</script>
	@parent
@stop