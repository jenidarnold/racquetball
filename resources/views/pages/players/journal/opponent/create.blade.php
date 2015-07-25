@extends('pages.players.journal.opponent.layout')

@section('style')	
	<style type="text/css">
	.starrr{
		color: green;
		font-size: 14pt;
	}

	.eval-header{
		color:white;
		font-weight: 500;
		font-size: 14pt;
		width:450px;
        padding-left: 10px !important; 
	}
    .opp-title{
        font-weight:700;
        font-size: 12pt;
    }
	
    .form-label{
        font-weight:500;
        padding-bottom: 10px;
    }

	</style>
	@parent
@stop

@section('title')
	<label class="player-sub-title">Create New Opponent Entry</label>
	<label class="entry-date" style="float:right">Last Entry: 6/1/15</label>		
@stop

@section('opponent-content')
	<div>
		{!! Form::open(array('class' =>'form-inline','role'=>'form', 'method'=>'POST', 'route' => array('opponent.evaluation.store', $player->player_id, $target_id, $entry)))!!}
    	<div class="row col-md-8">
			<div class="form-group">
				{!! Form::label('Opponent:','', array('class' =>'form-label opp-title', 'for' =>'ddlPlayer')) !!}
				{!! Form::select('ddlPlayer', $players_list, null, array('class' => 'form-control', 'style' => 'width:200px' )) !!}	
			</div>
		</div>
		<div class="row col-md-8">
			<div class="form-group">
	        {!! Form::label('Entry Title:','', array('class' =>'form-label opp-title', 'for' =>'entry_title')) !!}
	        {!! Form::text('entry_title','', array('class' =>'form-control', 'style' => 'width:400px')) !!}
	        </div>
        </div>
        <div class="row col-md-8">
			<div class="form-group">
			{!! Form::submit('Submit', array('class' =>'btn btn-sm btn-success', 'style' => 'font-style:italic; font-weight:bolder')) !!}	
			{!! Form::button('Reset', array('class' =>'btn btn-sm btn-warning', 'style' => 'font-style:italic; font-weight:bolder')) !!}	
			</div>	
		</div>			
		{!! Form::close() !!}	
	</div>
@stop
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#ddlPlayer').change(function(){
	        	target_id = $('#ddlPlayer').val();
			});	  	
		});

</script>