@extends('layouts.app')

@section('style')
	<style>

	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<!-- Setup League  -->
		<div class="panel panel-primary">			
			<div class="panel-heading"><h3>Create League</h3></div>
			<div class="panel-body">	
				{!! Form::open(array('route'         => array('tools.league.store'),      'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="form-group">
						<label for="league_title" class="control-label col-xs-1">Title:</label>
						<div class="col-xs-6">
							<input name="league_title" placeholder="i.e. Monday A/B League" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="start_date" class="control-label col-xs-1">Starts:</label>
						<div class="col-xs-4">
							<div class="input-group date date-picker" data-provide="datepicker">							
							    <input type="text" class="form-control" name="start_date">
							    <div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
							    </div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="start_date" class="control-label col-xs-1">Ends:</label>
						<div class="col-xs-4">
							<div class="input-group date date-picker" data-provide="datepicker">
							    <input type="text" class="form-control" name="end_date">
							    <div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
							    </div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="ddlFormats" class="control-label col-xs-1">Format:</label>
						<div class="col-xs-8">
							{!! Form::select('ddlFormats', $formats, '', 
									    array('class' => 'formats form-control', 'name' => 'format_id',
								       'style' => 'font-weight:300; font-size:11pt; width:200px',
					        )) !!}
						</div>
					</div>
					<div class="form-group">
						<label for="ddlGyms" class="control-label col-xs-1">Gym:</label>
						<div class="col-xs-8">
							{!! Form::select('ddlGyms', $gyms, '',
										array('class' => 'gyms form-control', 'name' => 'gym_id',
								       'style' => 'font-weight:300; font-size:11pt; width:200px',
					        )) !!}
						</div>
					</div>
					<div class="form-group">
						<label for="ddlDirectors" class="control-label col-xs-1">Director:</label>
						<div class="col-xs-8">
							{!! Form::select('ddlDirectors', $directors, '', 
									    array('class' => 'directors form-control', 'name' => 'director_id',
								       'style' => 'font-weight:300; font-size:11pt; width:200px',
					        )) !!}
						</div>
					</div>
					<div class="form-group">
						<label for="detail" class="control-label col-xs-1">Details:</label>
						<div class="col-xs-8">
							<textarea name="detail" placeholder="League Detail" rows="4" type="text" class="form-control"></textarea>
						</div>
					</div>
			    	<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							{!!  Form::submit('Submit', array('class' => 'btn btn-success',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
							<button type="button" class="btn btn-warning" v-show="!error" @click ="cancelled">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>		
	</div>
</div>
@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>	
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){   

			$(".formats").select2({
	        	placeholder: "Select a Format",
	        	allowClear: true,    	 	
	        });	
	        $(".formats").select2("val", "");   

	        $(".gyms").select2({
	        	placeholder: "Select a Gym",
	        	allowClear: true,    	 	
	        });	
	        $(".gyms").select2("val", "");
	        
	        $(".directors").select2({
	        	placeholder: "Select a Director",
	        	allowClear: true,    	 	
	        });	
	        $(".directors").select2("val", "");
	    });
	</script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,				
			},		
			ready: function() {
				//ajax functions
				//this.getLeagues();
            },								
			computed: {									
			},
			filters: {				
			},				
			methods: {	

		});	
	</script>
@stop