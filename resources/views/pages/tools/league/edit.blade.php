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
			<div class="panel-heading"><h3>Edit League</h3></div>
			<div class="panel-body">	
				{!! Form::model($league, array('route' => array('tools.league.create'), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'PUT')) !!}
					{!! Form::hidden ('_token', csrf_token()) !!}
					<div class="form-group">
						<label for="league_title" class="control-label col-xs-1">Title:</label>
						<div class="col-xs-4">
							<input v-model="league_title" placeholder="i.e. Monday A/B League" type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="start_date" class="control-label col-xs-1">Starts:</label>
						<div class="col-xs-4">
							<div class="input-group date date-picker" data-provide="datepicker">							
							    <input type="text" class="form-control" id="start_date">
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
							    <input type="text" class="form-control" id="end_date">
							    <div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
							    </div>
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
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
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