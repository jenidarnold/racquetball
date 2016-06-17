@extends('layouts.app')

@section('style')
	<style>

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
			<!--div class="panel-heading"><h3>Edit League</h3></div -->
			<div class="panel-body">	
				{!! Form::model($league, array('route' => array('tools.league.edit', $league->league_id), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="col-xs-12 col-sm-8 l-card">
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="league_title" >Title:</label>
							<div class="col-xs-4">
								<input value="{{$league->name}}" id="league_title" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group">		
							<label class="control-label col-xs-3 col-sm-2" for="location">Gym:</label>
							<div class="col-xs-7 col-sm-10">								
								{!! Form::select('ddlGyms', $gyms, '$location_id', 
								    array('class' => 'gyms form-control', 
							       'style' => 'font-weight:300; font-size:12pt; width:250px',
							        )) !!}
							</div>
						</div>				
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="start_date">Starts:</label>
							<div class="col-xs-4">
								<div class="input-group date date-picker datetimepicker">
								    <input type="text" class="form-control" name="start_date" value="{{date('m-d-y', strtotime($league->start_date))}}">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar"></i>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-xs-3 col-sm-2" for="end_date">Ends:</label>
							<div class="col-xs-4">
								<div class="input-group date date-picker datetimepicker">
								    <input type="text" class="form-control" name="end_date" value="{{date('m-d-y', strtotime($league->end_date))}}">
								    <div class="input-group-addon">
								        <i class="fa fa-calendar"></i>
								    </div>
								</div>
							</div>
						</div>						
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="start_time">Start Time:</label>
							<div class="col-xs-3">
							    <div class="input-group timemask timepicker" >
					                <input type="text" class="form-control" name="start_time" value="{{date('HH:ii p', strtotime($league->end_date))}}">
					               	<div class="input-group-addon">
						                <span class="add-on clearpicker"><i class="fa fa-clock-o"></i></span>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="end_time">End Time:</label>
							<div class="col-xs-3">
								<div class="input-group timemask timepicker" >
								    <input type="text" class="form-control" name="end_time" value="{{date('HH:ii p', strtotime($league->end_date))}}">
								    <div class="input-group-addon">
								        <span class="add-on clearpicker"><i class="fa fa-clock-o"></i></span>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="format">Format:</label>
							<div class="col-xs-7 col-sm-10">
								{!! Form::select('ddlFormats', $formats, '$format_id', 
										    array('class' => 'formats form-control', 'name' => 'format_id',
									       'style' => 'font-weight:300; font-size:11pt; width:200px',
						        )) !!}
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="fees">Fees:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="fees">$20</label>
							</div>
						</div>
						<div class="form-group">						
							<label class="control-label col-xs-3 col-sm-2" for="details">Details:</label>
							<div class="col-xs-7 col-sm-10">
								<label class="control-label text text-primary" id="details">Play one game to 11. Rankings by Average Points</label>
							</div>
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

		<!-- Setup Players  -->		
		<div class="panel panel-primary" >			
			<div class="panel-heading"><h3>Edit Players</h3></div>
			<div class="panel-body">	
				<div class="col-md-12 col-md-offset-0">
					{!! Form::open(array('class' => 'form-horizontal', 'role' => 'form')) !!}
						<div class="form-group" style="padding-bottom:10px">						
							<label for="ddlPlayers" class="control-label col-xs-1">Player:</label>
							<div class="col-xs-8">
								{!! Form::select('ddlPlayers', $players_list, '', 
									    array('class' => 'player form-control', 
								       'style' => 'font-weight:300; font-size:12pt; width:250px',
								        )) !!}
						    	<button class="btn btn-warning btn-md" v-on:click="createPlayer">New</button>	
						    </div>
						</div>																
					{!! Form::close() !!}
				</div>
				<div class="row">
					<div class="col-xs-8">
						<table class="table">
							<th>ID</th>
							<th>Name</th>
							<th></th>
							<tr v-for="player in players | orderBy 'name'">
								<td>@{{ player.id }} </td>
								<td>@{{ player.name }} </td>
								<td><button class="btn btn-danger btn-xs" v-on:click="deletePlayer(player.id)">Delete</button></td>	
							</tr>
						</table>
					</div>
				</div>
			</div>			
		</div>
		<div class="panel" v-show="showSetup">
		    <button class="btn btn-success" v-on:click="saveLeague">Save</button>
		    <button class="btn btn-danger" v-on:click="resetLeague">Cancel</button>
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
                format: 'HH:ii p',
                showMeridian: true,
                startView: 1,
                maxView: 1
            });

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