@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				   <h2>{{ $tournament->name }} </h1>
				</div>
				<div class="panel-body">
					<h3>By Divisions</h3>
				</div>
				<div class="panel-body">
					<h3>By Participants: {{ $tournament->participants->count() }}</h3>
					<table class="table">
						<thead>
							<th>Profile</th>
							<th>Player ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Gender</th>
							<th>Skill Level</th>
							<th>Division</th>
						</thead>
						<tbody>
						{!! Form::open() !!}
						@foreach ($tournament->participants as $participant)
							<tr class="clickable-row" data-href="{{ route('players.show', [$participant->player_id]) }}">							
								<td>
									@if((false) && (get_headers('http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$participant->player['player_id'].'_normal.jpg')[0] != 'HTTP/1.1 404 Not Found'))	
										 <img src={{ 'http://www.r2sports.com/tourney/imageGallery/gallery/player/'.$participant->player['player_id'].'_normal.jpg'}} class="img-thumbnail" width="100" >
									@else
									<img class='img-profile img-thumbnail' width="150px" src='/images/racquet-right.png'>
								@endif	
								</td>
								<td>
									@if( $participant->player['first_name'] == '')
										{!! Form::button('Download Player Info', array('class' => 'btn btn-success')) !!}
									@else
										{{ $participant->player['first_name'] }}
									@endif
								</td>
								<td>{{ $participant->player['last_name']   }}  </td>
								<td>{{ $participant->player['gender']    }}  </td>
								<td>{{ $participant->player['skill_level']  }}  </td>
								<td>{{ $participant->player['division']  }}  </td>
							</tr>
						@endforeach
						{!! Form::close() !!}
						</tbody>					
					</table>
					{{-- <div>
						{!! $tournament->participants->render() !!}
					</div> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop