@extends('layouts.app')


@section('content')
<div class="container">
	<div class="row">
			<div class="col-md-2">			
		   		Hello
			</div>			
			<div class="row col-md-10">
				<label class="player-title">{{$user->name}}</label>
			</div>
			<div class="row col-md-10 panel panel-primary">
				@yield('menu') menu
			</div>
			<div class="row col-md-10">
				@yield('title')
			</div>
			<div class="row col-md-10">
				@yield('player-content')
			</div>		
	</div>
</div>
@stop