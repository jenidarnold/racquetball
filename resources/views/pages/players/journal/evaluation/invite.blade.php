@extends('pages.players.journal.evaluation.layout')

@section('style')
	<style>
	.lbl-invite{
		font-weight: 500;
		font-size: 12pt;
	}

	</style>
@stop

@section('title')
	<label class="player-sub-title">Invite a friend to evaluate you </label>		
@stop

@section('evaluation-content')		
    <div class="row">
      <div class="form-group">    
  		{!! Form::open(array('class' => 'form-inlineZ', 'role' => 'form' ,'method'=>'POST', 
            'route' => array('evaluation.invite', $player->player_id, $entry)))!!}
		<div class="form-group" style="padding-bottom:10px">
			{!! Form::label('Invite:', '', array('class' => 'form-label text-primary', 'for' =>'ddlPlayers')) !!}
			{!! Form::select('ddlPlayers', $players_list, null,  array('class' => 'player form-control', 'style' => 'font-weight:300; font-size:12pt; width:250px' )) !!}	
			<!--span class='lbl text-muted' style="font-weight:bold; font-size:18pt; padding-left:20px; padding-right:20px"><i> Vs </i></span -->
		</div>
		<div class="form-group" style="padding-bottom:10px">
		{!! Form::label('Message:','', array('class' =>'form-label text-primary', 'for' =>'message')) !!}
        {!! Form::text('message:','', array('class' =>'form-control', 'style' => 'width:400px')) !!}
		</div>
		<div>
			{!! Form::submit('Submit', array('class' =>'btn btn-sm btn-success', )) !!}	
		</div>									
		{!! Form::close() !!}	
    </div>
@stop