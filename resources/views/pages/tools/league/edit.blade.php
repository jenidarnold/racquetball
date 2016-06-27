@extends('layouts.app')

@section('style')
	<style>	
	* {
		  border-radius: 0 !important;
		}
	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">

	@include('pages.tools.includes.league_header')
	<!-- Menu -->
	<nav class="navbar navbar-primary navbar-inverse col-xs-12">
	  <div class="container-fluid">
	    <ul class="nav navbar-nav">
	      	<li><a href="/tools/league/">Leagues</a></li>
	      	<!--@ if($league->permission($user->id) -->
	      	<li class="active"><a href="#">Edit</a></li>
	      	<!--@ endif -->
	    	<li><a href="/tools/league/{{$league->league_id}}/join">Join</a></li>
	      	<li><a href="/tools/league/{{$league->league_id}}/standings">Standings</a></li>
	      	<li><a href="/tools/league/{{$league->league_id}}/">Matches</a></li>
	      	
	  </div>
	</nav>
		<!-- Edit League  -->
		<div class="panel panel-primary">			
			<div class="panel-heading">
				<h4>Edit League Information</h4>
			</div>
			<div class="panel-body">	
				{!! Form::model($league, array('route' => array('tools.league.edit', $league->league_id), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="col-xs-12 col-sm-8">
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="name" >Title:</label>
							<div class="col-xs-9 col-sm-8">
								<input value="{{$league->name}}" name="name" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group">		
							<label class="control-label col-xs-3 col-sm-2" for="location">Gym:</label>
							<div class="col-xs-9 col-sm-8">								
								{!! Form::select('ddlGyms', $gyms, $league->location_id, 
								    array('class' => 'gyms form-control','id' => 'location_id',  'name' => 'location_id',
							       'style' => 'font-weight:300; font-size:12pt;',
							        )) !!}
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="format">Format:</label>
							<div class="col-xs-9 col-sm-6">
								{!! Form::select('ddlFormats', $formats, $league->format_id, 
								    array('class' => 'formats form-control',  'id' => 'format_id', 'name' => 'format_id',
							       'style' => 'font-weight:300; font-size:11pt;',
						        )) !!}
							</div>
						</div>		
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="start_date">Starts:</label>
							<div class="col-xs-7 col-sm-6">
								<div class="input-group date date-picker datetimepicker" id="divStartDate">
								    <input type="text" class="form-control" name="start_date" value="{{date('m-d-y', strtotime($league->start_date))}}">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar"></i>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="end_date">Ends:</label>
							<div class="col-xs-7 col-sm-6">
								<div class="input-group date date-picker datetimepicker">
								    <input type="text" class="form-control" name="end_date" value="{{date('m-d-y', strtotime($league->end_date))}}">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar"></i>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="end_date">Day:</label>
							<div class="col-xs-7 col-sm-6">
							  	<input type="text" class="form-control" name="day_of_week" id="day_of_week" readonly="true" value="{{date('l', strtotime($league->start_date))}}">
							</div>
						</div>						
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="start_time">From:</label>
							<div class="col-xs-7 col-sm-6">
							    <div class="input-group timemask timepicker" >
					                <input type="text" class="form-control" name="start_time" value="{{date('HH:ii p', strtotime($league->start_time))}}">
					               	<div class="input-group-addon">
						                <span class="add-on clearpicker"><i class="fa fa-clock-o"></i></span>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="end_time">To:</label>
							<div class="col-xs-7 col-sm-6">
								<div class="input-group timemask timepicker" >
								    <input type="text" class="form-control" name="end_time" value="{{date('HH:ii p', strtotime($league->end_time))}}">
								    <div class="input-group-addon">
								        <span class="add-on clearpicker"><i class="fa fa-clock-o"></i></span>
								    </div>
								</div>
							</div>
						</div>
						
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="fee">Fee:</label>
							<div class="col-xs-4 col-sm-3">
								<input value="{{$league->fee}}" name="fee" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="detail">Details:</label>
							<div class="col-xs-12 col-sm-10">
								<textarea name="detail"  rows="3" rows class="form-control">{{$league->detail}}</textarea>
							</div>
						</div>
					</div>					
					<div class="form-group">
						<div class="col-xs-10 col-xs-offset-3">
							{!!  Form::submit('Submit', array('class' => 'btn btn-success',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
							<button type="button" class="btn btn-warning" v-show="!error" @click ="cancelled">Cancel</button>
						</div>
					</div>
				</form>
			</div>
			<!-- Edit Players  -->		
			<div class="panel panel-primary" >	
				<a name="players"></a>
				<div class="panel-heading">
					<h4>Edit Players</h4>
				</div>
				<div class="panel-body">	
					<div class="col-xs-12 col-sm-8">
						{!! Form::open( array('route' => array('tools.league.join', $league->league_id), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
						{!! Form::hidden ('_token', csrf_token()) !!}				
							<div class="form-group" style="padding-bottom:10px">						
								<label for="ddlPlayers" class="control-label col-xs-3 col-sm-2">Add Player:</label>
								<div class="col-xs-8">
									{!! Form::select('ddlPlayers', $players_list, '', 
										    array('class' => 'player form-control', 
									       'style' => 'font-weight:300; font-size:12pt; width:250px',
							        )) !!}
								</div>
							</div>
							<div class="form-group" style="padding-bottom:10px">
						    	<div class="col-xs-10 col-xs-offset-3 col-sm-4">
									{!!  Form::submit('Submit', array('class' => 'btn btn-success btn-xs',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}
									<button type="button" class="btn btn-warning btn-xs" v-show="!error" @click ="cancelled">Cancel</button>
								</div>
						    </div>																
						{!! Form::close() !!}
					</div>				
					<div class="col-xs-12 col-sm-6">		
						<table class="table">
							@foreach ($players as $p)
							<tr>
								<td class="player_name">{{ $p->last_name }}, {{ $p->first_name }} </td>
								<td>
									{!! Form::open(['route' => ['tools.league.player.delete', 
									          $league->league_id, $p->player_id]]) 
									 !!}
					                    {!! Form::hidden('_method', 'DELETE') !!}
										{!! Form::hidden ('league_id', $league->league_id) !!}	
										{!! Form::hidden ('player_id', $p->player_id) !!}	
					                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
					                {!! Form::close() !!}
								</td>		
							</tr>
							@endforeach
							@if (count($players) ==0)
								<tr><td><h5>No Players</h5></td></tr>
							@endif
						</table>
						</div>
					</div>
				</div>			
			</div>
		</div>
</div>
@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>	
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){   


	      	$('.datetimepicker').datetimepicker({
	      	     format: 'MM/DD/YYYY',
	      	});

	      	 $('.timepicker').datetimepicker({
                format: 'hh:mm a',
            });

			$(".formats").select2({
	        	placeholder: "Select a Format",
	        	allowClear: true,    	 	
	        });	
	        //$(".formats").select2("val", "");   

	        $(".gyms").select2({
	        	placeholder: "Select a Gym",
	        	allowClear: true,    	 	
	        });	

	        $(".player").select2({
	        	placeholder: "Select a Player",
	        	allowClear: true,    	 	
	        });	
	        $(".player").select2("val", "");
	        
	        //$(".directors").select2({
	        //	placeholder: "Select a Director",
	        //	allowClear: true,    	 	
	       // });	
	       // $(".directors").select2("val", "");

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
			}
		});	
	</script>
@stop