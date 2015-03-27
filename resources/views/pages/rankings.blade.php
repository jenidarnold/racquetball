@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Rankings</div>

				<div class="panel-body">
					<ul>


						@foreach ($rankings as $players)
							  @foreach ($players as $player)
						   		@foreach ( $player as $p)
								<li> Player ID: {{ $p }}  </li>
								@endforeach
							@endforeach
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

	</body>
</html>
@stop