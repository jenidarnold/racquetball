@extends('layouts.app')

@section('style')
	<style type="text/css">
		.txt-lookup {
			font-weight: bold;
			font-size: 18pt;
			padding-right: 15px;
		}
		.lbl-lookup {
			font-weight: bold;
			font-size: 14pt;
			padding-left: 15px;
		}
	</style>
@stop

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<div class="row well">
				<div class="col-md-12 col-md-offset-0">
				{!! Form::open(array('route' => 'players.index', 
					'role' =>'form',
					'method' => 'get',
					'class'=>'form-inline')) !!}
			
				    <div class="form-group">
				    {!! Form::label('lblLookup', 'Player Lookup',array('for' => 'lblName', 'class' =>'control-label txt-lookup text-primary'))!!}
					{!! Form::label('lblName', 'Name',array('for' => 'first_name', 'class' =>'control-label lbl-lookup'))!!}
					{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' =>'First', 'style' => 'width:160px'])!!}
					{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' =>'Last', 'style' => 'width:160px'])!!}
					
					</div>
				 	<div class="form-group">
					{!! Form::label('lblGender', 'Gender', array('for' => 'gender', 'class' =>'control-label lbl-lookup'))!!}
					{!! Form::select('gender', 
				                 array('All' => 'All', 'Male' => 'Male', 'Female' => 'Female'), 
				                 $gender, 
				                 array('class' => 'form-control', 'placeholder' =>'Gender', 'style' => 'width:100px')) !!}
				    </div>
				    <div class="form-group">				
					{!! Form::label('lblLevel', 'Level',  array('for' => 'level', 'class' =>'control-label lbl-lookup'))!!}
					{!! Form::select('level', 
				                  array('All' => 'All', 
				                        'Pro' => 'Pro', 
				                        'Open' => 'Open',
				                        'Elite' => 'Elite',
				                        'A' => 'A',
				                        'B' => 'B',
				                        'C' => 'C',
				                        'D' => 'D',
				                        'Juniors' => 'Junior',						                       
				                        'Novice' => 'Novice'
				                        ),  
				                  $level, 
				                  array('class' => 'form-control', 'style' => 'width:100px')
				                ) !!}
				    </div>
				    <div class="form-group">
				   		{!! Form::submit('Search Players', array('class' =>'btn btn-primary')) !!}
				   	</div>
				{!! Form::close() !!}
				</div>
			</div>
			<table class="table">
				<thead>
					<th>Profile</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Skill Level</th>
					<th>Home</th>
				</thead>
				<tbody>
				@foreach ($players as $player)
					<tr>	
						<td><a href="{{ route('players.show', [$player->player_id]) }}">
						    @if((false) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))	
								<img class='img-profile img-thumbnail' style="width:100" src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} >
							@else
								<img class='img-profile img-thumbnail' style="width:100px" src='/images/racquet-right.png'>
							@endif
							</a>
						</td>
						<td>{{ $player->first_name }}  </td>
						<td>{{ $player->last_name }}  </td>
						<td>{{ $player->gender }}</td>
						<td>{{ $player->skill_level }} </td>								
						<td>{{ $player->home }} </td>
					</tr>
				@endforeach
				<tr>
					<td colspan="6"> 
						{!! $players->appends(Input::except('page'))->render() !!}
					</td>
				</tr>
				</tbody>					
			</table>
	</div>
</div>
@stop