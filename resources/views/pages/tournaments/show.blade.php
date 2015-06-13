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
					<h3>{{ $tournament->participants->count() }} Participants</h2>
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
										@if(!isset($p->player['full_name']))										
											<button id='btnDownload' 
												class="btn btn-primary"
											 	onclick="{{ "download($p->player_id)" }}">
											 	<i class="fa fa-arrow-down"> Download</i>
											 </button>
										@else
											<a id={{"lnkProfile-$p->player_id"}} 
												class="btn btn-success"
												href="{{ route('tournaments.participants.show', [$tournament->tournament_id, $p->player_id]) }}">
											<i class="fa fa-search"> View Entry</i></a>
										@endif
									</td>					
									<td>
										@if(!isset($p->player['full_name']))										
											Unknown
										@else
											<a id={{"lnkProfile-$p->player_id"}} href="{{ route('tournaments.participants.show', [$tournament->tournament_id, $p->player_id]) }}">{{ $p->player['full_name']}}</a>
										@endif
									</td>
									<td>
										@foreach ($p->divisions as $d)
											{{ $d->name }} 
										@endforeach
									</td>
								</tr>
							@endforeach
						</table>
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
@end