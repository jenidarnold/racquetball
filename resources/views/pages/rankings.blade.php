@extends('layouts.app')

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">								
				<div class="panel-heading">		
				  	<h4>Ranking as of {{ $rankings[0]->ranking_date}}</h4>	
			    </div>
				<div class="panel-body">
					<div class="row">
						{!! Form::open(array('route' => 'rankings.show', 'method' => 'get')) !!}
						<!--div class="col-md-1 col-md-offset-0">
							{!! Form::Label('ddlGroup', 'Group:', array('id' => 'lblGroup')) !!}
						</div-->
						<div class="col-md-3 col-md-offset-0">
							{!! Form::select('group_id', $groups, $rankings[0]->group_id, array('class' => 'form-control')) !!}
						</div>
						<!--div class="col-md-1 col-md-offset-0">
                        	{!! Form::Label('ddlLocation', 'Location:', array('id' => 'lblLocation')) !!}
                        </div-->
                        <div class="col-md-3 col-md-offset-0">
							{!! Form::select('location_id', $locations, $rankings[0]->location_id, array('class' => 'form-control')) !!}
						</div>
						<div class="col-md-3 col-md-offset-0">
							{!! Form::submit('Show Rankings', array('class' =>'btn btn-primary')) !!}
						</div>					
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">					
					<h3>{{ $rankings[0]->name }} {{ $rankings[0]->location }}</h3>				
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<th>Rank</th>	
							<th></th>									
							<th>First Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Skill Level</th>
							<th>Home</th>
						</thead>
						<tbody>
							@if(count($rankings) > 0)
								@foreach ($rankings as $player)							
								<tr class="clickable-row" data-href="{{ route('players.show', [$player->player_id]) }}">
									<td><h2>{{$player->ranking }}</h2></td>
									<td>
									    @if((true) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))	
											<img class='img-profile img-thumbnail' width="100px" src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$player->player_id.'_normal.jpg' }} >
										@else
											<img class='img-profile img-thumbnail' width="100px" src='/images/racquet-right.png'>
										@endif
									</td>
									<td>{{ $player->first_name }}  </td>
									<td>{{ $player->last_name }}  </td>
									<td>{{ $player->gender }}</td>
									<td>{{ $player->skill_level }} </td>								
									<td>{{ $player->home }} </td>
								</tr>
								@endforeach							
								<tr>
									<td colspan="7"> 
										{!! $rankings->appends(Input::except('page'))->render() !!}
									</td>
								</tr>
							@else
							 	<tr><td colspan="7">No Ranking Data Available</td></tr>
							@endif
						</tbody>					
					</table>
				</div>						
			</div>
		</div>
	</div>
</div>
@stop