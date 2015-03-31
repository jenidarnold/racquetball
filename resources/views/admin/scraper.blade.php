@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Screen Scrape</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/rankings') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Download Rankings</button>
							</div>
						</div>
					</form>
					<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/tournaments') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Download Tournaments</button>
							</div>
						</div>
					</form>

					<form class="form-horizontal" role="form" method="GET" action="{{ url('/admin/participants') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="form-group">
									<label for="ddlTournaments">Tournament:</label>
									<select class="form-control" id="ddlTournaments">
										<option value="13654">2015 Battle at the Alamo Regional Tournament</option>
										<option value="13556">2015 Maverick May Racquetball Shootout</option>
									</select>
									<button type="submit" class="btn btn-primary">Download Participants</button>
								</div>
							</div>													
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
