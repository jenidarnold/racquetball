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
				    {!! Form::select('player_id', $players_list, $player_id, array('class' => 'player form-control', 'style' => 'font-weight:300; font-size:12pt; width:250px' )) !!}	
									
					</div>
				 	<div class="form-group">
				 	{!! Form::label('lblFilter', 'Filter By',array('for' => 'lblName', 'class' =>'control-label txt-lookup text-primary', 'style' => 'padding-left:20px;'))!!}
				 	{!! Form::text('firstname', '', array('class' =>'control-label lbl-lookup', 'placeholder' => 'First Name'))!!}
				 	{!! Form::text('lastname', '', array('class' =>'control-label lbl-lookup', 'placeholder' => 'Last Name'))!!}
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
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Gender</th>
					<th>Skill Level</th>
					<th>Home</th>
				</thead>
				<tbody>
				@foreach ($players as $player)
					<tr class="clickable-row" data-href="{{ route('players.show', [$player->player_id]) }}">	
						<td>@if((false) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))	
								<img class='img-profile img-thumbnail' style="width:100" src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} >
							@else
								<img class='img-profile img-thumbnail' style="width:100px" src='/images/racquet-right.png'>
							@endif
						</td>
						<td>{{ $player->player_id }}  </td>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){           
        $(".player").select2({
        	placeholder: "Select a Player",
        	allowClear: true,
    	 	
        });	

        $(".player").select2("val", "");
    });
</script>
