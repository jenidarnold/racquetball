@extends('layouts.app')

@section('content')
<div class="main-content">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>{{ $tournament->name }}</h1>
				</div>

				<div class="panel-body">
					<h3>{{ $participants->count() }} Participants </h2>
					<div>
						<table class="table">
							<thead>
								<th>Action</th>
								<th>Name</th>
								<th>Divisions</th>
							</thead>
							@foreach ($tournament->participants as $p)
								<tr>
									<td>
										<a id={{"lnkProfile-$p->player_id"}} 
										class="btn btn-success"
										href="{{ route('tournaments.participants.show', [$tournament->tournament_id, $p->player_id]) }}">
										<i class="fa fa-search"> View Entry</i></a>
									</td>					
									<td>
										<a id={{"lnkProfile-$p->player_id"}} href="{{ route('players.show', [$p->player_id]) }}">{{ $p->player['full_name']}}</a>
									</td>
									<td>
										@foreach ($p->divisions as $d)
											{{ $d->name }} 
										@endforeach
									</td>
								</tr>
							@endforeach
						</table>
						<div>
							{!! $tournament->participants->render() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('script')
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function(){

			
		});

		//Voting Button
		function download(player_id){
			$.ajax({
				type: 'GET',
				url: '{{ URL::to('api/profile/download') }}',
				data: 'playerID='+ player_id ,
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success:function(result){
					
				}
			})
		}



	</script>
@stop