@extends('layouts.app')

@section('style')
	<style>
		th {
			text-align: center
		}
		.txt-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-right: 15px;
		}
		.lbl-lookup {
			font-weight: bold;
			font-size: 10pt;
			padding-left: 15px;
		}
		.player {
			font-weight: 500;
			font-size: 12pt;
			width: 250px;
		}
		.player_name {
			font-weight: 500;
			font-size: 11pt;
		}
		.win {
			font-weight: 500;
			color: green;
			font-size: 14pt;
		}
		.loss {
			font-weight: 500;
			color: red;
			font-size: 14pt;
		}
		.score {
			font-weight: 500;
			font-size: 14pt;
			text-align: center;
		}
		.rank {
			font-weight: 700;
			font-size: 12pt;
			text-align: center;
		}
		.tr-games {
			font-weight: 700;
			font-size: 12pt;
		}
		.red {
			color:red;
		}
		.black {
			color:black;
		}
		.indent { 	
		   padding-top: 10px;
		   padding-bottom:  10px;
		   padding-left: 25px;
		   padding-right: 5px;
		}
		.form-inline > * {
		   margin: 5px 5px;
		   padding-right: 5px;
		}
		h4  > *{
		   padding-top: 10px;
		   padding-bottom:  10px;
			background-color: green;
		}


	</style>
@stop

@section('content')

<div class="container">
	<div id="myvue">
		<!-- Navigation  -->	
		<div class="row">
				<nav class="navbar navbar-primary navbar-inverse">
				  <div class="container-fluid">
				    <ul class="nav navbar-nav">
				      <li><a href="/tools/league/{{$league->league_id}}/join">Join</a></li>
				      <li class="active"><a href="#">Standings</a></li>
				      <li><a href="/tools/league">Back to All</a></li> 
				    </ul>
				  </div>
				</nav>
			</div>	
	<!-- Display Add Match  -->
	<div class="panel panel-success">
		<div class="panel-heading">	
			<h4>Add Match to League: {{$league->name}}</h4>				
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12">
				{!! Form::model($league, array('route' => array('tools.league.match.store'), 'role' => 'form', 'class'=> 'form-horizontal','method' => 'POST')) !!}
				{!! Form::hidden ('_token', csrf_token()) !!}
				{!! Form::hidden ('league_id', $league->league_id) !!}	
					<div class="form-group">
						<label for="match_date" class="control-label col-xs-12 col-md-2">Date:</label>
						<div class="col-xs-6 col-md-3">
							<div class="input-group date date-picker" data-provide="datepicker">						
							    <input type="text" class="form-control" name="match_date" value="">
							    <div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
							    </div>
							</div>
						</div>
					</div>				
					<div class="form-group">						
						<label for="ddlMatchPlayer1" class="control-label col-xs-12 col-md-2">Player 1:</label>
						<div class="col-xs-4">
							{!! Form::select('ddlMatchPlayer1', $players_list, '', 
								    array('class' => 'player form-control', 'id' => 'player1_id', 'name' => 'player1_id')) !!}
						</div>
						<label for="p1_score" class="control-label col-xs-12 col-md-1">Score:</label>
						<div class="col-xs-3 col-md-1">
							<input name="p1_score" type="text" class="form-control" value="">
						</div>						
					</div>
					<div class="form-group">
						<label for="ddlMatchPlayer2" class="control-label col-xs-12 col-md-2">Player 2:</label>
						<div class="col-xs-4">
							{!! Form::select('ddlMatchPlayer2', $players_list, '', 
								    array('class' => 'player form-control', 'id' => 'player2_id', 'name' => 'player2_id')) !!}
						</div>
						<label for="p2_score" class="control-label col-xs-12 col-md-1">Score:</label>
						<div class="col-xs-3 col-md-1">
							<input name="p2_score" type="text" class="form-control"  value="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3 col-md-1">
							{!!  Form::submit('Save', array('class' => 'btn btn-success btn-sm',  'v-show' => '!error', 'v-on:submit.prevent' =>'submitted')) !!}	
						</div>
						<div class="col-xs-3 col-md-1">		    		
							{!! HTML::linkRoute('tools.league.match.create', 'Cancel', array($league->league_id), array('class' => 'btn btn-danger btn-sm')) !!} 
				    	</div>						   
					</div>																
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				@if(session('success'))
				<div class="col-xs-12">
					<div class="alert alert-success fade in" id="success-alert">	
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>		
						{{session('success')}}
					</div>
				</div>
				@endif
				@if(session('error'))
				<div class="col-xs-12">
					<div class="alert alert-danger fade in" id="error-alert">	
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>		
						{{session('error')}}
					</div>
				</div>
				@endif
			</div>	
		</div>			
	</div>	
</div>

@stop

@section('script')
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){           
	        $(".player").select2({
	        	placeholder: "Select a Player",
	        	allowClear: true,    	 	
	        });	

	        //initialize to blank
	        $("#player1_id").select2("val", "");
	        $("#player2_id").select2("val", "");

	        //Alerts
	         $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
			    $("#success-alert").alert('close');
			});
	        
	    });
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.1/vue.js"></script>
	<script>
		
		Vue.config.debug = false;		

		var vm = new Vue({
			el: '#myvue',
			data: {	
				debug: false,
				preview: false,
					
			},		
			ready: function() {
				//ajax functions
				//this.getLeagues();
            },								
			computed: {									
			},
			filters: {				
			},					
		});	
	</script>
@stop